<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FoodOrder;
use App\Models\MenuItem;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    /**
     * Food home page: hero banner + top outlets.
     */
    public function index()
    {
        $outlets = Outlet::orderBy('name')->get();

        return view('food.index', compact('outlets'));
    }

    /**
     * List of all outlets (canteens).
     */
    public function outlets()
    {
        $outlets = Outlet::orderBy('name')->get();

        return view('food.outlets', compact('outlets'));
    }

    /**
     * Menu page for a specific outlet.
     */
    public function menu(Outlet $outlet, Request $request)
    {
        $query = $outlet->menuItems()->where('available', true);

        // Very simple "low price first" ordering
        if ($request->get('sort') === 'price_asc') {
            $query->orderBy('price');
        } else {
            $query->orderBy('name');
        }

        $items = $query->get();

        $cart = session()->get('cart', []);
        $cartTotal = $this->calculateCartTotal($cart);

        $user = Auth::user();
        $credits = $user?->credit_balance ?? 0;

        return view('food.menu', compact('outlet', 'items', 'cart', 'cartTotal', 'credits'));
    }

    /**
     * Add an item to cart (session).
     */
    public function addToCart(Request $request, MenuItem $menuItem)
    {
        $data = $request->validate([
            'qty' => 'nullable|integer|min:1',
        ]);

        $qty = $data['qty'] ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$menuItem->id])) {
            $cart[$menuItem->id]['qty'] += $qty;
        } else {
            $cart[$menuItem->id] = [
                'menu_item_id' => $menuItem->id,
                'name' => $menuItem->name,
                'price' => $menuItem->price,
                'qty' => $qty,
                'outlet_id' => $menuItem->outlet_id,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Item added to cart.');
    }

    /**
     * Remove an item from cart.
     */
    public function removeFromCart(MenuItem $menuItem)
    {
        $cart = session()->get('cart', []);
        unset($cart[$menuItem->id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Show cart page.
     */
    public function cart()
    {
        $cart = session()->get('cart', []);
        $cartTotal = $this->calculateCartTotal($cart);

        $user = Auth::user();
        $credits = $user?->credit_balance ?? 0;

        return view('food.cart', compact('cart', 'cartTotal', 'credits'));
    }

    /**
     * Place an order from the cart.
     */
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('food.cart')->with('error', 'Your cart is empty.');
        }

        $data = $request->validate([
            'credits_to_use' => 'nullable|integer|min:0',
        ]);

        $cartTotal = $this->calculateCartTotal($cart);
        $creditsAvailable = $user->credit_balance;
        $creditsToUse = min($data['credits_to_use'] ?? 0, $creditsAvailable, $cartTotal);

        // Ensure all items are from the same outlet (for simplicity)
        $outletId = collect($cart)->pluck('outlet_id')->unique()->first();

        $order = FoodOrder::create([
            'user_id' => $user->id,
            'outlet_id' => $outletId,
            'total_amount' => $cartTotal,
            'credits_used' => $creditsToUse,
            'status' => 'received',
        ]);

        foreach ($cart as $row) {
            $order->items()->create([
                'menu_item_id' => $row['menu_item_id'],
                'qty' => $row['qty'],
                'price' => $row['price'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()
            ->route('food.orders.show', $order)
            ->with('success', 'Order placed!');
    }

    /**
     * Show order status.
     */
    public function showOrder(FoodOrder $order)
    {
        $this->authorizeViewOrder($order);

        $order->load('items.menuItem', 'outlet');

        return view('food.order_show', compact('order'));
    }

    /**
     * Admin: list incoming orders for all outlets.
     */
    public function adminOrders()
    {
        $orders = FoodOrder::with('user', 'outlet')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('food.admin_orders', compact('orders'));
    }

    /**
     * Admin: update order status.
     */
    public function updateOrderStatus(Request $request, FoodOrder $order)
    {
        $data = $request->validate([
            'status' => 'required|in:received,preparing,ready',
        ]);

        $order->update([
            'status' => $data['status'],
        ]);

        return back()->with('success', 'Order status updated.');
    }

    /**
     * Helper to calculate cart total.
     */
    protected function calculateCartTotal(array $cart): int
    {
        $total = 0;
        foreach ($cart as $row) {
            $total += $row['price'] * $row['qty'];
        }

        return $total;
    }

    protected function authorizeViewOrder(FoodOrder $order): void
    {
        $user = Auth::user();

        if ($user->id !== $order->user_id && $user->role !== 'admin') {
            abort(403);
        }
    }
}

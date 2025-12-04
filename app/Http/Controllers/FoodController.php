<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FoodOrder;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    /**
     * Food home page: hero banner + top restaurants.
     */
    public function index()
    {
        $restaurants = Restaurant::orderBy('name')->get();

        return view('food.index', compact('restaurants'));
    }

    /**
     * List of all restaurants (canteens).
     */
    public function restaurants()
    {
        $restaurants = Restaurant::orderBy('name')->get();

        return view('food.restaurants', compact('restaurants'));
    }

    /**
     * Menu page for a specific restaurant.
     */
    public function menu(Restaurant $restaurant, Request $request)
    {
        $query = $restaurant->menuItems()->where('available', true);

        // Sorting
        if ($request->get('sort') === 'price_asc') {
            $query->orderBy('price');
        } else {
            $query->orderBy('item');
        }

        $items = $query->get();

        $cart = session()->get('cart', []);
        $cartTotal = $this->calculateCartTotal($cart);

        $user = Auth::user();
        $credits = $user?->credit_balance ?? 0;

        return view('food.menu', compact('restaurant', 'items', 'cart', 'cartTotal', 'credits'));
    }

    /**
     * Add an item to cart.
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
                'name' => $menuItem->item,
                'price' => $menuItem->price,
                'qty' => $qty,
                'restaurant_id' => $menuItem->restaurant_id,
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
     * Place an order.
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

        // Ensure all items belong to same restaurant
        $restaurantId = collect($cart)->pluck('restaurant_id')->unique()->first();

        $order = FoodOrder::create([
            'user_id' => $user->id,
            'restaurant_id' => $restaurantId,
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

        session()->forget('cart');

        return redirect()
            ->route('food.orders.show', $order)
            ->with('success', 'Order placed!');
    }

    /**
     * Order status page.
     */
    public function showOrder(FoodOrder $order)
    {
        $order->load('items.menuItem', 'restaurant');

        return view('food.order_show', compact('order'));
    }

    protected function calculateCartTotal(array $cart): int
    {
        $total = 0;
        foreach ($cart as $row) {
            $total += $row['price'] * $row['qty'];
        }

        return $total;
    }

    /**
     * Admin: View all orders.
     */
    public function adminOrders()
    {
        $orders = FoodOrder::with(['user', 'restaurant'])
            ->orderByDesc('created_at')
            ->get();

        return view('food.admin_orders', compact('orders'));
    }

    /**
     * Admin: Update order status.
     */
    public function updateOrderStatus(Request $request, FoodOrder $order)
    {
        $data = $request->validate([
            'status' => 'required|string|in:received,preparing,ready,completed,cancelled',
        ]);

        $order->update(['status' => $data['status']]);

        return back()->with('success', 'Order status updated.');
    }
}

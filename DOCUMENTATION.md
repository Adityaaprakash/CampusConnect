
# Executive Summary
## Mini Project Report On
# CampusConnect
## On Partial Fulfillment of MCA - Web Dev

**Submitted By:**  
Name: Ashutosh Dash  
[Roll Number]  
[SIC]  

**Submitted To:**  
[Faculty Name]  
Silicon University, Bhubaneswar  
Department: MCA  
Academic Year: 2025 - 2026  

---

# Table of Content

I.   EXECUTIVE SUMMARY ................................................................ 1  
II.  INTRODUCTION & RECOMMENDATIONS .............................. 3  
A. Introduction .......................................................................... 3  
III. PROJECT IMPLEMENTATION ................................................... 9  
A. Module-wise Functionality ..................................................... 9  
B. System Design ..................................................................... 10  
C. Database Table Structure ..................................................... 11  
D. ER Diagram ......................................................................... 11  
E. Use Cases ............................................................................. 12  
F. Implementation ..................................................................... 13  
G. Technology Stack .................................................................. 13  
H. Sample Code ......................................................................... 14  
I. Screenshots .......................................................................... 15  
V. CONCLUSION ............................................................................. 18  
A. Conclusion and Future Improvements .................................... 18  
B. Summary of Findings ............................................................ 19  
C. Implications of the Study ....................................................... 19  
VI. REFERENCES .......................................................................... 21  

---

# I. EXECUTIVE SUMMARY

CampusConnect is a comprehensive web-based platform designed to streamline and enhance the daily lives of university students. Recognizing the fragmented nature of campus services—where students often juggle multiple platforms for communication, study materials, accommodation, and food—CampusConnect integrates these essential utilities into a single, unified ecosystem.

The project aims to foster a more connected and efficient campus environment. By providing a centralized hub, students can easily collaborate through real-time chat rooms, share and access study notes department-wise, find suitable accommodation (PGs/Rooms) with verified listings, and order food from campus canteens with a credit-based discount system.

This report details the development of the CampusConnect Minimum Viable Product (MVP), highlighting its core modules, system architecture, and the technologies employed to bring this vision to life.

---

# II. INTRODUCTION AND CONTEXT

## A. Project Overview and Introduction
In the modern academic landscape, students face numerous logistical challenges that can detract from their primary focus: learning. From the difficulty of finding reliable study materials to the hassle of securing off-campus housing or simply ordering a meal during a busy schedule, these friction points create unnecessary stress.

**CampusConnect** addresses these issues by offering a holistic solution:
1.  **Unified Communication:** A real-time chat system that allows students to join public and private rooms, fostering collaboration and community building.
2.  **Academic Resource Sharing:** A structured "Notes" section where students can upload and download study materials, incentivized by a credit reward system.
3.  **Accommodation Finder:** A "Rent/Property" module that simplifies the search for housing by allowing users to browse and list properties with images and details.
4.  **Campus Dining:** A "Food Ordering" system that digitizes canteen menus, enabling students to order meals online and track their status.

## B. Core Objectives
The primary objectives of CampusConnect are:
1.  **Centralization:** To consolidate disparate campus services into one accessible web application.
2.  **Collaboration:** To facilitate peer-to-peer learning and communication through chat and note sharing.
3.  **Convenience:** To simplify daily tasks like finding housing and ordering food.
4.  **Incentivization:** To encourage active participation (e.g., uploading notes) through a gamified credit system.

## C. Problem Statement
Currently, students rely on a mix of informal WhatsApp groups, physical notice boards, and word-of-mouth to navigate campus life. This leads to:
*   **Information Asymmetry:** Important notes or announcements are missed.
*   **Inefficiency:** Finding a PG or ordering food involves physical travel or phone calls.
*   **Lack of Verification:** Housing listings or study materials may be unreliable.

CampusConnect solves this by providing a verified, digital, and organized platform for these needs.

---

# III. PROJECT IMPLEMENTATION

## A. Module-wise Functionality

### 1. Authentication & User Management
*   **Registration/Login:** Secure user onboarding with email and password.
*   **Profile Management:** Users can view their details and accumulated credits.
*   **Security:** CSRF protection and session management.

### 2. Chat Room System
*   **Real-time Messaging:** Powered by Pusher and Laravel Broadcasting.
*   **Room Management:** Support for Public (open to all) and Private (invite-only) rooms.
*   **Membership:** Users can join/leave rooms; creators have admin privileges.

### 3. Notes Section
*   **Upload & Share:** Students upload notes categorized by department.
*   **Credit System:** Users earn credits (e.g., 50 credits) upon admin approval of their notes.
*   **Access:** Easy search and download of approved notes.

### 4. Rent / Property Section
*   **Listings:** Users can list properties with descriptions, prices, and images.
*   **Browsing:** A visual interface for students to find accommodation.
*   **Management:** Admins can moderate listings.

### 5. Food Ordering System
*   **Digital Menu:** View items from various campus outlets.
*   **Cart & Order:** Add items to cart and place orders.
*   **Order Tracking:** Monitor order status (Pending, Preparing, Ready).
*   **Discounts:** Redeem earned credits for discounts on food orders.

## B. System Architecture and Design
The application follows the **Model-View-Controller (MVC)** architectural pattern provided by the Laravel framework.
*   **Model:** Represents the data structure (Users, Messages, Notes, etc.) and business logic.
*   **View:** The user interface built with Blade templates and Bootstrap, ensuring a responsive design.
*   **Controller:** Handles user requests, processes data via Models, and returns the appropriate Views.

## C. Database Table Structure
The system uses a relational database (MySQL) with the following core tables:

| Table Name | Description | Key Columns |
| :--- | :--- | :--- |
| `users` | Stores user account info. | `id`, `name`, `email`, `password`, `credits` |
| `chat_rooms` | Manages chat rooms. | `id`, `room_name`, `type`, `created_by` |
| `messages` | Stores chat messages. | `id`, `room_id`, `user_id`, `message_text` |
| `chat_members` | Links users to rooms. | `id`, `room_id`, `user_id`, `is_admin` |
| `notes` | Stores uploaded study notes. | `id`, `user_id`, `title`, `file_path`, `status` |
| `rents` | Property listings. | `id`, `user_id`, `title`, `price`, `description` |
| `food_orders` | Manages food orders. | `id`, `user_id`, `total_amount`, `status` |
| `order_items` | Items within an order. | `id`, `order_id`, `menu_item_id`, `quantity` |

## D. Entity-Relationship (ER) Diagram
*   **User - ChatRoom:** Many-to-Many (via `chat_members`).
*   **User - Message:** One-to-Many (A user sends many messages).
*   **ChatRoom - Message:** One-to-Many (A room has many messages).
*   **User - Note:** One-to-Many (A user uploads many notes).
*   **User - Rent:** One-to-Many (A user lists many properties).
*   **User - FoodOrder:** One-to-Many (A user places many orders).
*   **FoodOrder - OrderItem:** One-to-Many.

## E. Use Cases
1.  **Student Registration:** A new student signs up to access the platform.
2.  **Joining a Chat:** A student joins the "Computer Science" public room to discuss assignments.
3.  **Uploading Notes:** A student uploads a PDF of lecture notes. Once approved by admin, they receive 50 credits.
4.  **Finding a PG:** A student browses the "Rent" section, views photos of a room, and contacts the owner.
5.  **Ordering Lunch:** A student selects a burger from the canteen menu, applies 10 credits for a discount, and places the order.

## F. Detailed Implementation
The backend is built with **Laravel 10**, leveraging its robust ecosystem.
*   **Routing:** Defined in `web.php` to handle all page requests.
*   **Controllers:** `ChatController`, `NotesController`, `RentController`, `FoodController` manage the logic.
*   **Frontend:** **Blade** templates utilize **Bootstrap** for layout and **jQuery** for dynamic interactions (like AJAX for chat).
*   **Real-time:** **Pusher** integration ensures chat messages appear instantly without refreshing.

## G. Technology Stack
*   **Backend:** Laravel 10 (PHP 8.2)
*   **Frontend:** Blade Templates, Bootstrap 5, jQuery
*   **Database:** MySQL
*   **Real-time:** Pusher / Laravel Broadcasting
*   **Server:** Apache/Nginx (Localhost via Artisan Serve)

## H. Sample Code Snippets

**ChatController.php (Message Storage)**
```php
public function storeMessage(Request $request, ChatRoom $room)
{
    $data = $request->validate([
        'message_text' => 'required|string|max:2000',
    ]);

    // Ensure the user is a member
    $isMember = ChatMember::where('room_id', $room->id)
        ->where('user_id', Auth::id())
        ->exists();

    if (! $isMember) {
        return redirect()->route('chat.index')
            ->with('error', 'You are not a member of that room.');
    }

    $message = Message::create([
        'room_id' => $room->id,
        'user_id' => Auth::id(),
        'message_text' => $data['message_text'],
    ]);

    // Broadcast the message
    broadcast(new MessageSent($message))->toOthers();

    return redirect()->route('chat.rooms.show', $room);
}
```

## I. Application Screenshots
*[Insert Screenshots of Login Page, Dashboard, Chat Room, and Food Menu here]*

---

# V. CONCLUSION AND OUTLOOK

## A. Conclusion and Future Enhancements
CampusConnect has successfully established a functional MVP that addresses key student needs. The platform effectively bridges the gap between students and campus services.

**Future Enhancements:**
1.  **Mobile App:** Developing a native mobile application for better accessibility.
2.  **Payment Gateway:** Integrating online payments for food orders and rent deposits.
3.  **AI Chatbot:** Adding an AI assistant to answer common campus queries.
4.  **Notification System:** Push notifications for new messages and order updates.

## B. Summary of Main Findings
The development process highlighted the importance of modular architecture. By separating concerns (Chat, Notes, Rent), the application remains scalable. The integration of real-time features (Chat) significantly boosts user engagement compared to static boards.

## C. Implications of the Study
This project demonstrates how digital transformation can optimize university ecosystems, saving time for students and providing administrators with better oversight of campus activities.

---

# VI. REFERENCES
*   **Laravel Documentation:** https://laravel.com/docs
*   **Bootstrap Documentation:** https://getbootstrap.com/docs
*   **Pusher API:** https://pusher.com/docs
*   **PHP Manual:** https://www.php.net/manual/en/

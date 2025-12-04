
1 
 
CampusConnect - Smart Campus Utility Platform 
 
A mini project report on CampusConnect submitted in partial fulfilment of  
Master of Computer Applications-Web Application Development. 
 
Submitted By: - 
 
 
 
ROLL No. 
 
SIC No. 
 
NAME 
 
-- 
 
-- 
 
ADITYA PRAKASH 
 
-- 
 
-- 
 
ASHUTOSH DASH 
 
-- 
 
-- 
 
RITESH SINGH 
 
 
 
 Submitted to: 
 [Faculty Name]  
 
University Name: - [University Name] 
Department Name: - Master of Computer Application 
Academic Year: - 2025-26 
  
2 
 
 
TABLE AND CONTENT 
 
Contents Page No. 
 
1. Introduction 
 
03 
 
2. Proposed System 
 
04-05 
 
3. System Design 
 
06-07 
 
4. Implementation 
 
08-16 
 
5. Screenshots 
 
17-21 
 
      6. Conclusion 
 
22 
 
7. Reference 
 
22 
 
 
 
 
 
 
 
 
 
 
 
3 
 
1. INTRODUCTION 
The modern university campus is a complex ecosystem where students must balance academic responsibilities with social engagement and daily living needs. Traditionally, these aspects of campus life are managed through fragmented, manual, or disconnected systems. Students often rely on physical notice boards for academic updates, stand in long queues for canteen food, and depend on unverified word-of-mouth information for finding accommodation. This lack of integration leads to inefficiencies, wasted time, and a suboptimal campus experience.

"CampusConnect" is a comprehensive, web-based solution designed to bridge these gaps by providing a unified digital platform. It serves as a central hub where students can collaborate academically, manage their daily necessities, and stay connected with the campus community. The application integrates four core modules: a Note Sharing repository for academic collaboration, a Real-time Chat system for instant communication, a Food Ordering system for campus canteens, and a Rent/Accommodation finder.

The project is built using the Laravel PHP Framework (Version 10), leveraging its robust MVC (Model-View-Controller) architecture to ensure a secure, scalable, and maintainable backend. The frontend is crafted using Blade Templates, HTML5, CSS3, and Bootstrap 5, delivering a responsive and visually appealing user interface. Real-time features, such as the chat system, are powered by Laravel Broadcasting and Pusher, enabling instant message delivery. Data management is handled by MySQL, ensuring efficient storage and retrieval of user profiles, academic notes, orders, and property listings.

The primary objective of CampusConnect is to digitalize and streamline campus life. By adopting this online approach, students can access study materials from anywhere, order food without waiting in lines, find housing easily, and communicate effectively with peers, thereby enhancing their overall university experience.
 
4 
 
2. PROPOSED SYSTEM 
The proposed CampusConnect system aims to automate and centralize various student activities that are currently fragmented. Instead of relying on physical notice boards or separate apps, students can access everything they need through a single web portal. The system introduces a credit-based gamification model where students earn credits for contributing (e.g., uploading notes, listing properties) and can redeem them for benefits (e.g., food discounts). 
 
       OBJECTIVE: - 
1.  To provide a unified platform for academic and non-academic campus activities. 
2. To facilitate peer-to-peer academic support through a note-sharing repository. 
3. To enable real-time communication among students via public and private chat rooms. 
4. To streamline the food ordering process from campus canteens, reducing wait times. 
5. To assist students in finding suitable accommodation through a verified listing system. 
6. To implement a role-based access control system for Students and Administrators. 
7. To ensure data security and integrity using modern web standards. 
8. To encourage student participation through a reward-based credit system. 
9. To provide a responsive interface accessible across desktops, tablets, and mobile devices.
10. To simplify administrative tasks such as note approval and order management.

MODULE WISE FUNCTIONALITY: - 
❖ User Module (Student) 
This module handles all operations for the student end-users. 
 
Functionality Description 
Login/Register Secure authentication system for students to access the portal. 
Note Sharing Upload study materials (PDFs/Docs) and view notes shared by 
others. Earn credits for approved uploads. 
Chat Room Join department or interest-based chat rooms for real-time 
messaging with peers. 
Food Ordering Browse canteen menus, add items to cart, place orders, and 
track order status. 
Rent/PG Finder View available accommodation listings with photos and details. 
Post own listings to earn credits. 
 
❖ Admin Module 
This module is designed for system administrators to manage the platform. 
 
Functionality Description 
Dashboard Overview of system activity (users, orders, pending approvals). 
Manage Notes Review uploaded notes. Approve valid notes (awarding credits) 
or reject invalid ones. 
Manage Food Orders View incoming food orders and update their status (Received, Preparing, 
Ready). 
Manage Listings Monitor property listings and remove inappropriate content. 
User Management Manage student accounts and roles. 
 
 
 
6 
 
3. SYSTEM DESIGN 
TABLE STRUCTURE: - 
users table
- id (Primary Key)
- name (String)
- email (String, Unique)
- password (String)
- role (String, Default: 'student')
- credits (Integer, Default: 0)
- timestamps

notes table
- id (Primary Key)
- user_id (Foreign Key -> users)
- title (String)
- department (String)
- semester (String)
- subject (String)
- file_name (String)
- status (Enum: pending, approved, rejected)
- timestamps

rents table
- id (Primary Key)
- title (String)
- rent (Integer)
- location (String)
- amenities (Text)
- owner_name (String)
- phone (String)
- created_by (Foreign Key -> users)
- availability_status (String)
- approved (Boolean)
- timestamps

food_orders table
- id (Primary Key)
- user_id (Foreign Key -> users)
- restaurant_id (Foreign Key -> restaurants)
- total_amount (Integer)
- credits_used (Integer)
- status (String: received, preparing, ready)
- timestamps

chat_rooms table
- id (Primary Key)
- room_name (String)
- type (String: public/private)
- created_by (Foreign Key -> users)
- timestamps
 
 
7 
 
USE-CASE DIAGRAM: - 
 
[Student] --(Login/Register)--> [System] 
[Student] --(Upload Notes)--> [System] 
[Student] --(Search/Download Notes)--> [System]
[Student] --(Join Chat Room)--> [System]
[Student] --(Send Message)--> [System]
[Student] --(Browse Food Menu)--> [System]
[Student] --(Place Food Order)--> [System]
[Student] --(View Rent Listings)--> [System]
[Student] --(Post Rent Listing)--> [System]
 
[Admin] --(Login)--> [System]
[Admin] --(Approve/Reject Notes)--> [System] 
[Admin] --(Manage Food Orders)--> [System] 
[Admin] --(Manage Rent Listings)--> [System]
[Admin] --(View Dashboard Stats)--> [System]
 
 
8 
 
4. IMPLEMENTATION 
TECHNOLOGY STACK: -  
• HTML5 (Hyper Text Markup Language) 
• CSS3 (Cascading Style Sheet) 
• Bootstrap 5 (Frontend Framework) 
• JavaScript (Interactivity) 
• PHP 8.1+ (Server-side Scripting) 
• Laravel 10 (Web Application Framework)
• MySQL (Relational Database Management System)
• Pusher (Real-time WebSocket Service)

SAMPLE CODE : - 
1. Home.blade.php (Dashboard View)
```php
@extends('layouts.app')

@section('content')

    <div class="text-center py-5">

        <div class="mb-5">
            <h1 class="display-3 fw-bold mb-3">
                Welcome to <span class="text-primary-gradient">CampusConnect</span> 👋
            </h1>
            <p class="lead text-muted mb-4 mx-auto" style="max-width: 600px;">
                Your all-in-one student platform. Access notes, join chat rooms, order food, and find the perfect place to
                stay.
            </p>

            @auth
                <div class="glass-card d-inline-block px-4 py-2 mb-4">
                    <p class="mb-0 text-muted small">Logged in as</p>
                    <p class="mb-0 fw-bold">{{ auth()->user()->name }}</p>
                    <div class="mt-2 badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                        Credits: {{ auth()->user()->credit_balance }}
                    </div>
                </div>
            @endauth
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Notes Card -->
            <div class="col-md-6 col-lg-3">
                <div class="glass-card p-4 h-100 d-flex flex-column align-items-center transition-hover">
                    <h5 class="fw-bold mb-2">Notes Section</h5>
                    <p class="text-muted small mb-4">Upload and share study materials with your peers.</p>
                    <a href="{{ route('notes.view') }}" class="btn btn-outline-custom w-100 mt-auto">Browse Notes</a>
                </div>
            </div>
            <!-- Chat Card -->
            <div class="col-md-6 col-lg-3">
                <div class="glass-card p-4 h-100 d-flex flex-column align-items-center transition-hover">
                    <h5 class="fw-bold mb-2">Chat Room</h5>
                    <p class="text-muted small mb-4">Connect with students in public or private rooms.</p>
                    <a href="{{ route('chat.index') }}" class="btn btn-outline-custom w-100 mt-auto">Join Chat</a>
                </div>
            </div>
        </div>
    </div>
@endsection
```

2. Register.blade.php (User Registration)
```php
@extends('layouts.guest')
@section('title', 'Register')
@section('content')
    <div class="auth-wrapper">
        <div class="login-card text-center">
            <div class="logo-circle">CC</div>
            <h2 class="mt-3">CampusConnect</h2>
            <form action="{{ route('register.perform') }}" method="POST" class="mt-4">
                @csrf
                <input type="text" name="name" placeholder="Name" class="form-control mb-3" required>
                <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
                <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
                <button type="submit" class="btn-main">Register</button>
            </form>
            <a href="{{ route('login') }}" class="d-block mt-3">Already have an account? Login</a>
        </div>
    </div>
@endsection
```

3. Login.blade.php (User Login)
```php
@extends('layouts.guest')
@section('title', 'Login')
@section('content')
    <div class="auth-wrapper">
        <div class="login-card text-center">
            <div class="logo-circle">CC</div>
            <h2 class="mt-3">CampusConnect</h2>
            <form action="{{ route('login.perform') }}" method="POST" class="mt-4">
                @csrf
                <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
                <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
                <button type="submit" class="btn-main">Log In</button>
            </form>
            <a href="{{ route('register') }}" class="d-block mt-3">Don't have an account? Register</a>
        </div>
    </div>
@endsection
```

4. NotesController.php (Backend Logic)
```php
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function index()
    {
        $notes = Note::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('notes.view', compact('notes'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'department'  => 'required|string|max:255',
            'semester'    => 'required|string|max:255',
            'subject'     => 'required|string|max:255',
            'file'        => 'required|mimes:pdf|max:20480',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $file->move(public_path('uploads'), $fileName);

        Note::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'department'  => $request->department,
            'semester'    => $request->semester,
            'subject'     => $request->subject,
            'file_name'   => $fileName,
            'status'      => 'pending',
        ]);

        return redirect()->back()->with('success', 'Notes uploaded successfully!');
    }
}
```
 
17 
 
5. SCREENSHOTS 
Home.blade.php                         Register.blade.php 
 
Login.blade.php 
 
 
 
 
 
18 
 
Notes View                    Food Ordering 
Chat Room                               Rent Listings 
 
 
 
 
 
 
 
 
 
19 
 
Admin Dashboard 
20 
 
Admin Note Approval 
Order Management 
 
21 
 
User Profile 
 
  
 
22 
 
6. CONCLUSION 
The CampusConnect project successfully demonstrates the potential of a centralized digital platform in enhancing the university experience. By integrating disparate systems—academic collaboration, accommodation, and dining—into a single, user-friendly interface, the application significantly reduces the administrative burden on students and improves information accessibility. 
 
The use of modern web technologies like Laravel and Real-time broadcasting ensures that the system is robust, scalable, and responsive. The implementation of a credit-based reward system adds an innovative gamification layer that encourages active student participation and community building. 
 
Future enhancements for the system include the integration of a secure payment gateway for online food payments, a mobile application version for better accessibility, and AI-driven recommendations for study materials and food choices. The modular design ensures that these new features can be added with minimal disruption to the existing functionality. 
 
7. REFERENCE 
1. https://laravel.com/docs/10.x 
2. https://getbootstrap.com/docs/5.0/ 
3. https://pusher.com/docs/ 
4. https://www.w3schools.com/php/ 
5. https://www.w3schools.com/mysql/

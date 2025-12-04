<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# CampusConnect 🎓  
A platform built for university students to simplify campus life by providing a unified system for communication, notes sharing, property rentals, and food ordering.

---

## 📌 About the Project
CampusConnect is a full-stack web application designed to streamline student activities inside a university campus.  
The platform helps students connect, collaborate, access study materials, find accommodation, and even order food from campus canteens — all in one place.

---

## 🚀 Features Implemented So Far

### ⭐ 1. Chat Room System
- Students can join **public and private chat rooms**.
- Real-time messaging using events and Laravel broadcasting.
- Clean UI for chat interactions.
- Chatroom membership stored and handled through database models.

---

### ⭐ 2. Notes Section
- Notes are organized **department-wise**.
- Students can upload notes and earn **credits**.
- Admin approval flow:
  - Students upload notes
  - Admin views pending notes
  - Admin approves/rejects notes
- Credits awarded on approval.

(Current credit reward: **50 credits per approved property upload**.)

---

### ⭐ 3. Rent / Property Section
- Hero-banner style UI for property listings.
- Students and admins can **add new properties**.
- Admins can delete listings.
- Students can browse available PGs/rooms with images.
- Each listing supports multiple property images.
- Property uploader earns **50 credits per listing**.

---

### ⭐ 4. Food Ordering System
- Students can browse campus canteen outlets.
- View menu items with price.
- Add items to cart.
- Place orders directly inside the app.
- Admin/outlet owners can view all orders.
- Students can track order status.
- Credit-based discount system support.

---

## 🧩 Tech Stack
- **Laravel 10** (Backend)
- **Blade Templates** (Frontend)
- **MySQL** (Database)
- **Pusher / Laravel Broadcasting** (Chat system)
- **Bootstrap** (Frontend UI)
- **JavaScript** (Interactions)

---

## 📁 Project Structure (Important Folders)

app/
├─ Http/Controllers/ -> All controllers for chat, rent, food, auth, notes
├─ Models/ -> Chat, Notes, Rent, FoodOrder, Message, etc.
├─ Events/ -> Real-time message event

database/
├─ migrations/ -> Full DB schema for all features

resources/views/
├─ chat/ -> Chat UI
├─ notes/ -> Notes upload + view
├─ rent/ -> Rent pages
├─ food/ -> Food ordering interface
├─ layouts/ -> App structure

yaml
Copy code

---

## 🏆 Credit System (Updated Rules)
- Uploading a **property listing** → **+50 credits**
- Uploading **notes** (on approval) → **credits awarded**
- Credits can be used for food ordering discounts.

---

## 🛠️ Features Planned / Coming Soon
- Profile system
- Payment gateway (optional)
- Push notifications
- Live typing indicator in chat
- Improved admin dashboard

---

## 🤝 Contributing
Feel free to fork the repo and submit pull requests!

---

## 📬 Contact
Created by **Aditya Prakash, Ashutosh Dash, Ritesh Singh**  
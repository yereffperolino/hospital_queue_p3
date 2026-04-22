# Hospital Queue System - Beginner's Guide

## 📚 What You're Learning

This Laravel project uses 4 core concepts:

### 1. **Models** (`app/Models/`)
Your database tables as PHP objects. Each model represents one table:
- `Patient.php` - Patient information
- `Doctor.php` - Doctor information  
- `Department.php` - Hospital departments
- `Queue.php` - Patient queue in departments
- `Consultation.php` - Doctor-patient consultations
- `User.php` - User accounts (for login)

**What to do:** Study how models define relationships using `hasMany()`, `belongsTo()`, etc.

---

### 2. **Migrations** (`database/migrations/`)
Files that create and modify your database tables. They're like database blueprints.

**What to do:** Run `php artisan migrate` to create all tables.

---

### 3. **Routes** (`routes/web.php`, `routes/auth.php`)
URL paths that users visit. Maps URLs to controller methods.

**What to do:** When you type `http://localhost/queue`, it looks up the route and calls the right controller.

---

### 4. **Controllers** (`app/Http/Controllers/`)
Handle the business logic. They:
- Get data from Models
- Process it
- Pass it to Views (frontend)

**Key controllers:**
- `QueueController` - Manage patient queues
- `Doctor/ConsultationController` - Doctor sees consultations
- `Patient/PatientController` - Patient actions
- `Admin/DepartmentController` - Manage departments
- `Auth/*` - Login/Register (Breeze handles this)

---

### 5. **Views** (`resources/views/`)
Frontend - what users see. Written in Blade template language (HTML + PHP).

**What to do:** Learn how `{{ $variable }}` displays data from controllers.

---

### 6. **Blade Templates**
Special PHP template syntax:
- `{{ $variable }}` - Echo/display
- `@if`, `@foreach` - Logic
- `@csrf` - Security token for forms
- `@auth`, `@guest` - Check if logged in

---

## 🚀 Getting Started

1. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

2. **Set up database:**
   ```bash
   copy .env.example .env
   php artisan key:generate
   php artisan migrate
   ```

3. **Start dev server:**
   ```bash
   php artisan serve
   npm run dev
   ```

4. **Access the app:** Visit `http://localhost:8000`

---

## 📖 Study Order (Recommended)

1. Start with **Models** - Understand data structure
2. Learn **Migrations** - How data is stored
3. Study **Routes** - How URLs map to code
4. Explore **Controllers** - Business logic
5. Build **Views** - Frontend Blade templates
6. Connect everything together

---

## ❌ What Was Removed (Advanced Features)

- `tests/` - Unit testing (advanced)
- `database/seeders/` - Fake data generation (advanced)
- `database/factories/` - Data factories (advanced)

You don't need these to learn the basics!

---

## 💡 Pro Tips

- Use `php artisan tinker` to test queries in the terminal
- Check `routes/web.php` to see all available routes
- Study one controller completely before moving to the next
- Read error messages carefully - they help you learn

---

Good luck learning! 🎓

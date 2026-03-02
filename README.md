# 📚 LaraBook - Library Management System

**Created by: Arslan Solehria**  
**Date: February 2026**  
**Framework:** Laravel 12.52.0 + Vuexy Admin Template  
**PHP Version:** 8.2.12

---

## ✨ Features Overview

### 🔐 Complete Authentication System
- ✅ User Registration with Email Verification
- ✅ User Login with Session Management
- ✅ Forgot Password with OTP System
- ✅ Password Reset via Email
- ✅ Logout Functionality

### 📧 Email Notifications (Mailtrap Integration)
- ✅ **Welcome Email** - Sent on successful registration
- ✅ **Password Reset Email** - OTP code for password recovery
- ✅ **Password Updated Email** - Confirmation after password change

### 📖 Books Management (Full CRUD)
- ✅ **Add Books** - Create new book entries
- ✅ **View Books** - List all books (user-specific filtering)
- ✅ **Edit Books** - Update book details
- ✅ **Delete Books** - Remove books from library
- ✅ **User Ownership** - Each user sees only their own books

### 👤 Profile Management
- ✅ **View Profile** - Display user information
- ✅ **Update Password** - Change password with current password verification
- ✅ **Email Confirmation** - Get notified when password changes

---

## 🎯 Teacher Requirements (All Completed!)

### Authentication
- [x] Signup with email validation
- [x] Signin with credentials
- [x] Welcome email on registration
- [x] Forgot password functionality
- [x] OTP/Token via email
- [x] Reset password screen
- [x] Password update confirmation email

### CRUD Operations
- [x] Books management
- [x] User-specific data (only show user's own books)
- [x] Add, Edit, Delete, View operations

### Profile Management
- [x] Update password from profile
- [x] Current password + new password validation
- [x] Email notification on password change

---

## 🚀 Quick Setup Guide

### Prerequisites
```
✅ PHP 8.1 or higher
✅ Composer
✅ Node.js 16+ and NPM
✅ SQLite (included) or MySQL
```

### Installation Steps

#### 1. Extract Project
```bash
# Extract the ZIP file to your desired location
# Navigate to project directory
cd Vuexy-Library-Auth
```

#### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

#### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 4. Configure Database
The project uses SQLite by default (already configured).

**No additional database setup needed!**

For MySQL (optional):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=larabook
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Configure Email (Mailtrap)
Edit `.env` file:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@larabook.com"
MAIL_FROM_NAME="LaraBook"
```

**Get free Mailtrap account:** https://mailtrap.io

#### 6. Run Database Migrations
```bash
php artisan migrate
```

#### 7. Create Storage Link
```bash
php artisan storage:link
```

#### 8. Start Development Servers
```bash
# Terminal 1 - Laravel Server
php artisan serve

# Terminal 2 - Frontend Assets (if needed)
npm run dev
```

#### 9. Access Application
```
🌐 URL: http://localhost:8000
📧 Default: Register new account
```

---

## 📖 Usage Guide

### First Time Setup

1. **Register Account**
   - Go to: http://localhost:8000/register
   - Fill in: Name, Email, Password
   - Check Mailtrap for welcome email ✉️

2. **Login**
   - Use registered credentials
   - Access dashboard

3. **Add Books**
   - Click "Add Book" or "My Books"
   - Fill in book details
   - Save to library

4. **Manage Profile**
   - Click profile/settings
   - Update password if needed
   - Check email for confirmation

### Testing Forgot Password

1. Click "Forgot Password?" on login
2. Enter registered email
3. Check Mailtrap for OTP code
4. Enter OTP + new password
5. Login with new password

---

## 🗂️ Project Structure

```
Vuexy-Library-Auth/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php         # Authentication logic
│   │   ├── BookController.php         # Books CRUD
│   │   └── ProfileController.php      # Profile management
│   ├── Mail/
│   │   ├── WelcomeEmail.php          # Welcome email
│   │   ├── ResetPasswordEmail.php    # OTP email
│   │   └── PasswordUpdatedEmail.php  # Password change email
│   └── Models/
│       ├── User.php                   # User model
│       └── Book.php                   # Book model
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_books_table.php
│   │   └── create_password_resets_table.php
│   └── database.sqlite                # SQLite database
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   ├── forgot-password.blade.php
│       │   └── reset-password.blade.php
│       ├── books/
│       │   ├── index.blade.php        # Books list
│       │   ├── create.blade.php       # Add book
│       │   └── edit.blade.php         # Edit book
│       ├── emails/
│       │   ├── welcome.blade.php
│       │   ├── reset-password.blade.php
│       │   └── password-updated.blade.php
│       ├── profile/
│       │   └── index.blade.php        # Profile page
│       └── dashboard.blade.php
├── routes/
│   └── web.php                        # All application routes
├── public/
│   └── assets/                        # Vuexy template assets
├── .env.example                       # Environment template
├── composer.json                      # PHP dependencies
├── package.json                       # Node dependencies
└── README.md                          # This file
```

---

## 🎨 Tech Stack

### Backend
- **Framework:** Laravel 12.52.0
- **PHP:** 8.2.12
- **Database:** SQLite (default) / MySQL (optional)
- **Authentication:** Laravel built-in

### Frontend
- **Template:** Vuexy Admin Template
- **CSS Framework:** Bootstrap 5
- **Icons:** Bootstrap Icons

### Email
- **Service:** Mailtrap (SMTP)
- **Templates:** Blade (HTML emails)

---

## 📊 Database Schema

### Users Table
```sql
- id (Primary Key)
- name
- email (Unique)
- password (Hashed)
- created_at
- updated_at
```

### Books Table
```sql
- id (Primary Key)
- title
- author
- description
- image
- price
- stock
- user_id (Foreign Key → users)
- created_at
- updated_at
```

### Password Resets Table
```sql
- id (Primary Key)
- email
- token (OTP)
- created_at
```

---

## 🔒 Security Features

- ✅ Password Hashing (Bcrypt)
- ✅ CSRF Protection on all forms
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ XSS Protection (Blade templating)
- ✅ Session Management
- ✅ OTP Expiry (15 minutes)
- ✅ User-specific data isolation

---

## 🧪 Testing

### Manual Testing Checklist

**Authentication Flow:**
```
✅ Register → Welcome Email
✅ Login → Dashboard Access
✅ Logout → Redirect to Login
✅ Forgot Password → OTP Email
✅ Reset Password → Success Message
✅ Invalid Credentials → Error Message
```

**Books CRUD:**
```
✅ Add Book → Success & List Updated
✅ View Books → Only user's books shown
✅ Edit Book → Changes Saved
✅ Delete Book → Removed from List
✅ User Isolation → Can't see other users' books
```

**Profile Management:**
```
✅ View Profile → User Info Displayed
✅ Update Password → Email Sent
✅ Wrong Current Password → Error
✅ Password Mismatch → Validation Error
```

---

## 🐛 Troubleshooting

### Common Issues

**1. 419 Page Expired Error**
```bash
php artisan config:clear
php artisan cache:clear
```

**2. Email Not Sending**
- Check Mailtrap credentials in `.env`
- Verify MAIL_MAILER=smtp
- Test connection in Mailtrap dashboard

**3. Database Migration Errors**
```bash
php artisan migrate:fresh
```

**4. Storage Link Issues**
```bash
php artisan storage:link
```

**5. Routes Not Working**
```bash
php artisan route:clear
php artisan config:clear
```

---

## 📝 API Endpoints

### Authentication Routes
```
GET  /login                    - Login page
POST /login                    - Login submit
GET  /register                 - Register page
POST /register                 - Register submit
POST /logout                   - Logout
GET  /forgot-password          - Forgot password page
POST /forgot-password          - Send OTP
GET  /reset-password           - Reset password page
POST /reset-password           - Update password
```

### Books Routes (Protected)
```
GET  /books                    - List all books
GET  /books/create             - Add book form
POST /books                    - Store new book
GET  /books/{id}/edit          - Edit book form
PUT  /books/{id}               - Update book
DELETE /books/{id}             - Delete book
```

### Profile Routes (Protected)
```
GET  /profile                  - Profile page
POST /profile/update-password  - Update password
```

---

## 🎓 Learning Points

### Laravel Concepts Covered
1. ✅ **MVC Architecture** - Models, Views, Controllers
2. ✅ **Eloquent ORM** - Database queries
3. ✅ **Blade Templates** - Frontend rendering
4. ✅ **Migrations** - Database version control
5. ✅ **Authentication** - User management
6. ✅ **Middleware** - Route protection
7. ✅ **Mailable Classes** - Email handling
8. ✅ **Form Validation** - Input validation
9. ✅ **CSRF Protection** - Security
10. ✅ **Relationships** - User-Book association

---

## 📧 Contact & Support

**Developer:** Arslan Solehria  
**Email:** m.arslanliaqat8787@gmail.com  
**Date:** February 2026  
**Version:** 1.0.0

---

## 📄 License

This project is created for educational purposes.

---

## 🎉 Acknowledgments

- **Laravel Framework** - Excellent PHP framework
- **Vuexy Template** - Beautiful admin template
- **Mailtrap** - Email testing service
- **Bootstrap** - CSS framework

---

## 🚀 Future Enhancements (Optional)

- [ ] Book categories
- [ ] Book images upload
- [ ] Advanced search & filters
- [ ] Reading list/wishlist
- [ ] Book reviews & ratings
- [ ] Export data to PDF
- [ ] Email verification
- [ ] Social login

---

**© 2026 Arslan Solehria - LaraBook Project**

**Built with ❤️ using Laravel & Vuexy**

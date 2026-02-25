# Sheikh Russel Digital Lab Online Application (SRDLApp)

A full-stack web application built with **Laravel (PHP Framework)** to manage online applications and administrative workflows for the Sheikh Russel Digital Lab initiative.

---

## 📌 Overview

SRDLApp is designed to streamline the digital application process by allowing users to submit applications online while enabling administrators to review, verify, manage, and export application data efficiently.

The system follows Laravel’s MVC architecture and applies structured backend logic, validation, and role-based access control.

---

## 🚀 Features

- RESTful architecture following MVC pattern
- Secure authentication & authorization
- Role & Permission Management (Spatie)
- Admin dashboard (AdminLTE)
- Excel export functionality
- PDF generation support
- QR code integration
- Form validation and structured data handling
- MySQL database integration

---

## 🧱 Tech Stack

### Backend
- PHP
- Laravel
- Eloquent ORM
- MySQL

### Frontend
- Blade Templating Engine
- Bootstrap
- jQuery
- Axios

### Dev Tools
- Composer
- npm
- Laravel Mix

### Major Packages
- spatie/laravel-permission
- spatie/laravel-tags
- maatwebsite/excel
- barryvdh/laravel-dompdf
- simplesoftwareio/simple-qrcode
- AdminLTE Templates

---

## 📂 Project Structure

```
srdlapp/
│
├── app/                # Core application logic
├── resources/views/    # Blade templates
├── routes/             # Web & API routes
├── database/           # Migrations & seeders
├── public/             # Public assets
├── package.json        # Frontend dependencies
└── composer.json       # Backend dependencies
```

---

## ⚙️ Installation

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/riasat97/srdlapp.git
cd srdlapp
```

### 2️⃣ Install Backend Dependencies
```bash
composer install
```

### 3️⃣ Install Frontend Dependencies
```bash
npm install
```

### 4️⃣ Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials.

### 5️⃣ Run Database Migrations
```bash
php artisan migrate
```

### 6️⃣ Compile Frontend Assets
```bash
npm run dev
```

### 7️⃣ Start Development Server
```bash
php artisan serve
```

Application runs at:
```
http://127.0.0.1:8000
```

---

## 🧪 Running Tests

```bash
php artisan test
```

---

## 🛠 Development Scripts

```bash
npm run dev         # Development build
npm run watch       # Watch for file changes
npm run production  # Production optimized build
```

---

## 🔐 Security Practices

- CSRF Protection
- Input validation
- Role-based authorization
- Environment-based configuration
- Structured backend architecture

---

## 📈 Future Improvements

- API versioning
- CI/CD pipeline integration
- Cloud deployment (Azure / AWS)
- Advanced reporting dashboard
- Performance monitoring

---

## 👨‍💻 Author

Riasat Raihan Noor  
Full-Stack Developer 
Saskatchewan, Canada  

---

## 📄 License

This project is licensed under the MIT License.

---

⭐ If you find this project helpful, consider giving it a star!

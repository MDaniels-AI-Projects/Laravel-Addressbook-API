<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel 11 Address Book API: Full Development Journey

This repository contains a professional RESTful API built with **Laravel 11**. This project was developed as a comprehensive exercise in backend engineering, database management, and API lifecycle testing.

---

## 🛠️ Technical Skills Demonstrated

* **Frameworks**: Laravel 11 (Latest Version)
* **Languages**: PHP 8.4 (UK English Standards)
* **Tools**: Laravel Herd, TablePlus, Thunder Client, VS Code
* **Database**: MySQL via Laravel Migrations & Eloquent ORM
* **Version Control**: Git & GitHub
* **Security**: Mass Assignment Protection & Data Validation

---

## 🚀 Full Development Narrative & Instructions

### **1. Professional Environment Setup**
I established a modern development stack on Windows by installing **Laravel Herd**. This provided a high-performance environment including PHP 8.4 and Nginx without the need for manual configuration. To manage the database visually, I used **TablePlus**, and for API testing, I integrated the **Thunder Client** extension into **VS Code**. 

### **2. Framework Installation & Project Initialisation**
I used **Composer** to create the project by running:
`composer create-project laravel/laravel addressbook-api`

Once installed, I opened the project in VS Code and initialised **Git**. I created a repository on **GitHub**, linked it as my `origin` remote, and pushed my initial code to ensure the project was tracked from day one.

### **3. Database Configuration & Schema Design**
I created a MySQL database named `laravel_addressbook_api`. I then amended the `.env` file in the root directory to link Laravel to this database. To build the table, I used **Laravel Migrations**:
`php artisan make:migration create_contacts_table`

I amended the migration file to include columns for `name`, `email`, and `phone_number`, then executed `php artisan migrate` to build the physical table in MySQL.



### **4. Backend Logic & Controller Refactoring**
I created the `Contact` model and amended it with a `$fillable` array to enable **Mass Assignment Protection**. Next, I generated the controller:
`php artisan make:controller ContactController --api`

I then amended `routes/api.php` to include:
`Route::apiResource('contacts', ContactController::class);`

---

## 🛠️ Challenges & Troubleshooting (Where Things Went Wrong)

During development, I encountered two significant technical hurdles that required troubleshooting:

#### **Issue A: The "Cannot Redeclare Class" Error**
* **The Problem**: While writing the API logic, the application crashed with a fatal error stating it could not redeclare the Controller class. 
* **The Cause**: I discovered that I had accidentally pasted my `ContactController` logic into the base `app/Http/Controllers/Controller.php` file while also having a separate `ContactController.php` file. This caused a naming conflict within the Laravel namespace.
* **The Fix**: I opened the base `Controller.php` and stripped it back to its original abstract state. I then moved all specific address book logic into the dedicated `ContactController.php`, ensuring a clean inheritance structure.

#### **Issue B: Windows Port Conflicts**
* **The Problem**: The standard `php artisan serve` command failed to launch the server because port 8000 was being blocked or restricted by Windows system settings.
* **The Fix**: I identified that I could bypass this by manually specifying the host and port. I amended my workflow to run the server using:
`php -S 127.0.0.1:8000 -t public`
This ensured a stable connection for testing.

---

### **5. Live API Testing (The "Jane" Lifecycle)**
Using **Thunder Client** with the `Accept: application/json` header, I performed the following operations to verify the API logic:

* **POST (Adding Jane)**: I sent a POST request to `/api/contacts` with Jane Smith's name, email, and phone number. My code successfully validated and stored her record.
* **GET (Retrieving Jane)**: I used a GET request to `/api/contacts/1` to verify that the API could correctly fetch and display Jane's specific data using **Route Model Binding**.
* **PUT (Amending Jane)**: I tested the update logic by sending a PUT request to Jane's ID with an updated phone number. I verified in **TablePlus** that the record was changed instantly.
* **DELETE (Deleting Jane)**: Finally, I sent a DELETE request to remove Jane's entry. This confirmed the `destroy` method was working and the database was properly cleaned.



---

## 📡 API Endpoints Summary

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| **GET** | `/api/contacts` | List all contacts |
| **POST** | `/api/contacts` | Create a new contact |
| **GET** | `/api/contacts/{id}` | View a specific contact |
| **PUT** | `/api/contacts/{id}` | Update a contact |
| **DELETE** | `/api/contacts/{id}` | Delete a contact |

---

## 🚀 Phase 2: Enterprise Scaling & Data Integrity
Completed: 19th December 2025

In this phase, I transitioned the project from a basic functional test to a production-ready API structure, focusing on how applications handle large datasets and user error.

### Key Skills Demonstrated
- Database Seeding & Factories: Automated the generation of 50+ realistic records using the Faker library to simulate a production environment.
- Performance Optimisation (Pagination): Implemented chunked data loading (10 per page) to ensure the API remains fast as the database grows, reducing memory overhead.
- Advanced Eloquent Traits: Utilised the HasFactory trait within Models to bridge logic between the application and database testing layers.
- Server-Side Validation: Protected the MySQL database by enforcing strict rules on incoming data (unique emails, string lengths, and required fields).

---

## 🛠 Technical Implementation

### 1. Automated Data Blueprint (Factories)
I created a ContactFactory to simulate a real-world environment. This demonstrates an understanding of the Laravel ecosystem beyond simple manual CRUD.

PHP Example:

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
        ];
    }

---

### 2. Performance via Pagination
To satisfy the Performance Optimisation requirement in industry standards, I replaced all() with paginate(10). This provides metadata (links and total count) to frontend consumers like Vue.js.

Endpoint Example:

    GET /api/contacts?page=2

---

### 3. Request Validation Logic
Updated the ContactController to handle data integrity professionally. This ensures that no invalid or duplicate data enters the system.

PHP Validation Example:

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:contacts,email',
        'phone_number' => 'required|string|max:20',
    ]);

---

## 🚦 How to Run & Test

### Database Refresh & Seed
To reset the environment and generate the 50 professional test entries in one command:

    php artisan migrate:fresh --seed

---

### Testing in Thunder Client

Retrieve paginated contacts:

    GET http://127.0.0.1:8000/api/contacts

Observe the JSON structure containing the data array and the meta and links objects.

Retrieve page 3:

    GET http://127.0.0.1:8000/api/contacts?page=3

Verify that the API correctly retrieves the 3rd set of 10 unique records.

---

## 📂 Phase 1 Recap: Core Foundation

Framework: Laravel 11 / PHP 8.4  
Environment: Laravel Herd & MySQL  
Architecture: MVC (Model-View-Controller)  
API Pattern: RESTful CRUD (POST, GET, PUT, DELETE)  
Tools: TablePlus, Thunder Client, Git, GitHub  

---

## 🛠 Troubleshooting Log

Controller Conflict:
Resolved a "Cannot redeclare class" error by correctly managing namespaces and file naming conventions.

Model Traits:
Fixed a BadMethodCallException by implementing the HasFactory trait in the Contact Model to enable automated seeding.

---

## 📈 Next Steps

- [ ] Implement API Authentication using Laravel Sanctum to secure endpoints.
- [ ] Create a Vue.js frontend to consume these paginated endpoints.

## Phase 3: Addition of Secure Token-Based Authentication using Laravel Sanctum/Passport

# Laravel Address Book API

A modern, secure RESTful API built with **Laravel 11**, designed to demonstrate real-world backend development, authentication, and debugging practices.

---

## 🚀 Purpose & Benefits

The core objective of this project was to design and implement **secure token-based authentication** using **Laravel Sanctum**, following industry best practices for API development.

### Why Token-Based Authentication?

In modern applications, APIs are rarely consumed by just one website. They often serve:
- Single Page Applications (React, Vue)
- Mobile apps (iOS / Android)
- Third-party services

Token-based authentication solves the scalability and security limitations of traditional session-based logins.

Instead of storing user sessions on the server, the API issues a **Bearer Token** after login. This token acts as a secure “key” that the client presents with every request.

---

## 🔐 Benefits of Token-Based Authentication

### 1. Statelessness (Scalable by Design)

Traditional session-based authentication requires the server to *remember* users by storing session data.

**The Problem:**  
As an application grows and runs on multiple servers, all servers must share session storage, which increases complexity and slows performance.

**The Token Advantage:**  
With token authentication, the server does not store session data. Each request contains everything needed to verify the user.  
This allows:
- Horizontal scaling
- Load balancing
- Microservice architectures

Any server can handle any request independently.

---

### 2. Cross-Domain & Mobile Compatibility

Cookies are tightly coupled to browser behavior and domain rules.

**The Problem:**  
APIs hosted on one domain and frontends on another often face CORS and cookie restrictions — especially on mobile apps.

**The Token Advantage:**  
Tokens are sent via HTTP headers:



## 📚 Further Learning

This project follows the official [Laravel Documentation](https://laravel.com/docs). For further skills development, I utilised [Laracasts](https://laracasts.com) to ensure the code follows modern PHP and Laravel standards.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

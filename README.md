# GlamBook – Beauty Service Booking Website (PHP + MySQL)

A website where customers find hair, makeup, and spa services, and where salon owners can list their own services.

**Course:** SWE 6623 Software Engineering, Kennesaw State University. **Date:** Summer 2025 (July 2025). **Type:** Solo project.

## Overview

GlamBook connects customers with beauty professionals. A user can:

- **Register and log in** (passwords are hashed).
- **Browse services by category:** Hair, Makeup, Spa. Each service shows name, description, location, price, and duration.
- **List a service** ("Sell Your Service") as a salon or spa owner.
- **Fill in a booking form** with date and time, and see a success popup.
- **See a profile page** with their information.

I followed an **MVC** idea (Model-View-Controller: keep data code, page design, and form logic in separate parts):

- **Model:** PHP code that reads and writes the MySQL database (for example `php/Database.php`, `php/user.php`).
- **View:** HTML and CSS pages.
- **Controller:** PHP scripts that handle forms and sessions (for example `php/login.php`, `php/register.php`, `php/sell.php`).

The full report is in `docs/final-report.pdf`.

## What I did

This was a solo project, so I did all parts:

- Wrote the requirements and planned the features.
- Designed the MySQL database (users, services, appointments).
- Built registration, login, sessions, the header that changes after login, the service pages, and the "Sell Your Service" form.
- Tested and debugged the app (see "Problems I solved").

## Tech used

- PHP with **mysqli** and **prepared statements**
- MySQL / MariaDB through XAMPP and phpMyAdmin
- HTML, CSS, JavaScript, Google Fonts
- Day.js (date helper library) and SweetAlert2 (popup library)

## Database design

`GlamBook.sql` (phpMyAdmin export) creates 3 tables:

| Table | What it stores | Keys and rules |
|---|---|---|
| users | accounts: name, email, hashed password, phone, date of birth, username | PK `id`; **UNIQUE** `email` |
| services | services listed by owners: name, category, description, location, price, duration (minutes) | PK `id` |
| appointments | bookings: customer name and contact, category, location, time, date | PK `id`; `user_id` column for the user who booked |

Relationships: one user can have many appointments (`appointments.user_id` → `users.id`). This link is a column only; there is no foreign key constraint in the database. Adding one would be a good next step.

Other details: `price` is `DECIMAL(8,2)` (exact money values), and `created_at` uses `DEFAULT current_timestamp()` so MySQL fills in the time automatically.

## Key SQL

Users table with a UNIQUE email (from `GlamBook.sql`):

```sql
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
```

Register a user with a hashed password and a prepared statement (from `php/register.php`):

```php
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (name, email, phone, dob, username, password) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $email, $phone, $dob, $username, $password);
```

Log in with email **or** username (from `php/login.php`):

```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
$stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
```

Show the services of one category (from `php/hair.php`):

```sql
SELECT * FROM services WHERE category = 'Hair'
```

## Problems I solved

- **Session handling:** some pages forgot the logged-in user. The fix was to call `session_start()` at the top of every page that uses the session, before any HTML.
- **Database connection errors:** caused by wrong host or login details. The fix was to make sure MySQL was running and to use the XAMPP default user (`root`, no password).
- **Booking form not saving:** the prepared statement had the wrong `bind_param` setup. After checking the POST values and fixing the binding, it worked.

## How to run locally

1. Install XAMPP and start **Apache** and **MySQL**.
2. Copy this folder into `xampp/htdocs/` (for example `htdocs/glambook/`).
3. In phpMyAdmin, create a database named `GlamBook` and import `GlamBook.sql`.
4. The code connects to `localhost` as `root` with an empty password (see `php/Database.php`).
5. Open `http://localhost/glambook/php/index.php`, register, and log in.

## Known limitations

- In this version of the code, the booking page saves bookings in the browser (`localStorage`), and the profile page shows sample numbers. The `appointments` table exists in the database, but the current PHP code does not write to it.
- Some files are only partly connected (for example `php/LoginController.php` includes a `models/` folder that is not in the project).
- `php/sell.php` runs `htmlspecialchars()` before saving, so text like "&" is stored as `&amp;`. It is better to save the raw text and escape it only when showing it.
- Not built yet (from the report): admin panel, email/SMS reminders, online payment.

## What I learned

- How to design a small database and use UNIQUE keys to stop duplicate accounts.
- How to use prepared statements and password hashing in PHP.
- How sessions work, and why `session_start()` must come first.
- How to organize code with an MVC idea and debug a full app by myself.
- To be honest about what is finished and what is still a next step.

# ✈️ JMAR Flight Logs – Flight Tracker Dashboard

[![PHP](https://img.shields.io/badge/PHP-8.x-blue?logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.x-blue?logo=mysql)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?logo=bootstrap)](https://getbootstrap.com/)

JMAR Flight Logs is a lightweight PHP-MySQL web app for tracking flight data in an interactive dashboard. Users can filter flights by aircraft type, airline, or sort and order flight logs by various fields like pilot name, arrival, and departure date.

---

## 📦 Features

- 🔢 **Summary Dashboard**: Total Flights, Airlines, and Aircraft Types
- 🔍 **Filter Options**:
  - By Aircraft Type
  - By Airline Name
  - Sort by Airline, Aircraft, Pilot, Date, or Flight Number
  - Ascending / Descending Order
- 📋 **Flight Table**:
  - Displays filtered and sorted flight information
  - Responsive layout with Bootstrap
- 🔁 **Clear Filters**: Reset to default view
- ⚠️ **No Data Message**: Displays an error if no results match filters

---

## 📁 Tech Stack

| Tool             | Purpose                |
| ---------------- | ---------------------- |
| **PHP**          | Backend scripting      |
| **MySQL**        | Database and queries   |
| **Bootstrap**    | Responsive layout      |
| **HTML5/CSS3**   | Markup and styling     |
| **JavaScript**   | Optional interactivity |
| **Font Awesome** | Icons                  |

---

## ⚙️ How It Works

- User interacts with filters (airline, aircraft, sort, order).
- `process.php` handles logic for:
  - Filtering using `WHERE`
  - Sorting using `ORDER BY`
  - Counting totals for dashboard
- Results displayed in the dashboard cards and responsive flight table.
- If "Clear" is pressed, user is redirected to default view via `header('Location: index.php')`.

---

## 🚀 Getting Started

### 🔧 Requirements

- PHP >= 7.4
- MySQL or MariaDB
- Local server like XAMPP, WAMP, Laragon

### 🧪 Setup Instructions

1. **Clone or Download**

   ```bash
   git clone https://github.com/yourusername/jmar-flight-logs.git
   ```

2. **Import SQL**

   - Create a database named `jmar_flightlogs`
   - Import your `flightlogs.sql` table with required columns

3. **Configure Connection**

   - Edit `connect.php` with your database credentials.

4. **Run**
   - Start your local server and go to:
     ```
     http://localhost/jmar-flight-logs/
     ```

---

## 🧠 File Overview

```plaintext
├── index.php          # Main UI and dashboard
├── process.php        # Filtering and query handling logic
├── connect.php        # DB connection
├── head.php           # HTML <head> content
├── styles.css         # Custom CSS (optional)
├── pupairport.sql     # database

```

---


# ZIPPY ENTERPRISES PRIVATE LIMITED
## Production & Hostinger Deployment Guide
### Enterprise Construction Management Platform (₹10 Lakh Standard)

---

### 1. Overview & System Requirements

This platform has been engineered to run with 100% native compatibility on **Hostinger Web Hosting, Cloud Hosting, or VPS** (both cPanel and hPanel architectures) as well as any modern LAMP/LEMP stack.

| Component | Minimum Specification | Recommended Production |
|---|---|---|
| **Web Server** | Apache 2.4+ / Nginx (Hostinger Default) | Apache with `mod_rewrite`, `mod_deflate`, `mod_headers` |
| **PHP Version** | PHP 8.1+ | **PHP 8.2 or 8.3** (ZTS / FPM) |
| **Database** | MySQL 5.7+ / MariaDB 10.4+ / SQLite 3 | **MySQL 8.0+** |
| **PHP Extensions**| `pdo`, `pdo_mysql`, `curl`, `mbstring`, `fileinfo`, `json`, `session`, `openssl` | All standard on Hostinger |

---

### 2. Step-by-Step Hostinger Deployment (hPanel / cPanel)

#### Step 1: Create the MySQL Database on Hostinger
1. Log into your **Hostinger hPanel** dashboard.
2. Navigate to **Databases** -> **MySQL Databases**.
3. Create a new database:
   - **Database Name:** e.g., `u123456789_zippy`
   - **Username:** e.g., `u123456789_admin`
   - **Password:** Generate a strong password (e.g., `Zippy#Hyd@2026!`)
4. Note down these credentials.

#### Step 2: Import the Database Schema
1. Open **phpMyAdmin** for your new database from hPanel.
2. Click on the **Import** tab.
3. Choose the file located at: `database/schema.sql`.
4. Click **Go** / **Import**. All 13 relational tables and constraints will be instantiated.

#### Step 3: Upload Website Files to `public_html`
1. Navigate to **Files** -> **File Manager** in hPanel.
2. Open the `public_html` folder.
3. Upload all files and directories from this repository.
4. Ensure the `.htaccess` file is present in the root of `public_html`.

#### Step 4: Configure Database Credentials
Edit `config/config.php` using the Hostinger File Manager or set environment variables:
```php
define('DB_HOST', 'localhost'); // Hostinger standard
define('DB_DATABASE', 'u123456789_zippy');
define('DB_USERNAME', 'u123456789_admin');
define('DB_PASSWORD', 'Your_MySQL_Password_Here');
```

> **Note on Zero-Configuration Local & Fallback Engine:**
> If MySQL credentials are left unset or during local testing, the application's enterprise PDO layer automatically utilizes the persistent SQLite engine in `database/zippy_construction.sqlite` without throwing fatal errors!

#### Step 5: Configure Permissions
Ensure that the `uploads/` directory has write permissions (`0755` or `0775`):
- `uploads/docs/`
- `uploads/photos/`

---

### 3. Pre-Configured Enterprise Demo Accounts

| Role | Email Address | Password | Portal URL |
|---|---|---|---|
| **Enterprise Admin** | `admin@zippyenterprises.com` | `Admin@12345` | `/portal/admin/index.php` |
| **Accredited Builder** | `builder@kailashconstructions.com` | `Builder@12345` | `/portal/builder/index.php` |
| **Project Customer** | `rajesh.verma@example.com` | `Customer@12345` | `/portal/customer/index.php` |

---

### 4. Local Testing & Verification Command

To test the application instantly on your local environment without configuring Apache or MySQL:

```bash
cd "c:\Users\madya\OneDrive\ZIPPY TECH COMPANY WEBSITES\constructions solutions website"
php -S localhost:8000
```

Then visit:
- **Public Homepage:** `http://localhost:8000`
- **Cost Estimator:** `http://localhost:8000/cost-estimator.php`
- **Customer Portal:** `http://localhost:8000/portal/customer/index.php`
- **Contractor Portal:** `http://localhost:8000/portal/builder/index.php`
- **Admin Suite:** `http://localhost:8000/portal/admin/index.php`

---

### 5. Production Security Checklist

- [x] **CSRF Protection:** Double-submit cryptographically secure tokens on all mutation endpoints.
- [x] **SQL Injection Shield:** 100% prepared PDO statements with parameter binding.
- [x] **XSS Prevention:** Context-aware `htmlspecialchars` escaping on all user-supplied views.
- [x] **Role-Based Access Control (RBAC):** Strict middleware guards on Admin, Builder, and Customer suites.
- [x] **Directory Indexing Disabled:** `.htaccess` contains `Options -Indexes`.
- [x] **Config Guard:** Access to `config/`, `database/*.sql`, and `database/*.sqlite` is forbidden via `.htaccess`.
- [x] **SSL / HSTS Readiness:** Enabled for zero-downtime HTTPS routing.

# ZIPPY ENTERPRISES PRIVATE LIMITED
## Complete Hostinger Production Deployment Guide
### Domain: `zippyenterpriseconstructions.in` | Database: Hostinger MySQL

---

## 📌 Deployment Overview

- **Production Domain:** `https://zippyenterpriseconstructions.in` (and `https://www.zippyenterpriseconstructions.in`)
- **Hosting Provider:** Hostinger (Web Hosting, Cloud Hosting, or Business Web Hosting)
- **Control Panel:** Hostinger **hPanel**
- **Web Server:** Apache 2.4+ with PHP 8.2+
- **Database:** Hostinger MySQL 8.0+
- **Source Repository:** `https://github.com/zippytechsystems/Zippy-Enterprise-Construction-Solutions-website-.git` (Branch: `main`)

---

## 🚀 Step-by-Step Hostinger Deployment Procedure

### STEP 1: Point Your Domain to Hostinger Nameservers
If your domain `zippyenterpriseconstructions.in` was registered on Hostinger, DNS is configured automatically.  
If registered externally (GoDaddy, Namecheap, etc.), ensure Hostinger nameservers are active:
- `ns1.dns-parking.com`
- `ns2.dns-parking.com`

---

### STEP 2: Create Hostinger MySQL Database in hPanel

1. Log into your **Hostinger hPanel** (`https://hpanel.hostinger.com`).
2. Go to **Websites** -> Click **Manage** on `zippyenterpriseconstructions.in`.
3. In the left navigation, click **Databases** -> **MySQL Databases**.
4. Create a new database:
   - **MySQL Database Name:** e.g., `u123456789_zippy`
   - **MySQL Username:** e.g., `u123456789_admin`
   - **Password:** Set a strong password (e.g., `Zippy#2026!HydHost`)
5. Click **Create**.
6. **Note down these details** for Step 5:
   - **Database Host:** `localhost` *(Hostinger internal MySQL is always `localhost`)*
   - **Database Name:** *(e.g., `u123456789_zippy`)*
   - **Database User:** *(e.g., `u123456789_admin`)*
   - **Password:** *(the password you set)*

---

### STEP 3: Import `database/schema.sql` via phpMyAdmin

1. In hPanel, under **Databases** -> **MySQL Databases**, find your newly created database.
2. Click **Enter phpMyAdmin** next to the database name.
3. In phpMyAdmin, click on your database name in the left panel.
4. Click the **Import** tab at the top.
5. Click **Choose File** and select `database/schema.sql` from this repository.
6. Click the **Import** button at the bottom.
7. **Success:** All 4 production tables (`enquiries`, `loan_enquiries`, `projects`, `network_partners`) will be created.

*(Optional)*: To immediately seed landmark Hyderabad projects and verified partners, run the queries in `database/installer.php` or let the installer populate them on first page visit.

---

### STEP 4: Deploy Files to Hostinger `public_html`

You can deploy the website to Hostinger using either **Git** (recommended) or **File Manager**:

#### Method A: Automated Deployment via Hostinger Git (Recommended)
1. In hPanel, go to **Advanced** -> **Git**.
2. Click **Add New Repository**:
   - **Repository:** `https://github.com/zippytechsystems/Zippy-Enterprise-Construction-Solutions-website-.git`
   - **Branch:** `main`
   - **Directory:** `/public_html`
3. Click **Create**.
4. Click **Deploy**. Hostinger will pull the entire codebase automatically directly into `public_html`.
5. For future updates, simply click **Deploy** in the Git tab anytime you push to GitHub!

#### Method B: Manual Upload via Hostinger File Manager
1. In hPanel, click **Files** -> **File Manager**.
2. Go into the `public_html` folder.
3. Upload all files and folders from this repository.
4. Ensure `.htaccess` is uploaded (enable "Show Hidden Files" in File Manager settings if `.htaccess` is hidden).

---

### STEP 5: Update Database Credentials in `config/config.php`

1. In Hostinger File Manager (or via FTP), open `config/config.php`.
2. Locate the database configuration lines:
```php
define('DB_HOST', 'localhost');                    // Always localhost on Hostinger
define('DB_DATABASE', 'u123456789_zippy');         // Your Hostinger DB Name
define('DB_USERNAME', 'u123456789_admin');         // Your Hostinger DB User
define('DB_PASSWORD', 'Your_Hostinger_DB_Password');// Your Hostinger DB Password
```
3. Save the file.

---

### STEP 6: Activate Free SSL Certificate on Hostinger

1. In hPanel, go to **Security** -> **SSL**.
2. Select `zippyenterpriseconstructions.in`.
3. Click **Install SSL** (Hostinger provides lifetime free Let's Encrypt SSL).
4. Enable **Force HTTPS** toggle in hPanel.
   *(Our `.htaccess` already has built-in 301 HTTPS redirection for additional security)*.

---

### STEP 7: Configure Hostinger Corporate Email

1. In hPanel, go to **Emails** -> **Email Accounts**.
2. Create the two official company mailboxes:
   - `info@zippyenterpriseconstructions.in` (General corporate inquiries)
   - `sales@zippyenterpriseconstructions.in` (Lead notifications from the 10-field enquiry form)
3. Set strong passwords.
4. You can access webmail via `https://mail.hostinger.com` or connect to Gmail / Outlook via IMAP/SMTP.

---

### STEP 8: Verify Live Website

Visit:
- **Homepage:** `https://zippyenterpriseconstructions.in`
- **15 Solutions Directory:** `https://zippyenterpriseconstructions.in/services.php`
- **Villa Construction:** `https://zippyenterpriseconstructions.in/service-villa.php`
- **Independent Homes:** `https://zippyenterpriseconstructions.in/service-independent-house.php`
- **Projects Showcase:** `https://zippyenterpriseconstructions.in/projects.php`
- **Quotation Form:** `https://zippyenterpriseconstructions.in/quote.php`
- **Contact:** `https://zippyenterpriseconstructions.in/contact.php`

Test submitting a test enquiry on `quote.php` or `index.php`:
- Verify you receive an instant reference ID (e.g. `ZIP-ENQ-2026-XXXX`).
- Verify the lead saves to the `enquiries` table in phpMyAdmin.
- Verify the WhatsApp link pre-fills with the reference ID and customer details.

---

## 🔒 Security Configuration Checklist on Hostinger

- [x] **PHP Version:** Set to **PHP 8.2** or **8.3** in hPanel -> **Advanced** -> **PHP Configuration**.
- [x] **HTTPS Forced:** Enforced in both hPanel and `.htaccess`.
- [x] **File Permissions:** Files `0644`, Directories `0755`.
- [x] **Protected Directories:** Access to `config/`, `.sql`, `.sqlite`, `.git`, and `.env` is blocked by `.htaccess`.
- [x] **Directory Browsing Disabled:** `Options -Indexes` is active in `.htaccess`.
- [x] **Zero Fatal Errors:** Automatic SQLite fallback is available if MySQL is ever temporarily undergoing maintenance.

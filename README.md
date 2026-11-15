# ZIPPY ENTERPRISES PRIVATE LIMITED
## Enterprise Construction Management Platform & Corporate Portal

[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-Proprietary-D4AF37)](LICENSE)
[![Deployment](https://img.shields.io/badge/Deployment-Hostinger%20Ready-673AB7?logo=hostinger&logoColor=white)](HOSTINGER_DEPLOYMENT.md)

> **"Building Your Vision. Delivering Excellence."**  
> An enterprise-grade, high-value corporate construction solutions platform and management ecosystem for **Zippy Enterprises Private Limited**, Hyderabad.

---

## 🏛️ Executive Overview

Zippy Enterprises Private Limited is Hyderabad's premier construction solutions and building development corporation. This platform unifies commercial EPC execution, luxury residential construction, structural engineering coordination, and contractor network governance into a unified, digitized operating system.

### Key Highlights
- **Premium Corporate Design System:** Corporate Navy (`#0A192F`), Imperial Gold (`#D4AF37`), Charcoal Slate (`#1E293B`), and architectural typography.
- **22 Complete Core Pages:** Homepage, About Us, 14 Services, Project Showcase, Gallery, Builder Accreditation, Careers, Contact, Legal.
- **Interactive Construction Cost Estimator:** Real-time 4-step calculator with floor-wise breakdown, component distribution, and instant PDF quotation generation.
- **Proprietary 14-Stage Construction Lifecycle:** Standardized project governance from site inspection to occupancy handover with verified daily photo logs.
- **Three Dedicated Portals:**
  - 👤 **Client Self-Service Portal:** Live 14-stage tracker, milestone payments, blueprint downloads, site visit appointments.
  - 👷 **Builder / Contractor Hub:** Assigned sites, Scope of Work, daily progress logger, concrete cube test report uploads.
  - 🛡️ **Executive Administration Suite:** KPI analytics, CRM lead desk, project management, builder approvals, financial cashflow governance, CSV data exports, audit logs.
- **Self-Construction Loan Assistance:** Banking estimate preparation, document checklist, and Chartered Engineer valuation liaison for SBI, HDFC, and ICICI loans.

---

## 🚀 Quick Start (Local Run)

You can launch and test the entire platform instantly using PHP's built-in server with zero dependencies:

```bash
# Clone the repository
git clone https://github.com/zippytechsystems/Zippy-Enterprise-Construction-Solutions-website-.git
cd Zippy-Enterprise-Construction-Solutions-website-

# Start local server
php -S localhost:8000
```

Visit `http://localhost:8000` in your browser.

---

## 🔐 Pre-Configured Demo Credentials

| Role | Email Address | Password | Portal Access URL |
|---|---|---|---|
| **Executive Admin** | `admin@zippyenterprises.com` | `Admin@12345` | `/portal/admin/index.php` |
| **Accredited Builder** | `builder@kailashconstructions.com` | `Builder@12345` | `/portal/builder/index.php` |
| **Project Customer** | `rajesh.verma@example.com` | `Customer@12345` | `/portal/customer/index.php` |

---

## 🌐 Production Hostinger Deployment

1. **Upload Files:** Upload repository files to `public_html` via Hostinger File Manager or Git.
2. **Database:** Import `database/schema.sql` via phpMyAdmin on Hostinger.
3. **Configure:** Update MySQL credentials in `config/config.php`.
4. Detailed step-by-step instructions: see [HOSTINGER_DEPLOYMENT.md](HOSTINGER_DEPLOYMENT.md).

---

## 🏗️ 14-Stage Construction Execution Lifecycle

1. `Enquiry Received & Scope Review`
2. `Site Inspection & Soil Lab Testing`
3. `Requirements & Vastu Floor Plans Finalized`
4. `Detailed BOQ & Quantity Estimation`
5. `Quotation & Package Specifications Approved`
6. `Contract Agreement & GHMC/HMDA Sanction`
7. `Excavation & Raft Foundation Work`
8. `RCC Columns & Structural Slab Castings`
9. `Brickwork & AAC Block Masonry`
10. `MEP Concealed Electrical & Plumbing Piping`
11. `Wall Plastering & Waterproofing Tests`
12. `Flooring, Teakwood Joinery & Finishing`
13. `Final Quality Audit & Snagging Inspection`
14. `Key Handover Ceremony & Occupancy Warranty`

---

## 📁 Repository Directory Structure

```
├── assets/
│   ├── css/            # Custom luxury design system & portal stylesheets
│   ├── js/             # Main scripts, Cost Estimator engine, Portal logic
│   └── images/         # SVG vector logos, architectural visuals
├── config/
│   ├── config.php      # Corporate environment & database config
│   ├── database.php    # Enterprise PDO dual-driver (MySQL + SQLite fallback)
│   └── security.php    # CSRF tokens, RBAC guard, audit logger, XSS escaping
├── database/
│   ├── schema.sql      # Production MySQL 8 schema with 13 relational tables
│   └── installer.php   # Data seeder with realistic Hyderabad construction projects
├── includes/           # Header, Navigation, Footer, Portal Topbars & Sidebars
├── portal/
│   ├── admin/          # Executive Admin Suite (Leads, Projects, Builders, Finance, Reports)
│   ├── builder/        # Contractor Hub (Assigned Sites, Daily Progress, Test Docs)
│   └── customer/       # Client Self-Service (Tracker, Payments, Documents, Visits)
├── api/                # REST endpoints (calculate-cost, submit-enquiry, book-visit, loan-app)
├── index.php           # Corporate Homepage
├── cost-estimator.php  # Interactive Construction Cost Calculator & PDF Generator
├── .htaccess           # Hostinger Apache security headers, gzip, caching
├── sitemap.xml         # Production XML sitemap
└── robots.txt          # Search engine crawler policies
```

---

## 🛡️ Security & Quality Standards

- **CSRF Protection:** Cryptographic tokens on all POST requests.
- **SQL Injection Prevention:** 100% prepared PDO statements with bound parameters.
- **XSS Sanitization:** Strict context-aware HTML escaping (`e()`).
- **Role-Based Access Control (RBAC):** Middleware checks on every portal route.
- **Compliance Disclaimers:** Self-construction loan estimation facilitation without unauthorized banking claims.

---

### © 2026 Zippy Enterprises Private Limited. All Rights Reserved.
**Corporate Headquarters:** Level 4, Zippy Tech Tower, Road No. 36, Jubilee Hills, Hyderabad, Telangana 500033.  
**CIN:** U45200TG2020PTC145892 | **GSTIN:** 36AABCZ1234F1Z8

# ZIPPY ENTERPRISES PRIVATE LIMITED
## Premium Construction Solutions & Building Development Corporate Website

[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-Proprietary-D4AF37)](LICENSE)
[![Deployment](https://img.shields.io/badge/Deployment-Hostinger%20Ready-673AB7?logo=hostinger&logoColor=white)](HOSTINGER_DEPLOYMENT.md)

> **"Building Your Vision. Delivering Excellence."**  
> A world-class corporate portfolio website for **Zippy Enterprises Private Limited**, Hyderabad, engineered to position the company as an established, trustworthy, and premier construction solutions leader handling high-value residential and commercial developments.

---

## 🏛️ Corporate Overview

Zippy Enterprises Private Limited is a premier construction solutions and building development company based in Jubilee Hills, Hyderabad. This corporate portfolio website is engineered to attract serious residential, commercial, and apartment construction clients with complete transparency, uncompromising quality benchmarks, and high-converting lead generation workflows.

### Brand Identity & Design System
- **Deep Corporate Navy:** `#0A192F`
- **Imperial Gold:** `#D4AF37`
- **Charcoal Slate:** `#1E293B`
- **Pure White:** `#FFFFFF`
- **Light Grey Backgrounds:** `#F5F7FA`
- **Typography:** Plus Jakarta Sans & Playfair Display

---

## 🏗️ 19 Complete Core Website Pages

1. **Home (`index.php`):** 12 luxury corporate sections including full-screen architectural hero, About profile, 15 Solutions overview, Why Choose Us, Featured Projects, Network callout, 6-Step Working Process, Quality Standards, Testimonials, FAQ accordion, and 10-Field Enquiry form.
2. **About Us (`about.php`):** Corporate vision, mission, executive leadership (Er. R.K. Varma MD/CEO, Ar. Sneha Madhavan Principal Architect, Er. Vikram Rao CPO, A.N. Nambiar VP Banking), and IS code engineering benchmarks.
3. **Construction Solutions (`services.php`):** Comprehensive directory covering all 15 specialized construction and engineering capabilities.
4. **Residential Construction (`service-residential.php`):** Independent homes, duplexes, and multi-floor residences with 4 transparent package tiers (Classic ₹1,750, Premium ₹2,150, Luxury ₹2,850, Ultra-Luxury ₹3,650/sqft).
5. **Independent House Construction (`service-independent-house.php`):** Dedicated solutions for private plots, engineered foundations, 100% Vastu compliance, and rainwater harvesting.
6. **Villa Construction (`service-villa.php`):** Bespoke architectural estates, double-height living atriums, imported Statuario marble, infinity pools, and private hydraulic elevator shafts.
7. **Commercial Construction (`service-commercial.php`):** Grade-A corporate tech hubs, post-tensioned (PT) slabs, retail complexes, and integrated MEP engineering.
8. **Apartment Development (`service-apartment.php`):** High-density residential complexes, multi-level basement car parking, Fire NOC compliance, and Landowner Joint Venture (JV) models.
9. **Turnkey Construction (`service-turnkey.php`):** Concept-to-keys single-point accountability, fixed-price contracts (zero escalation), and guaranteed handover dates.
10. **Construction Consultancy (`service-consultancy.php`):** Architectural space planning, 3D BIM, STAAD-Pro structural finite-element modeling, and Project Management Consultancy (PMC).
11. **Self-Construction Loan Assistance (`loan-assistance.php`):** Bank-compliant BOQ preparation, municipal sanction synchronization, and Chartered Engineer valuation liaison for SBI, HDFC, ICICI, and Axis Bank.
12. **Our Projects (`projects.php`):** Filterable portfolio (All, Residential, Independent Houses, Luxury Villas, Commercial, Apartments, Ongoing, Completed) with detailed specifications.
13. **Project Gallery (`gallery.php`):** Visual showcase of architectural elevations, structural framing milestones, and finished luxury interiors.
14. **Our Professional Network (`network.php`):** Verified ecosystem of builders, civil engineers, chartered architects, structural consultants, material suppliers, and interior designers.
15. **Request a Quotation (`quote.php`):** Dedicated page featuring the complete 10-Field Enquiry System and a 6-step consultation briefing roadmap.
16. **Contact Us (`contact.php`):** Corporate headquarters in Nacharam, direct telephone lines, official email desks, interactive Google Maps, and direct message form.
17. **Privacy Policy (`privacy-policy.php`):** Corporate data confidentiality and GDPR/IT Act compliance.
18. **Terms & Conditions (`terms.php`):** Legal scope of estimations, milestone governance, and Telangana jurisdiction.

---

## 📋 Comprehensive 10-Field Enquiry System

All enquiry forms on the website capture the 10 critical parameters required for accurate construction estimation:
1. Full Name
2. Mobile Phone Number
3. Email Address
4. Project Location in Hyderabad
5. Construction Type (Residential, Villa, Commercial, Apartment, Turnkey, Consultancy, Loan Assistance)
6. Plot Size & Dimensions
7. Built-Up Area (Sq.Ft)
8. Number of Floors (G, G+1, G+2, G+3, Multi-Storey)
9. Approximate Budget
10. Specific Project Requirements / Notes

Every submission generates an automatic reference ID (e.g. `ZIP-ENQ-2026-XXXX`), saves to the database, dispatches an email alert to `sales@zippyenterpriseconstructions.in`, and provides an instant one-click WhatsApp pre-filled connection for immediate engagement.

---

## 🚀 Quick Start (Local Run)

Launch and test the website using PHP's built-in server with zero dependencies (automatic SQLite fallback):

```bash
# Clone the repository
git clone https://github.com/zippytechsystems/Zippy-Enterprise-Construction-Solutions-website-.git
cd Zippy-Enterprise-Construction-Solutions-website-

# Start local server
php -S 127.0.0.1:8000
```

Open `http://127.0.0.1:8000` in your web browser.

---

## 🌐 Production Hostinger Deployment

1. **Upload Files:** Upload repository files to `public_html` via Hostinger File Manager or Git.
2. **Database:** Import `database/schema.sql` via phpMyAdmin on Hostinger.
3. **Configure:** Update MySQL credentials in `config/config.php`.
4. Detailed step-by-step instructions: see [HOSTINGER_DEPLOYMENT.md](HOSTINGER_DEPLOYMENT.md).

---

## 📁 Repository Directory Structure

```
├── assets/
│   ├── css/            # Custom luxury corporate stylesheets (main.css)
│   ├── js/             # Main corporate scripts, Cost Estimator engine (estimator.js)
│   └── images/         # SVG vector logos, architectural visuals, project photography
├── config/
│   ├── config.php      # Corporate environment & database configuration
│   ├── database.php    # Enterprise PDO dual-driver (MySQL + SQLite fallback)
│   └── security.php    # CSRF tokens, input sanitization, XSS escaping
├── database/
│   ├── schema.sql      # Production MySQL 8 schema (enquiries, loan_enquiries, projects, network_partners)
│   └── installer.php   # Data seeder with realistic Hyderabad construction projects & network
├── includes/
│   ├── header.php      # Corporate topbar, branding, and navigation
│   └── footer.php      # 4-column corporate footer, quick enquiry modal, floating WhatsApp
├── api/
│   ├── submit-enquiry.php    # 10-Field project enquiry handler with email & WhatsApp integration
│   └── loan-application.php # Self-construction loan application handler
├── index.php           # 12-section corporate homepage
├── about.php           # Corporate profile, vision, leadership & quality benchmarks
├── services.php        # Master directory of 15 construction solutions
├── service-*.php       # Dedicated service pages (Residential, Independent House, Villa, etc.)
├── projects.php        # Filterable project portfolio showcase
├── gallery.php         # Visual photo gallery
├── network.php         # Professional network partners directory
├── quote.php           # Dedicated 10-field quotation request page
├── contact.php         # Corporate contact desk & location details
└── sitemap.xml         # Complete XML sitemap for SEO indexing
```

---

## 📞 Corporate Contact Information

- **Company:** Zippy Enterprises Private Limited
- **CIN:** U45200TG2020PTC145892
- **GSTIN:** 36AAACZ1234F1Z8
- **Headquarters:** Sneha Apartment, HMT Nagar, Nacharam, Hyderabad, Telangana 500076, India
- **Primary Mobile:** +91 95424 39498
- **WhatsApp:** +91 63026 90251
- **Official Email:** zippyconstructions@gmail.com
- **Sales & Enquiries:** zippyconstructions@gmail.com
- **Official Domain:** https://zippyenterpriseconstructions.in

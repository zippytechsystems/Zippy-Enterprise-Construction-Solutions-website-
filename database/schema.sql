-- ZIPPY ENTERPRISES PRIVATE LIMITED
-- Enterprise Construction Management Platform Database Schema (MySQL 8.x / MariaDB)

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS audit_logs;
DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS loan_applications;
DROP TABLE IF EXISTS site_visits;
DROP TABLE IF EXISTS project_documents;
DROP TABLE IF EXISTS payment_milestones;
DROP TABLE IF EXISTS quotations;
DROP TABLE IF EXISTS project_milestones;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS leads;
DROP TABLE IF EXISTS builder_profiles;
DROP TABLE IF EXISTS careers_applications;
DROP TABLE IF EXISTS users;

-- 1. Users Table (RBAC: admin, staff, customer, builder)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(25) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff', 'customer', 'builder') NOT NULL DEFAULT 'customer',
    status ENUM('active', 'pending_approval', 'suspended') NOT NULL DEFAULT 'active',
    avatar VARCHAR(255) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user_email (email),
    INDEX idx_user_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Builder Profiles
CREATE TABLE builder_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    company_name VARCHAR(200) NOT NULL,
    license_number VARCHAR(100) NOT NULL,
    experience_years INT NOT NULL DEFAULT 5,
    service_areas TEXT NOT NULL,
    specialization VARCHAR(200) NOT NULL,
    portfolio_summary TEXT NULL,
    verification_status ENUM('pending', 'verified', 'rejected') NOT NULL DEFAULT 'pending',
    rating DECIMAL(3,2) DEFAULT 4.90,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_builder_status (verification_status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Leads (Enquiry & CRM)
CREATE TABLE leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    enquiry_number VARCHAR(30) NOT NULL UNIQUE,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(25) NOT NULL,
    service_requested VARCHAR(100) NOT NULL,
    project_location VARCHAR(200) NOT NULL,
    estimated_budget VARCHAR(50) NULL,
    source ENUM('website', 'whatsapp', 'call', 'referral', 'cost_calculator') NOT NULL DEFAULT 'website',
    status ENUM('new', 'contacted', 'site_visit_scheduled', 'estimation_sent', 'converted', 'dropped') NOT NULL DEFAULT 'new',
    assigned_to INT NULL,
    notes TEXT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_lead_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Projects Master
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_code VARCHAR(30) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    customer_id INT NOT NULL,
    builder_id INT NULL,
    category ENUM('residential', 'commercial', 'apartment', 'turnkey', 'villa') NOT NULL DEFAULT 'residential',
    site_address TEXT NOT NULL,
    city VARCHAR(100) NOT NULL DEFAULT 'Hyderabad',
    built_up_area_sqft DECIMAL(10,2) NOT NULL,
    floors_count INT NOT NULL DEFAULT 2,
    current_stage_id INT NOT NULL DEFAULT 1,
    progress_percent DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    total_budget DECIMAL(15,2) NOT NULL,
    start_date DATE NULL,
    target_handover_date DATE NULL,
    status ENUM('planning', 'in_progress', 'on_hold', 'completed') NOT NULL DEFAULT 'planning',
    featured_image VARCHAR(255) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (builder_id) REFERENCES builder_profiles(id) ON DELETE SET NULL,
    INDEX idx_project_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. 14-Stage Project Milestones
CREATE TABLE project_milestones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    stage_number INT NOT NULL,
    stage_name VARCHAR(150) NOT NULL,
    target_date DATE NULL,
    completion_date DATE NULL,
    status ENUM('pending', 'in_progress', 'completed', 'delayed') NOT NULL DEFAULT 'pending',
    notes TEXT NULL,
    site_photos_json TEXT NULL,
    updated_by INT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_milestone_project (project_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Quotations
CREATE TABLE quotations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote_number VARCHAR(30) NOT NULL UNIQUE,
    lead_id INT NULL,
    customer_id INT NULL,
    plot_area_sqft DECIMAL(10,2) NOT NULL,
    built_up_area_sqft DECIMAL(10,2) NOT NULL,
    floors INT NOT NULL DEFAULT 2,
    package_tier ENUM('classic', 'premium', 'luxury', 'ultra_luxury') NOT NULL DEFAULT 'premium',
    structure_cost DECIMAL(15,2) NOT NULL,
    finishing_cost DECIMAL(15,2) NOT NULL,
    mep_cost DECIMAL(15,2) NOT NULL,
    labour_cost DECIMAL(15,2) NOT NULL,
    contingency_and_tax DECIMAL(15,2) NOT NULL,
    total_estimated_cost DECIMAL(15,2) NOT NULL,
    status ENUM('draft', 'sent', 'approved', 'revised', 'rejected') NOT NULL DEFAULT 'sent',
    pdf_path VARCHAR(255) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (lead_id) REFERENCES leads(id) ON DELETE SET NULL,
    FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Payment Milestones
CREATE TABLE payment_milestones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    milestone_title VARCHAR(150) NOT NULL,
    percentage_due DECIMAL(5,2) NOT NULL,
    amount_due DECIMAL(15,2) NOT NULL,
    due_date DATE NOT NULL,
    paid_date DATE NULL,
    transaction_reference VARCHAR(100) NULL,
    payment_status ENUM('pending', 'paid', 'overdue', 'partially_paid') NOT NULL DEFAULT 'pending',
    receipt_doc_id INT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Project Documents
CREATE TABLE project_documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    uploaded_by INT NOT NULL,
    category ENUM('agreement', 'quotation', 'invoice', 'plan_drawing', 'site_report', 'structural_calc', 'noc_clearance', 'payment_receipt') NOT NULL,
    document_title VARCHAR(200) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_size_bytes INT NOT NULL DEFAULT 0,
    file_type VARCHAR(50) NOT NULL DEFAULT 'application/pdf',
    access_level ENUM('admin_only', 'builder_shared', 'client_shared', 'public') NOT NULL DEFAULT 'client_shared',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. Site Visits
CREATE TABLE site_visits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NULL,
    user_id INT NOT NULL,
    requested_date DATE NOT NULL,
    time_slot VARCHAR(50) NOT NULL,
    visit_purpose VARCHAR(255) NOT NULL,
    status ENUM('requested', 'confirmed', 'completed', 'rescheduled', 'cancelled') NOT NULL DEFAULT 'requested',
    admin_notes TEXT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. Loan Applications
CREATE TABLE loan_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    applicant_name VARCHAR(150) NOT NULL,
    phone VARCHAR(25) NOT NULL,
    email VARCHAR(150) NOT NULL,
    plot_ownership ENUM('self_owned', 'joint', 'in_process_of_purchase') NOT NULL DEFAULT 'self_owned',
    plot_location VARCHAR(200) NOT NULL,
    estimated_construction_budget DECIMAL(15,2) NOT NULL,
    desired_loan_amount DECIMAL(15,2) NOT NULL,
    monthly_income DECIMAL(15,2) NOT NULL,
    employment_type ENUM('salaried', 'self_employed_business', 'self_employed_professional', 'nri') NOT NULL DEFAULT 'salaried',
    preferred_banks VARCHAR(255) NOT NULL,
    status ENUM('submitted', 'reviewing_docs', 'estimate_shared_with_bank', 'logged_in_bank', 'sanctioned', 'disbursed', 'rejected') NOT NULL DEFAULT 'submitted',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. Audit Logs
CREATE TABLE audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    action VARCHAR(100) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    details TEXT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 12. Notifications
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    link VARCHAR(255) NULL,
    is_read TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 13. Careers Applications
CREATE TABLE careers_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    applicant_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(25) NOT NULL,
    position VARCHAR(150) NOT NULL,
    experience_years INT NOT NULL,
    resume_path VARCHAR(255) NULL,
    cover_note TEXT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

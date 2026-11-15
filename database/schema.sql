-- ZIPPY ENTERPRISES PRIVATE LIMITED
-- Corporate Website Database Schema (MySQL 8.x / MariaDB)

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS network_partners;
DROP TABLE IF EXISTS project_gallery;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS loan_enquiries;
DROP TABLE IF EXISTS enquiries;

-- 1. Project Inquiries Table (Full 10-Field System)
CREATE TABLE enquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    enquiry_number VARCHAR(30) NOT NULL UNIQUE,
    full_name VARCHAR(150) NOT NULL,
    phone VARCHAR(25) NOT NULL,
    email VARCHAR(150) NOT NULL,
    project_location VARCHAR(200) NOT NULL,
    construction_type VARCHAR(100) NOT NULL,
    plot_size VARCHAR(100) NULL,
    built_up_area VARCHAR(100) NULL,
    number_of_floors VARCHAR(50) NULL,
    approx_budget VARCHAR(100) NULL,
    project_requirements TEXT NULL,
    source VARCHAR(50) NOT NULL DEFAULT 'website',
    status VARCHAR(50) NOT NULL DEFAULT 'new',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_enq_number (enquiry_number),
    INDEX idx_enq_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Self-Construction Loan Assistance Inquiries
CREATE TABLE loan_enquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reference_number VARCHAR(30) NOT NULL UNIQUE,
    applicant_name VARCHAR(150) NOT NULL,
    phone VARCHAR(25) NOT NULL,
    email VARCHAR(150) NOT NULL,
    plot_ownership VARCHAR(100) NOT NULL,
    plot_location VARCHAR(200) NOT NULL,
    estimated_budget DECIMAL(15,2) NOT NULL,
    desired_loan DECIMAL(15,2) NOT NULL,
    monthly_income DECIMAL(15,2) NOT NULL,
    employment_type VARCHAR(100) NOT NULL,
    preferred_banks VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Projects Portfolio
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_code VARCHAR(30) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    site_location VARCHAR(200) NOT NULL,
    city VARCHAR(100) NOT NULL DEFAULT 'Hyderabad',
    built_up_area_sqft DECIMAL(10,2) NOT NULL,
    floors_count INT NOT NULL DEFAULT 2,
    short_description TEXT NOT NULL,
    project_details TEXT NOT NULL,
    featured_image VARCHAR(255) NOT NULL,
    status ENUM('ongoing', 'completed', 'upcoming') NOT NULL DEFAULT 'completed',
    completion_year VARCHAR(10) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Professional Network Partners
CREATE TABLE network_partners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    partner_name VARCHAR(200) NOT NULL,
    category ENUM('builder', 'civil_engineer', 'architect', 'structural_engineer', 'contractor', 'material_supplier', 'interior_designer') NOT NULL,
    experience_years INT NOT NULL DEFAULT 5,
    specialization VARCHAR(255) NOT NULL,
    service_areas TEXT NOT NULL,
    verified_status TINYINT(1) NOT NULL DEFAULT 1,
    rating DECIMAL(3,2) NOT NULL DEFAULT 4.90,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

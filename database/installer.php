<?php
/**
 * Database Installer & Data Seeder
 * Zippy Enterprises Private Limited
 * Supports both MySQL and SQLite
 */

require_once __DIR__ . '/../config/config.php';

class DatabaseInstaller {
    public static function installSqlite(PDO $pdo): void {
        // Create tables for SQLite
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                phone TEXT NOT NULL UNIQUE,
                password_hash TEXT NOT NULL,
                role TEXT NOT NULL DEFAULT 'customer',
                status TEXT NOT NULL DEFAULT 'active',
                avatar TEXT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                updated_at TEXT DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS builder_profiles (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NOT NULL,
                company_name TEXT NOT NULL,
                license_number TEXT NOT NULL,
                experience_years INTEGER NOT NULL DEFAULT 5,
                service_areas TEXT NOT NULL,
                specialization TEXT NOT NULL,
                portfolio_summary TEXT NULL,
                verification_status TEXT NOT NULL DEFAULT 'pending',
                rating REAL DEFAULT 4.90,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS leads (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                enquiry_number TEXT NOT NULL UNIQUE,
                full_name TEXT NOT NULL,
                email TEXT NOT NULL,
                phone TEXT NOT NULL,
                service_requested TEXT NOT NULL,
                project_location TEXT NOT NULL,
                estimated_budget TEXT NULL,
                source TEXT NOT NULL DEFAULT 'website',
                status TEXT NOT NULL DEFAULT 'new',
                assigned_to INTEGER NULL,
                notes TEXT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                updated_at TEXT DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
            );

            CREATE TABLE IF NOT EXISTS projects (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                project_code TEXT NOT NULL UNIQUE,
                title TEXT NOT NULL,
                customer_id INTEGER NOT NULL,
                builder_id INTEGER NULL,
                category TEXT NOT NULL DEFAULT 'residential',
                site_address TEXT NOT NULL,
                city TEXT NOT NULL DEFAULT 'Hyderabad',
                built_up_area_sqft REAL NOT NULL,
                floors_count INTEGER NOT NULL DEFAULT 2,
                current_stage_id INTEGER NOT NULL DEFAULT 1,
                progress_percent REAL NOT NULL DEFAULT 0.00,
                total_budget REAL NOT NULL,
                start_date TEXT NULL,
                target_handover_date TEXT NULL,
                status TEXT NOT NULL DEFAULT 'planning',
                featured_image TEXT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                updated_at TEXT DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (builder_id) REFERENCES builder_profiles(id) ON DELETE SET NULL
            );

            CREATE TABLE IF NOT EXISTS project_milestones (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                project_id INTEGER NOT NULL,
                stage_number INTEGER NOT NULL,
                stage_name TEXT NOT NULL,
                target_date TEXT NULL,
                completion_date TEXT NULL,
                status TEXT NOT NULL DEFAULT 'pending',
                notes TEXT NULL,
                site_photos_json TEXT NULL,
                updated_by INTEGER NULL,
                updated_at TEXT DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
                FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
            );

            CREATE TABLE IF NOT EXISTS quotations (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                quote_number TEXT NOT NULL UNIQUE,
                lead_id INTEGER NULL,
                customer_id INTEGER NULL,
                plot_area_sqft REAL NOT NULL,
                built_up_area_sqft REAL NOT NULL,
                floors INTEGER NOT NULL DEFAULT 2,
                package_tier TEXT NOT NULL DEFAULT 'premium',
                structure_cost REAL NOT NULL,
                finishing_cost REAL NOT NULL,
                mep_cost REAL NOT NULL,
                labour_cost REAL NOT NULL,
                contingency_and_tax REAL NOT NULL,
                total_estimated_cost REAL NOT NULL,
                status TEXT NOT NULL DEFAULT 'sent',
                pdf_path TEXT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (lead_id) REFERENCES leads(id) ON DELETE SET NULL,
                FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE SET NULL
            );

            CREATE TABLE IF NOT EXISTS payment_milestones (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                project_id INTEGER NOT NULL,
                milestone_title TEXT NOT NULL,
                percentage_due REAL NOT NULL,
                amount_due REAL NOT NULL,
                due_date TEXT NOT NULL,
                paid_date TEXT NULL,
                transaction_reference TEXT NULL,
                payment_status TEXT NOT NULL DEFAULT 'pending',
                receipt_doc_id INTEGER NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS project_documents (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                project_id INTEGER NOT NULL,
                uploaded_by INTEGER NOT NULL,
                category TEXT NOT NULL,
                document_title TEXT NOT NULL,
                file_path TEXT NOT NULL,
                file_size_bytes INTEGER NOT NULL DEFAULT 0,
                file_type TEXT NOT NULL DEFAULT 'application/pdf',
                access_level TEXT NOT NULL DEFAULT 'client_shared',
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
                FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS site_visits (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                project_id INTEGER NULL,
                user_id INTEGER NOT NULL,
                requested_date TEXT NOT NULL,
                time_slot TEXT NOT NULL,
                visit_purpose TEXT NOT NULL,
                status TEXT NOT NULL DEFAULT 'requested',
                admin_notes TEXT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL
            );

            CREATE TABLE IF NOT EXISTS loan_applications (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NULL,
                applicant_name TEXT NOT NULL,
                phone TEXT NOT NULL,
                email TEXT NOT NULL,
                plot_ownership TEXT NOT NULL DEFAULT 'self_owned',
                plot_location TEXT NOT NULL,
                estimated_construction_budget REAL NOT NULL,
                desired_loan_amount REAL NOT NULL,
                monthly_income REAL NOT NULL,
                employment_type TEXT NOT NULL DEFAULT 'salaried',
                preferred_banks TEXT NOT NULL,
                status TEXT NOT NULL DEFAULT 'submitted',
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
            );

            CREATE TABLE IF NOT EXISTS audit_logs (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NULL,
                action TEXT NOT NULL,
                ip_address TEXT NOT NULL,
                details TEXT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS notifications (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NOT NULL,
                title TEXT NOT NULL,
                message TEXT NOT NULL,
                link TEXT NULL,
                is_read INTEGER NOT NULL DEFAULT 0,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS careers_applications (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                applicant_name TEXT NOT NULL,
                email TEXT NOT NULL,
                phone TEXT NOT NULL,
                position TEXT NOT NULL,
                experience_years INTEGER NOT NULL,
                resume_path TEXT NULL,
                cover_note TEXT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            );
        ");

        self::seedData($pdo);
    }

    public static function seedData(PDO $pdo): void {
        // Check if users already seeded
        $existing = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        if ($existing > 0) return;

        $adminHash = password_hash('Admin@12345', PASSWORD_DEFAULT);
        $builderHash = password_hash('Builder@12345', PASSWORD_DEFAULT);
        $customerHash = password_hash('Customer@12345', PASSWORD_DEFAULT);

        // 1. Users
        $insertUser = $pdo->prepare("INSERT INTO users (id, name, email, phone, password_hash, role, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertUser->execute([1, 'Executive Admin', 'admin@zippyenterprises.com', '+91 91212 87654', $adminHash, 'admin', 'active']);
        $insertUser->execute([2, 'Kailash Infrastructure Ltd', 'builder@kailashconstructions.com', '+91 98480 12345', $builderHash, 'builder', 'active']);
        $insertUser->execute([3, 'Sri City Developers', 'sricity@builders.in', '+91 98480 67890', $builderHash, 'builder', 'pending_approval']);
        $insertUser->execute([4, 'Rajesh Kumar Verma', 'rajesh.verma@example.com', '+91 99890 54321', $customerHash, 'customer', 'active']);
        $insertUser->execute([5, 'Dr. Priya Reddy', 'priya.reddy@example.com', '+91 97000 11223', $customerHash, 'customer', 'active']);

        // 2. Builder Profiles
        $insertBuilder = $pdo->prepare("INSERT INTO builder_profiles (id, user_id, company_name, license_number, experience_years, service_areas, specialization, portfolio_summary, verification_status, rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertBuilder->execute([
            1, 2, 'Kailash Infrastructure Private Limited', 'GHMC-CLASS1-2015-894', 16,
            'Jubilee Hills, Banjara Hills, Gachibowli, Madhapur, Hitec City',
            'Luxury Independent Villas, High-Rise Residential, Turnkey EPC',
            'Over 45 delivered premium villas and 6 commercial structures across Western Hyderabad. Certified ISO 9001:2015 quality assurance.',
            'verified', 4.95
        ]);
        $insertBuilder->execute([
            2, 3, 'Sri City Builders & Engineers', 'GHMC-CLASS2-2021-302', 8,
            'Kompally, Miyapur, Kukatpally, Bachupally',
            'Apartment Construction, Duplex Communities',
            'Specialist in high-velocity multi-unit residential execution with in-house structural engineering team.',
            'pending', 4.70
        ]);

        // 3. Projects
        $insertProject = $pdo->prepare("INSERT INTO projects (id, project_code, title, customer_id, builder_id, category, site_address, city, built_up_area_sqft, floors_count, current_stage_id, progress_percent, total_budget, start_date, target_handover_date, status, featured_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Project 1: Luxury Villa in Jubilee Hills
        $insertProject->execute([
            1, 'ZIP-PRJ-HYD-001', 'Zippy SkyVillas - Signature Residence',
            4, 1, 'villa', 'Plot 418, Road No. 78, Jubilee Hills, Hyderabad', 'Hyderabad',
            7500.00, 3, 11, 78.50, 34500000.00, '2026-03-01', '2027-04-30', 'in_progress',
            'assets/images/projects/project-1.jpg'
        ]);

        // Project 2: Commercial Tech Hub
        $insertProject->execute([
            2, 'ZIP-PRJ-HYD-002', 'Apex Financial Hub - Tech Suites',
            5, 1, 'commercial', 'Survey 88, Financial District, Nanakramguda, Hyderabad', 'Hyderabad',
            24000.00, 5, 8, 52.00, 89000000.00, '2026-01-15', '2027-08-31', 'in_progress',
            'assets/images/projects/project-2.jpg'
        ]);

        // Project 3: Turnkey Duplex
        $insertProject->execute([
            3, 'ZIP-PRJ-HYD-003', 'The Palms Signature Duplex',
            4, 1, 'residential', 'Plot 12A, Palm Meadows, Kompally, Hyderabad', 'Hyderabad',
            4200.00, 2, 13, 94.00, 18500000.00, '2025-08-10', '2026-12-15', 'in_progress',
            'assets/images/projects/project-3.jpg'
        ]);

        // 4. 14 Stages for Project 1 (Zippy SkyVillas)
        $stages = [
            1 => ['Enquiry Received', 'completed', 'Initial client consult and project scope document drafted.'],
            2 => ['Site Inspection & Soil Testing', 'completed', 'Soil bearing capacity tested at 240 kN/m2. Topography mapped.'],
            3 => ['Requirements & Floor Plans Finalized', 'completed', 'Vastu-compliant architectural layouts approved by client.'],
            4 => ['Detailed Estimation Prepared', 'completed', 'Comprehensive bill of quantities (BOQ) vetted by PMC.'],
            5 => ['Quotation Submitted & Approved', 'completed', 'Signed contract at ₹3.45 Cr with luxury marble specifications.'],
            6 => ['Agreement & GHMC Sanction Completed', 'completed', 'Sanction permit issued by GHMC building department.'],
            7 => ['Foundation Work & Raft Slab', 'completed', 'M30 grade concrete poured for raft foundation and retaining walls.'],
            8 => ['Structural Column & Slab Framework', 'completed', 'G+2 RCC frame casting finished with Fe550D TMT rebars.'],
            9 => ['Brickwork & AAC Block Masonry', 'completed', 'Exterior and interior AAC block wall partitions completed.'],
            10 => ['Electrical Conduit & Plumbing Piping', 'completed', 'Concealed CPVC/UPVC lines and copper wiring runs installed.'],
            11 => ['Wall Plastering & Waterproofing', 'in_progress', 'Internal gypsum plastering underway; terrace waterproofing in test phase.'],
            12 => ['Flooring, Joinery & Finishing', 'pending', 'Italian statuario marble and teakwood door frames scheduled next.'],
            13 => ['Final Quality Audit & Testing', 'pending', 'Pre-handover snagging and testing of MEP fixtures.'],
            14 => ['Project Handover & Occupancy', 'pending', 'Final deep clean, key handover ceremony, and warranty issuance.']
        ];

        $insertStage = $pdo->prepare("INSERT INTO project_milestones (project_id, stage_number, stage_name, status, notes) VALUES (?, ?, ?, ?, ?)");
        foreach ($stages as $num => $data) {
            $insertStage->execute([1, $num, $data[0], $data[1], $data[2]]);
        }

        // Project 2 stages
        foreach ($stages as $num => $data) {
            $status = $num < 8 ? 'completed' : ($num === 8 ? 'in_progress' : 'pending');
            $insertStage->execute([2, $num, $data[0], $status, "Commercial Tower execution stage {$num}."]);
        }

        // Project 3 stages
        foreach ($stages as $num => $data) {
            $status = $num < 13 ? 'completed' : ($num === 13 ? 'in_progress' : 'pending');
            $insertStage->execute([3, $num, $data[0], $status, "Duplex construction stage {$num}."]);
        }

        // 5. Payment Milestones for Project 1
        $insertPayment = $pdo->prepare("INSERT INTO payment_milestones (project_id, milestone_title, percentage_due, amount_due, due_date, paid_date, transaction_reference, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertPayment->execute([1, 'Project Mobilization Advance (10%)', 10.00, 3450000.00, '2026-03-01', '2026-03-02', 'HDFC98124018', 'paid']);
        $insertPayment->execute([1, 'Foundation & Plinth Completion (15%)', 15.00, 5175000.00, '2026-05-15', '2026-05-18', 'ICIC77651029', 'paid']);
        $insertPayment->execute([1, 'RCC Structural Slab Castings (25%)', 25.00, 8625000.00, '2026-08-30', '2026-09-02', 'AXIS33290145', 'paid']);
        $insertPayment->execute([1, 'Brickwork & MEP Concealment (20%)', 20.00, 6900000.00, '2026-10-20', '2026-10-22', 'HDFC00192847', 'paid']);
        $insertPayment->execute([1, 'Plastering & Flooring Execution (15%)', 15.00, 5175000.00, '2026-12-15', null, null, 'pending']);
        $insertPayment->execute([1, 'Final Finishing & Key Handover (15%)', 15.00, 5175000.00, '2027-04-30', null, null, 'pending']);

        // 6. CRM Leads
        $insertLead = $pdo->prepare("INSERT INTO leads (enquiry_number, full_name, email, phone, service_requested, project_location, estimated_budget, source, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertLead->execute(['ZIP-ENQ-2026-101', 'Venkat Ramanathan', 'v.ramanathan@tcs.com', '+91 98490 22334', 'Residential Building Construction', 'Kokapet Golden Mile, Hyderabad', '₹2.50 Cr - ₹3.00 Cr', 'website', 'contacted', 'Interested in G+2 contemporary villa with solar integration. Plot size 500 sq yards.']);
        $insertLead->execute(['ZIP-ENQ-2026-102', 'Suresh Goud', 'suresh.goud@gmail.com', '+91 97011 55667', 'Commercial Building Construction', 'Madhapur 100ft Road, Hyderabad', '₹6.00 Cr - ₹8.00 Cr', 'whatsapp', 'site_visit_scheduled', 'Looking for commercial complex for co-working leasing. Site visit booked for Saturday.']);
        $insertLead->execute(['ZIP-ENQ-2026-103', 'Ananya Sharma', 'ananya.s@outlook.com', '+91 96180 88990', 'Turnkey Construction', 'Tellapur, Hyderabad', '₹1.80 Cr - ₹2.20 Cr', 'cost_calculator', 'estimation_sent', 'Generated estimation via online portal for 3,800 sqft premium duplex. Follow-up scheduled.']);
        $insertLead->execute(['ZIP-ENQ-2026-104', 'Maheshwar Rao', 'm.rao@construct.in', '+91 99490 33445', 'Self-Construction Loan Assistance', 'Manikonda, Hyderabad', '₹1.20 Cr', 'call', 'new', 'Plot registered. Needs banking estimation and documentation support for SBI home loan.']);

        // 7. Documents
        $insertDoc = $pdo->prepare("INSERT INTO project_documents (project_id, uploaded_by, category, document_title, file_path, file_size_bytes, file_type, access_level) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertDoc->execute([1, 1, 'agreement', 'Executed Construction Agreement & BOQ', 'uploads/docs/agreement_skyvillas.pdf', 2450000, 'application/pdf', 'client_shared']);
        $insertDoc->execute([1, 1, 'plan_drawing', 'Sanctioned Architectural Working Drawings (Rev 3)', 'uploads/docs/architectural_drawings.pdf', 8400000, 'application/pdf', 'client_shared']);
        $insertDoc->execute([1, 1, 'structural_calc', 'Structural Stability Certificate & Column Details', 'uploads/docs/structural_vetting.pdf', 3100000, 'application/pdf', 'client_shared']);
        $insertDoc->execute([1, 2, 'site_report', 'M30 Concrete Cube Compressive Strength Test Report', 'uploads/docs/cube_test_report.pdf', 1200000, 'application/pdf', 'builder_shared']);

        // 8. Site Visits
        $insertVisit = $pdo->prepare("INSERT INTO site_visits (project_id, user_id, requested_date, time_slot, visit_purpose, status, admin_notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertVisit->execute([1, 4, '2026-11-20', '10:00 AM - 11:30 AM', 'Review plastering finish and inspect electrical layout conduit box positions', 'confirmed', 'Senior Project Manager Er. Vikram Rao will accompany the client.']);

        // 9. Loan Applications
        $insertLoan = $pdo->prepare("INSERT INTO loan_applications (user_id, applicant_name, phone, email, plot_ownership, plot_location, estimated_construction_budget, desired_loan_amount, monthly_income, employment_type, preferred_banks, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertLoan->execute([4, 'Rajesh Kumar Verma', '+91 99890 54321', 'rajesh.verma@example.com', 'self_owned', 'Plot 418, Jubilee Hills, Hyderabad', 34500000.00, 20000000.00, 750000.00, 'self_employed_business', 'HDFC Bank, ICICI Bank, SBI', 'sanctioned']);

        // 10. Notifications
        $insertNotif = $pdo->prepare("INSERT INTO notifications (user_id, title, message, link) VALUES (?, ?, ?, ?)");
        $insertNotif->execute([4, 'Stage 11 In Progress', 'Wall Plastering & Terrace Waterproofing is progressing as per schedule at Zippy SkyVillas.', 'my-project.php']);
        $insertNotif->execute([1, 'New High-Value Lead', 'Venkat Ramanathan submitted an enquiry for 500 sqyd villa in Kokapet.', 'leads.php']);
        $insertNotif->execute([2, 'Inspection Report Due', 'Please upload the week 44 soil stabilization report for Project #ZIP-PRJ-HYD-001.', 'documents.php']);
    }
}

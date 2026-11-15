<?php
/**
 * Corporate Database Installer & Data Seeder
 * Zippy Enterprises Private Limited
 */

require_once __DIR__ . '/../config/config.php';

class DatabaseInstaller {
    public static function installSqlite(PDO $pdo): void {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS enquiries (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                enquiry_number TEXT NOT NULL UNIQUE,
                full_name TEXT NOT NULL,
                phone TEXT NOT NULL,
                email TEXT NOT NULL,
                project_location TEXT NOT NULL,
                construction_type TEXT NOT NULL,
                plot_size TEXT NULL,
                built_up_area TEXT NULL,
                number_of_floors TEXT NULL,
                approx_budget TEXT NULL,
                project_requirements TEXT NULL,
                source TEXT NOT NULL DEFAULT 'website',
                status TEXT NOT NULL DEFAULT 'new',
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS loan_enquiries (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                reference_number TEXT NOT NULL UNIQUE,
                applicant_name TEXT NOT NULL,
                phone TEXT NOT NULL,
                email TEXT NOT NULL,
                plot_ownership TEXT NOT NULL,
                plot_location TEXT NOT NULL,
                estimated_budget REAL NOT NULL,
                desired_loan REAL NOT NULL,
                monthly_income REAL NOT NULL,
                employment_type TEXT NOT NULL,
                preferred_banks TEXT NOT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS projects (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                project_code TEXT NOT NULL UNIQUE,
                title TEXT NOT NULL,
                category TEXT NOT NULL,
                site_location TEXT NOT NULL,
                city TEXT NOT NULL DEFAULT 'Hyderabad',
                built_up_area_sqft REAL NOT NULL,
                floors_count INTEGER NOT NULL DEFAULT 2,
                short_description TEXT NOT NULL,
                project_details TEXT NOT NULL,
                featured_image TEXT NOT NULL,
                status TEXT NOT NULL DEFAULT 'completed',
                completion_year TEXT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS network_partners (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                partner_name TEXT NOT NULL,
                category TEXT NOT NULL,
                experience_years INTEGER NOT NULL DEFAULT 5,
                specialization TEXT NOT NULL,
                service_areas TEXT NOT NULL,
                verified_status INTEGER NOT NULL DEFAULT 1,
                rating REAL NOT NULL DEFAULT 4.90,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            );
        ");

        self::seedData($pdo);
    }

    public static function seedData(PDO $pdo): void {
        // Check if projects seeded
        $existing = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
        if ($existing > 0) return;

        // 1. Projects
        $pStmt = $pdo->prepare("INSERT INTO projects (project_code, title, category, site_location, city, built_up_area_sqft, floors_count, short_description, project_details, featured_image, status, completion_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $pStmt->execute([
            'ZIP-PRJ-01', 'Zippy SkyVillas - Signature Residence', 'Luxury Villas', 'Road No. 78, Jubilee Hills', 'Hyderabad',
            7500.00, 3, 'Ultra-luxury contemporary villa featuring cantilevered balconies, double-height living areas, Italian Statuario marble, and private infinity pool.',
            'Architectural turnkey execution with M30 RMC, Tata Fe550D TMT steel, smart home automation, and 100% Vastu compliance.',
            'assets/images/projects/project-1.jpg', 'completed', '2025'
        ]);

        $pStmt->execute([
            'ZIP-PRJ-02', 'Apex Financial Hub - Tech Suites', 'Commercial Projects', 'Financial District, Nanakramguda', 'Hyderabad',
            24000.00, 5, 'Modern Grade-A corporate tech suites with post-tensioned slabs, high-performance structural double glazing, and basement car parking.',
            'Turnkey commercial EPC execution with heavy server room floor loading capacity and high-efficiency HVAC chillers.',
            'assets/images/projects/project-2.jpg', 'ongoing', '2026'
        ]);

        $pStmt->execute([
            'ZIP-PRJ-03', 'The Palms Signature Duplex', 'Independent Houses', 'Palm Meadows, Kompally', 'Hyderabad',
            4200.00, 2, 'Contemporary duplex home designed for multi-generational comfort with expansive terrace gardens and bespoke teakwood joinery.',
            'Soil bearing capacity engineered raft foundation, concealed CPVC plumbing, and premium vitrified tiling.',
            'assets/images/projects/project-3.jpg', 'completed', '2025'
        ]);

        $pStmt->execute([
            'ZIP-PRJ-04', 'Emerald Heights Enclave', 'Apartment Buildings', 'Golden Mile Road, Kokapet', 'Hyderabad',
            32000.00, 6, 'G+5 multi-unit residential apartment complex featuring dual high-speed elevators, community clubhouse, and landscaped podium.',
            'Joint Venture (JV) property development with complete GHMC municipal sanction handling and statutory fire NOC compliance.',
            'assets/images/projects/project-4.jpg', 'ongoing', '2026'
        ]);

        $pStmt->execute([
            'ZIP-PRJ-05', 'Hilltop Contemporary Villa', 'Luxury Villas', 'Road No. 12, Banjara Hills', 'Hyderabad',
            6800.00, 3, 'Bespoke hillside villa with cantilevered structural frame, imported timber louvers, and expansive skylights.',
            'Architectural space planning with 3D BIM visualization, earthquake-resistant rebar detailing, and acoustic glass panels.',
            'assets/images/services/residential.jpg', 'completed', '2024'
        ]);

        $pStmt->execute([
            'ZIP-PRJ-06', 'Cyber Crest Retail Complex', 'Commercial Projects', '100ft Road, Madhapur', 'Hyderabad',
            18500.00, 4, 'High-street retail and corporate complex with wide column-free showroom spaces and double-height entrance atriums.',
            'Engineered for maximum commercial leasing returns with integrated fire hydrants and 100% diesel generator backup synchronizers.',
            'assets/images/services/commercial.jpg', 'ongoing', '2026'
        ]);

        // 2. Professional Network Partners
        $nStmt = $pdo->prepare("INSERT INTO network_partners (partner_name, category, experience_years, specialization, service_areas, rating) VALUES (?, ?, ?, ?, ?, ?)");
        $nStmt->execute(['Kailash Infrastructure Ltd', 'builder', 16, 'Luxury Villas & High-Rise Civil Framing', 'Jubilee Hills, Banjara Hills, Gachibowli', 4.95]);
        $nStmt->execute(['Er. Vikram Rao & Associates (PMC)', 'civil_engineer', 20, 'Quality Assurance, Concrete Slump & Cube Testing', 'All Hyderabad Regions', 4.98]);
        $nStmt->execute(['Studio Earthline Architects', 'architect', 14, 'Vastu-Compliant 3D Elevation & Space Planning', 'Telangana & AP', 4.90]);
        $nStmt->execute(['Apex Structural Engineers', 'structural_engineer', 18, 'STAAD-Pro & ETABS Finite Element Modeling', 'Hyderabad Urban & HMDA', 4.96]);
        $nStmt->execute(['UltraTech Building Solutions Hub', 'material_supplier', 25, 'Direct Factory RMC (M20/M25/M30) & PPC Cement', 'Western & Northern Hyderabad', 4.92]);
        $nStmt->execute(['Tata Tiscon Primary Rebar Distributors', 'material_supplier', 30, 'Fe 550D High-Ductility Seismic Resistant Steel', 'Telangana State', 4.95]);
        $nStmt->execute(['Zippy Bespoke Interior Studio', 'interior_designer', 10, 'Italian Marble Inlay, Modular Kitchens & Acoustic Ceilings', 'Hyderabad Luxury Corridor', 4.88]);
    }
}

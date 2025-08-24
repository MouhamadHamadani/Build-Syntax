-- Build Syntax Admin Panel Database Schema
-- Enhanced schema for admin functionality

-- Admin users table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(191) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor') DEFAULT 'admin',
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE
);

-- Enhanced contact submissions table
-- ALTER TABLE contact_submissions 
-- ADD COLUMN phone VARCHAR(50),
-- ADD COLUMN project_type ENUM('website', 'ecommerce', 'mobile_app', 'other') DEFAULT 'website',
-- ADD COLUMN notes TEXT,
-- ADD COLUMN assigned_to INT NULL,
-- ADD COLUMN priority ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
-- MODIFY COLUMN status ENUM('new', 'contacted', 'in_progress', 'completed', 'declined') DEFAULT 'new';
ALTER TABLE contact_submissions 
ADD COLUMN phone VARCHAR(50),
ADD COLUMN project_type ENUM('website', 'ecommerce', 'mobile_app', 'other') DEFAULT 'website',
ADD COLUMN notes TEXT,
ADD COLUMN assigned_to INT NULL,
ADD COLUMN priority ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
MODIFY COLUMN status ENUM('new', 'contacted', 'in_progress', 'completed', 'declined') DEFAULT 'new';


-- Newsletter subscriptions table
CREATE TABLE IF NOT EXISTS newsletter_subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(191) UNIQUE NOT NULL,
    name VARCHAR(255),
    status ENUM('active', 'unsubscribed', 'bounced') DEFAULT 'active',
    source VARCHAR(100) DEFAULT 'website',
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    unsubscribed_at TIMESTAMP NULL,
    confirmation_token VARCHAR(100),
    confirmed BOOLEAN DEFAULT FALSE,
    confirmed_at TIMESTAMP NULL
);

-- Enhanced blog posts table
ALTER TABLE blog_posts 
ADD COLUMN author VARCHAR(255) DEFAULT 'Build Syntax Team',
ADD COLUMN published_at TIMESTAMP NULL,
ADD COLUMN created_by INT NULL,
ADD COLUMN meta_title VARCHAR(255),
ADD COLUMN meta_description TEXT,
ADD COLUMN tags JSON,
ADD COLUMN view_count INT DEFAULT 0,
MODIFY COLUMN published BOOLEAN DEFAULT FALSE;

-- Enhanced portfolio projects table
ALTER TABLE portfolio_projects 
ADD COLUMN created_by INT NULL,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Admin activity log
CREATE TABLE IF NOT EXISTS admin_activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action VARCHAR(100) NOT NULL,
    table_name VARCHAR(100),
    record_id INT,
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES admin_users(id) ON DELETE CASCADE
);

-- Insert default admin user (username: admin, password: admin123)
-- Password hash for 'admin123' using PHP password_hash()
INSERT IGNORE INTO admin_users (username, email, password_hash, full_name, role) VALUES
('admin', 'admin@buildsyntax.com', '$2a$12$RDo38mPN.6yh6jmvhriG1eE98BZFgR6YgVIt.bydxcCXK1iwN6656', 'Build Syntax Admin', 'admin');

-- Insert sample newsletter subscriptions
INSERT IGNORE INTO newsletter_subscriptions (email, name, status, confirmed) VALUES
('john.doe@example.com', 'John Doe', 'active', TRUE),
('jane.smith@example.com', 'Jane Smith', 'active', TRUE),
('developer@techcorp.com', 'Tech Developer', 'active', TRUE),
('sarah@startup.lb', 'Sarah Khalil', 'active', TRUE),
('ahmad@business.com', 'Ahmad Hassan', 'active', TRUE);

-- Insert sample contact submissions with enhanced data
INSERT IGNORE INTO contact_submissions (name, email, phone, company, project_type, budget_range, message, status, priority) VALUES
('Ahmad Hassan', 'ahmad@example.com', '+961 70 123 456', 'Tech Solutions LLC', 'website', '15k_30k', 'We need a modern corporate website with CMS functionality and multi-language support.', 'new', 'high'),
('Sarah Khalil', 'sarah@startup.com', '+961 71 987 654', 'Startup Innovations', 'ecommerce', '5k_15k', 'Looking for an e-commerce platform to sell our products online with payment gateway integration.', 'contacted', 'medium'),
('Michel Abou Rjeily', 'michel@restaurant.com', '+961 3 456 789', 'Le Petit Restaurant', 'mobile_app', 'under_5k', 'Need a mobile app for restaurant orders and delivery management.', 'new', 'low'),
('Lina Mansour', 'lina@fashion.lb', '+961 76 555 123', 'Fashion Boutique', 'ecommerce', '5k_15k', 'Want to create an online store for our fashion brand with inventory management.', 'in_progress', 'medium'),
('Karim Nader', 'karim@consulting.com', '+961 1 234 567', 'Business Consulting Group', 'website', '30k_plus', 'Enterprise website with client portal and document management system.', 'new', 'urgent');

-- Update existing blog posts with enhanced metadata
UPDATE blog_posts SET 
    author = 'Build Syntax Team',
    published_at = created_at,
    meta_title = CONCAT(title, ' - Build Syntax'),
    meta_description = excerpt,
    tags = '["Web Development", "Business", "Technology"]',
    created_by = 1
WHERE published = TRUE;


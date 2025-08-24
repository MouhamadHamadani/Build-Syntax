-- Build Syntax Website Database Schema
-- Created for Build Syntax S.A.R.L.

CREATE DATABASE IF NOT EXISTS build_syntax_db;
USE build_syntax_db;

-- Contact form submissions table
CREATE TABLE IF NOT EXISTS contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    company VARCHAR(100),
    message TEXT NOT NULL,
    budget_range VARCHAR(50),
    phone VARCHAR(50),
    project_type ENUM('website', 'ecommerce', 'mobile_app', 'other') DEFAULT 'website',
    notes TEXT,
    assigned_to INT NULL,
    priority ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'contacted', 'in_progress', 'completed', 'declined') DEFAULT 'new'
);

-- Portfolio projects table
CREATE TABLE IF NOT EXISTS portfolio_projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    image_url VARCHAR(255),
    project_url VARCHAR(255),
    technologies TEXT,
    featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Blog posts table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    excerpt TEXT,
    content LONGTEXT,
    featured_image VARCHAR(255),
    author VARCHAR(255) DEFAULT 'Build Syntax Team',
    published_at TIMESTAMP NULL,
    published BOOLEAN DEFAULT FALSE,
    status ENUM('published', 'draft', 'archived') DEFAULT 'published',
    meta_title VARCHAR(255),
    meta_description TEXT,
    tags JSON,
    view_count INT DEFAULT 0,
    created_by INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

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
-- INSERT IGNORE INTO newsletter_subscriptions (email, name, status, confirmed) VALUES
-- ('john.doe@example.com', 'John Doe', 'active', TRUE),
-- ('jane.smith@example.com', 'Jane Smith', 'active', TRUE),
-- ('developer@techcorp.com', 'Tech Developer', 'active', TRUE),
-- ('sarah@startup.lb', 'Sarah Khalil', 'active', TRUE),
-- ('ahmad@business.com', 'Ahmad Hassan', 'active', TRUE);

-- Insert sample portfolio projects
-- INSERT INTO portfolio_projects (title, description, category, image_url, technologies, featured) VALUES
-- ('E-Commerce Demo Platform', 'A comprehensive e-commerce solution built with Laravel and Livewire, featuring real-time cart updates, secure payment processing, and an intuitive admin panel.', 'E-Commerce', 'assets/images/portfolio/ecommerce-demo.jpg', 'Laravel, Livewire, MySQL, Tailwind CSS', TRUE),
-- ('Corporate Website Redesign', 'Modern, responsive website redesign for a leading Lebanese consulting firm, improving user experience and mobile performance.', 'Corporate', 'assets/images/portfolio/corporate-site.jpg', 'PHP, HTML5, CSS3, JavaScript', TRUE),
-- ('Restaurant Management App', 'Full-stack web application for restaurant order management with real-time kitchen updates and customer notifications.', 'Web App', 'assets/images/portfolio/restaurant-app.jpg', 'PHP, MySQL, jQuery, Bootstrap', FALSE);

-- Insert sample blog posts
-- INSERT INTO blog_posts (title, slug, excerpt, content, published) VALUES
-- ('Why Your Business Needs a Professional Website in 2025', 'why-business-needs-professional-website-2025', 'In today\'s digital landscape, a professional website is not just an option—it\'s a necessity for business success.', 'In today\'s digital landscape, a professional website is not just an option—it\'s a necessity for business success. Here\'s why every business in Lebanon and the MENA region should invest in a quality web presence...', TRUE),
-- ('The Power of E-Commerce: Transforming Lebanese Businesses', 'power-ecommerce-transforming-lebanese-businesses', 'E-commerce is revolutionizing how Lebanese businesses reach customers and drive growth in challenging economic times.', 'E-commerce is revolutionizing how Lebanese businesses reach customers and drive growth in challenging economic times. Learn how to leverage online sales...', TRUE);


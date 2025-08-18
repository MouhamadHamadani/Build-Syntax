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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'read', 'responded') DEFAULT 'new'
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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blog posts table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    excerpt TEXT,
    content LONGTEXT,
    featured_image VARCHAR(255),
    published BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample portfolio projects
INSERT INTO portfolio_projects (title, description, category, image_url, technologies, featured) VALUES
('E-Commerce Demo Platform', 'A comprehensive e-commerce solution built with Laravel and Livewire, featuring real-time cart updates, secure payment processing, and an intuitive admin panel.', 'E-Commerce', 'assets/images/portfolio/ecommerce-demo.jpg', 'Laravel, Livewire, MySQL, Tailwind CSS', TRUE),
('Corporate Website Redesign', 'Modern, responsive website redesign for a leading Lebanese consulting firm, improving user experience and mobile performance.', 'Corporate', 'assets/images/portfolio/corporate-site.jpg', 'PHP, HTML5, CSS3, JavaScript', TRUE),
('Restaurant Management App', 'Full-stack web application for restaurant order management with real-time kitchen updates and customer notifications.', 'Web App', 'assets/images/portfolio/restaurant-app.jpg', 'PHP, MySQL, jQuery, Bootstrap', FALSE);

-- Insert sample blog posts
INSERT INTO blog_posts (title, slug, excerpt, content, published) VALUES
('Why Your Business Needs a Professional Website in 2025', 'why-business-needs-professional-website-2025', 'In today\'s digital landscape, a professional website is not just an option—it\'s a necessity for business success.', 'In today\'s digital landscape, a professional website is not just an option—it\'s a necessity for business success. Here\'s why every business in Lebanon and the MENA region should invest in a quality web presence...', TRUE),
('The Power of E-Commerce: Transforming Lebanese Businesses', 'power-ecommerce-transforming-lebanese-businesses', 'E-commerce is revolutionizing how Lebanese businesses reach customers and drive growth in challenging economic times.', 'E-commerce is revolutionizing how Lebanese businesses reach customers and drive growth in challenging economic times. Learn how to leverage online sales...', TRUE);


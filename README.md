# Build Syntax Website

A professional website for Build Syntax S.A.R.L., a web development company based in Beirut, Lebanon.

## Project Overview

**Company:** Build Syntax S.A.R.L.  
**Tagline:** "Your Vision, Our Code"  
**Location:** Beirut, Lebanon  
**Industry:** Web Development & Digital Solutions

## Technology Stack

- **Frontend:** HTML5, CSS3, JavaScript, jQuery
- **Styling:** Tailwind CSS (via CDN)
- **Backend:** PHP 7.4+
- **Database:** MySQL 8.0+
- **Server:** Apache/Nginx with PHP support

## Features

### Core Pages
- **Homepage** (`index.php` / `index.html`) - Main landing page with hero section, services overview, and portfolio highlights
- **Services** (`pages/services.php`) - Detailed service offerings and pricing
- **Portfolio** (`pages/portfolio.php`) - Project showcase with filtering and modal views
- **About** (`pages/about.php`) - Company story, mission, values, and team information
- **Contact** (`pages/contact.php`) - Contact form with database integration and FAQ section
- **Blog** (`pages/blog.php`) - Blog listing with categories and newsletter signup

### Key Features
- **Responsive Design** - Mobile-first approach with Tailwind CSS
- **Interactive Elements** - jQuery-powered animations and user interactions
- **Contact Form** - PHP backend with MySQL database storage
- **Portfolio Filtering** - Dynamic project filtering by category
- **SEO Optimized** - Proper meta tags, structured data, and semantic HTML
- **Performance Optimized** - Optimized images, minified assets, and fast loading times

## File Structure

```
build-syntax-website/
├── index.php                 # Main homepage (PHP version)
├── index.html                # Static homepage (HTML version for testing)
├── assets/
│   ├── css/                  # Custom CSS files
│   ├── js/                   # Custom JavaScript files
│   └── images/               # Logo, icons, and images
│       ├── BuildSyntax.png   # Main logo with text
│       └── icon.png          # Icon/favicon
├── includes/
│   ├── config.php           # Database configuration
│   ├── header.php           # Reusable header component
│   └── footer.php           # Reusable footer component
├── pages/
│   ├── services.php         # Services page
│   ├── portfolio.php        # Portfolio/work page
│   ├── about.php           # About us page
│   ├── contact.php         # Contact page with form
│   └── blog.php            # Blog listing page
├── database/
│   └── schema.sql          # Database schema and setup
└── README.md               # This file
```

## Database Setup

1. Create a MySQL database for the website
2. Import the schema from `database/schema.sql`
3. Update database credentials in `includes/config.php`

### Required Tables
- `contact_submissions` - Stores contact form submissions
- `portfolio_projects` - Portfolio project data
- `blog_posts` - Blog articles and content

## Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 8.0 or higher
- Web server (Apache/Nginx)

### Local Development
1. Clone or download the project files
2. Set up a local web server (XAMPP, WAMP, or similar)
3. Create a MySQL database and import `database/schema.sql`
4. Update database credentials in `includes/config.php`
5. Access the website via your local server

### Testing with Static Version
For quick testing without PHP/MySQL setup:
1. Open `index.html` in a web browser
2. Use a simple HTTP server: `python3 -m http.server 8080`
3. Navigate to `http://localhost:8080/index.html`

## Configuration

### Database Configuration
Edit `includes/config.php` with your database credentials:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'buildsyntax_db');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

### Contact Information
Update contact details in the following files:
- `includes/config.php` - Email addresses and phone numbers
- `includes/footer.php` - Footer contact information
- `pages/contact.php` - Contact page details

## Customization

### Brand Colors
The website uses Build Syntax's brand colors:
- **Primary Blue:** #4A90E2
- **Dark Blue:** #357ABD
- **Gray Tones:** Various shades for text and backgrounds

### Logo and Images
- Replace `assets/images/BuildSyntax.png` with your logo
- Replace `assets/images/icon.png` with your favicon
- Update image paths in HTML/PHP files as needed

### Content Updates
- Edit page content directly in the PHP files
- Update service descriptions in `pages/services.php`
- Add portfolio projects in `pages/portfolio.php`
- Modify company information in `pages/about.php`

## Deployment

### Production Deployment
1. Upload all files to your web server
2. Set up the MySQL database and import the schema
3. Update `includes/config.php` with production database credentials
4. Ensure proper file permissions (755 for directories, 644 for files)
5. Configure your web server to serve PHP files

### Security Considerations
- Use HTTPS in production
- Implement proper input validation and sanitization
- Use prepared statements for database queries (already implemented)
- Keep PHP and MySQL updated
- Implement rate limiting for contact forms

## Browser Compatibility

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance

- **Tailwind CSS:** Loaded via CDN for fast delivery
- **jQuery:** Loaded via Google CDN
- **Images:** Optimized for web delivery
- **Code:** Minified CSS and JavaScript in production

## Support & Maintenance

### Regular Updates
- Keep PHP and MySQL updated
- Monitor contact form submissions
- Update portfolio with new projects
- Add new blog posts regularly

### Backup Strategy
- Regular database backups
- File system backups
- Version control with Git

## Contact

For technical support or questions about this website:

**Build Syntax S.A.R.L.**  
Email: info@buildsyntax.com  
Location: Beirut, Lebanon  
Website: [Your Domain]

---

**Build Syntax: Your Vision, Our Code**


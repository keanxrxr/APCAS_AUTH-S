# Copilot Instructions for Project-Kean

This project is hosted in XAMPP's htdocs directory (`c:\xampp\htdocs\Project-Kean`), indicating it's a web application stack using Apache, MySQL, and PHP.

## Architecture Overview

- **Technology Stack**: Apache web server, MySQL database, PHP backend
- **Entry Point**: Likely `index.php` or similar in the root directory
- **Database**: MySQL, configured via XAMPP

## Development Workflow

- Start XAMPP services (Apache, MySQL) via XAMPP Control Panel
- Access application at `http://localhost/Project-Kean/`
- Edit files directly in the htdocs directory
- No build process required for basic PHP applications

## Key Patterns and Conventions

- Use PHP for server-side logic
- HTML/CSS/JS for frontend
- MySQL for data persistence
- Follow standard PHP naming conventions (e.g., `snake_case` for functions, `CamelCase` for classes)

## File Structure

- `/` - Root directory for web-accessible files
- Place PHP files, HTML, CSS, JS here
- Database connections via `mysqli` or `PDO`

## External Dependencies

- XAMPP provides PHP, MySQL, Apache
- No additional package managers detected

## Common Tasks

- Database setup: Use phpMyAdmin at `http://localhost/phpmyadmin/`
- Error logging: Check Apache error logs in XAMPP directory

Since the codebase is currently empty, these are baseline assumptions for a typical XAMPP PHP project. Update this file as the project evolves with specific patterns and conventions.
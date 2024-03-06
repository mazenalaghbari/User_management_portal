# User Management Portal

## Description
The User Management Portal is a web application that allows administrators to manage users and their roles.

## Features
- User registration and login
- CRUD operations for users
- Assigning and managing roles for users
- CRUD operations for roles

## Technologies Used
- PHP
- MySQL
- Bootstrap
- HTML
- CSS

## Setup
1. **Database Setup:**
   - Create a MySQL database named `user_management_portal`.
   - Import the `database.sql` file to create the necessary tables.

2. **Configuration:**
   - Update the `db_connection.php` file with your MySQL database credentials.

3. **Running the Application:**
   - Place the project files in your web server directory (e.g., `htdocs` for XAMPP, `www` for WAMP).
   - Access the application through your web browser.

## Database Tables
### users
- **id** (INT, primary key, auto-increment) - The unique identifier for each user.
- **username** (VARCHAR) - The username of the user.
- **password** (VARCHAR) - The hashed password of the user.
- **full_name** (VARCHAR) - The full name of the user.
- **phone** (VARCHAR) - The phone number of the user.
- **email** (VARCHAR) - The email address of the user.

### roles
- **id** (INT, primary key, auto-increment) - The unique identifier for each role.
- **name** (VARCHAR) - The name of the role.
- **description** (TEXT) - The description of the role.

### user_roles
- **user_id** (INT, foreign key) - The ID of the user assigned to a role.
- **role_id** (INT, foreign key) - The ID of the role assigned to a user.

## Screenshots
Include screenshots of the application interface to provide a visual representation of the application.

## Credits
- [Bootstrap](https://getbootstrap.com/)
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)

## License
This project is licensed under the [MIT License](LICENSE).

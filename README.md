# Project Title: DQS (Digital Queing System)

## Overview
This project is a PHP application designed to mimic POS(Point Of Sales) systems but with added admin access to manage products. It is built using the XAMPP development environment.

## Prerequisites
- **XAMPP**: Ensure you have XAMPP installed on your machine. You can download it from [Apache Friends](https://www.apachefriends.org/index.html).

## Installation Instructions

1. **Download XAMPP**:
   - Go to the [XAMPP website](https://www.apachefriends.org/index.html) and download the installer for your operating system.

2. **Install XAMPP**:
   - Run the installer and follow the setup instructions. Make sure to install Apache and MySQL components.

3. **Set Up the Project**:
   - Place the `dqs` folder inside the `htdocs` directory of your XAMPP installation:
     ```
     C:\xampp\htdocs\
     ```

4. **Set Up the Database**:
   - Open phpMyAdmin by navigating to `http://localhost/phpmyadmin` in your web browser.
   - Create a new database named `dqs`.
   - Import the `dqs.sql` file into the newly created database using phpMyAdmin.

5. **Start XAMPP**:
   - Open the XAMPP Control Panel.
   - Start the **Apache** and **MySQL** modules.

6. **Access the Project**:
   - Open your web browser and enter the following URL:
     ```
     http://localhost:8080/dqs
     ```
   - Note: The port number may vary based on your XAMPP configuration. Check the Apache port settings in the XAMPP Control Panel if you encounter issues.

## Usage
- Once you access the project through your browser, you can interact with its features as intended.

## User Access and Administration

### Admin Access
- The application requires an admin user to access the admin section and manage users.
- **Default Admin Credentials**:
  - **Username**: `admin`
  - **Password**: `admin`

### Important Notes
- **User Registration**: Currently, there is no user registration feature implemented. User management (adding new users) is done exclusively through the admin section.
- **Override Login**: If you need to access the application as an admin, you can use the default credentials mentioned above. This will allow you to log in and manage users within the application.
- **Hardcode***: If you cant login using the credentials provided above, you need to add an admin user in database directly via myphpAdmin page, or if a user admin exist use it instead

## Important Notes
- This project is currently unoptimized and lacks comments in the code. It is recommended for educational purposes or as a reference point for further development.
- If you encounter any issues, please refer to the [XAMPP documentation](https://www.apachefriends.org/docs/) for troubleshooting tips.


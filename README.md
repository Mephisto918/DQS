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

## Known Issues and Constraints

### User Deletion Constraint
In the current implementation of the application, there is a database constraint that prevents users from being deleted under certain conditions. This issue arises from the relationships established between users, products, and orders in the database.

#### Conditions Leading to the Constraint
1. **Stock Management**: When a user adds stock for a product, this action creates dependencies in the database.
2. **Order Processing**: Admin/Manager can place orders for products to add a stock. These orders are tracked in the system.
3. **Pending Orders**: There is a hidden override button that allows access to a `reject/deliver` page for managing pending orders in lower right green button.
4. **Delivery Records**: Once an order is processed (either rejected or delivered), it creates records in the history table that reference the Admin/Manager.

Due to these dependencies, attempting to delete a user who has associated orders or delivery records will trigger a foreign key constraint violation, preventing deletion.

#### Implications
- Admins/Manager cannot be deleted if they have any associated records in the orders or deliveries tables.
- This design choice ensures data integrity but may lead to confusion when trying to manage Admins/Managers.

#### Workaround
To delete a user:
1. Ensure that all associated orders and delivery records are removed or updated to dissociate them from the admin/user.
2. Since there is no `delete` button available in orders history table, it needs to be deleted manualy on the database.

## Incomplete Data Analytics

### Overview
The reporting feature was intended to include charts for sales over different time spans: 1 day, 1 week, and 1 month. However, due to time constraints related to school deadlines, only the chart for a 1-day span has been partially implemented.

### Current Status
- The 1-day sales chart is present but currently non-functional; it only consists of a frame with no data visualization.
- The charts for the 1-week and 1-month spans have not been developed.

### Technology Used
- D3.js was chosen for its powerful data visualization capabilities, but its learning curve contributed to the project's incomplete status.

### Conclusion
This section of the application is unfinished and may not provide meaningful insights at this time. Future development is needed to complete the analytics features.



This project is currently unoptimized and lacks comments in the code. It is recommended for educational purposes or as a reference point for further development.



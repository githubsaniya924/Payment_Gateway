## <h2>Payment_Gateway<h2>
### **Mobifi** is an e-commerce website designed to showcase products and allow users to make purchases. This project includes dynamic pages, user authentication, and payment integration using PayPal. 
### Screenshots of the website
https://www.ilovepdf.com/download/s7r6237jjzdh59l4w1yfd2rvyypcrfy27jl9kfv9dmcm00A8b85cb9s250pAgkvfzwj1255bbjczfngv70nxtnp4pflrx8ycsd4qn1kx3rqA2r0gsAg7b112r8htf8Azr7s3pbg5b7pvmrcyjr7zlfj3zhts233ty087735qd37426s8w8xq/80
## Overview
This is an e-commerce platform designed to allow users to browse products, sign up, log in, and complete purchases. The website includes a **Sign Up** page, **Login** page, **Payment Page** using PayPal, and backend logic to process orders. 

The website uses **PHP** for dynamic page handling (user authentication, order management) and **Bootstrap 5** for responsive design.

**Important Note**: The files in this project are saved with a `.php` extension, which GitHub Pages does not support for dynamic content. However, you can run and view the website on your local machine using XAMPP (or any other local server setup that supports PHP).
## File Descriptions

### 1. **index.php**
   - The homepage of the Mobifi store.
   - Displays featured products and links to sign-up and login pages.
   - Bootstrap is used for the layout and responsiveness.
   
### 2. **sign_up.html**
   - This page provides a registration form where new users can sign up.
   - It collects the user's name, email, phone, and password (for authentication).
   - The form is designed using **Bootstrap** for a modern, responsive look.

### 3. **login.html**
   - Allows existing users to log into their accounts by providing email and password.
   - After login, users are redirected to the main page or their profile.

### 4. **front.php**
   - This PHP script handles the form submissions from the **Sign Up** and **Login** pages.
   - When users submit the forms, the data is processed (stored in the database or checked against existing data).
   - It ensures proper validation of user data before redirecting the user to the next page.

### 5. **payment_page.php**
   - This page integrates PayPal for processing payments.
   - Users are redirected here after placing items in their cart.
   - PayPal's SDK is used to generate a payment button, and after payment is complete, users are redirected to the **payment_callback.php** page.

### 6. **payment_callback.php**
   - This page handles the callback from PayPal once the payment is complete.
   - It captures transaction details and stores the payment ID in the database.
   - The user is shown a confirmation message and transaction details.

### 7. **order_details.php**
   - This PHP script is responsible for inserting order details (like `order_id`, `name`, `email`, etc.) into the database after a successful transaction.
   - It ensures that the order is recorded and linked to the user for later reference.

### 8. **config.php**
   - This file contains database connection settings.
   - It uses `mysqli` or `PDO` to connect the PHP scripts to a MySQL database.
   - Ensures that the application can retrieve and store user data, order details, and payment records.

### 9. **assets/**
   - Contains various files that support the functionality of the website.
     - **images/**: Product images, logos, etc.
     - **css/**: Custom styles for the pages.
     - **js/**: Scripts to handle user interactions (e.g., form validation, AJAX requests).

### Technologies Used
HTML5: For structuring the content of the pages.
CSS3: For styling the pages (with Bootstrap 5 for responsive design).
PHP: For handling form submissions, user authentication, and backend logic.
MySQL: For storing user details, order information, and transaction records.
PayPal SDK: For integrating PayPal payments.
Bootstrap 5: For building responsive and modern layouts.
### Future Enhancements
Implement user authentication (login/logout, password recovery).
Add a shopping cart feature for better order management.
Improve payment gateway integration with multiple payment options.

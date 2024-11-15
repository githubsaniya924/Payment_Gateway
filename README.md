# <h3>Payment_Gateway<h3>

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

## How to Run

1. **Clone the Repository**:
   - Clone the repository to your local machine using:
   ```bash
   git clone https://github.com/yourusername/mobifi.git

<?php
require 'config.php'; // Make sure your database connection is set in config.php

// Sanitize the incoming data
$status = isset($_GET['status']) ? htmlspecialchars($_GET['status'], ENT_QUOTES, 'UTF-8') : '';
$payment_id = isset($_GET['payment_id']) ? htmlspecialchars($_GET['payment_id'], ENT_QUOTES, 'UTF-8') : '';

// Check if status is success and payment_id is provided
if ($status == 'success' && !empty($payment_id)) {
    // Mark the order as completed in your database
    // Example: Update the payment status in the database
    try {
        // Assuming there's an 'orders' table with 'payment_status' and 'payment_id' columns
        $query = "UPDATE orders SET payment_status = 'completed', payment_id = :payment_id WHERE order_id = :order_id";
        
        // Prepare and execute the query
        $stmt = $pdo->prepare($query); // Assuming PDO is used for database connection
        $stmt->execute([
            ':payment_id' => $payment_id,
            ':order_id' => $_SESSION['order_id'] // Assuming order_id is stored in session after creating the order
        ]);

        echo "Payment successful. Your payment ID is " . $payment_id;
    } catch (Exception $e) {
        // Handle any database errors
        echo "Error updating order: " . $e->getMessage();
    }
} else {
    echo "Payment failed. Please try again.";
}
?>

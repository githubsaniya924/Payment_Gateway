<?php
require 'config.php';

if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Prepare payment data
    $paymentData = [
        'amount' => $product_price * 100, // Payment gateway usually takes amount in paisa for INR (multiply by 100)
        'currency' => 'INR',
        'receipt' => 'order_rcptid_11',
        'payment_capture' => 1 // Auto-capture the payment
    ];

    // API credentials (replace with real keys)
    $apiKey = 'Aet7sMOOV45fLlt_nM2QsRv35CLA5-wjGEH2D72P5YHyyoGwjC3TqCVg1VnXx2AB_tCY74RQgwDrY4uX';
    $apiSecret = 'EH3BRvVh3J1rtXNkVee95TU1HZD_Pt4z8onIS55unvPZgdjdTRw163UGYkJXtypM5lDwcx5JAhyK7pTD';

    // Initiate a payment session with the payment gateway
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v2/checkout/orders');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));
    curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ':' . $apiSecret);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $orderData = json_decode($response, true);

    if (isset($orderData['id'])) {
        $orderId = $orderData['id'];
        
        // Redirect to the payment page
        echo "<script>
                location.href = 'payment_page.php?order_id=$orderId&name=$name&email=$email&phone=$phone';
              </script>";
    } else {
        echo "Error creating payment order. Please try again.";
    }
}
?>

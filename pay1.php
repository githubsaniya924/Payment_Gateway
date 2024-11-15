<?php
require 'config.php';

if (isset($_POST['submit'])) {
    // Sanitize user inputs to prevent SQL injection and XSS attacks
    $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
    $product_price = floatval($_POST['product_price']);
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');

    // Validate inputs
    if (empty($product_name) || empty($product_price) || empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($phone)) {
        die('Invalid input data. Please fill in all required fields correctly.');
    }

    // Replace with your PayPal credentials (better to store in environment variables for security)
    $clientId = 'Aet7sMOOV45fLlt_nM2QsRv35CLA5-wjGEH2D72P5YHyyoGwjC3TqCVg1VnXx2AB_tCY74RQgwDrY4uX'; // Replace with your PayPal client ID
    $clientSecret = 'EH3BRvVh3J1rtXNkVee95TU1HZD_Pt4z8onIS55unvPZgdjdTRw163UGYkJXtypM5lDwcx5JAhyK7pTD'; // Replace with your PayPal client secret

    // Step 1: Get the PayPal OAuth Access Token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/oauth2/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_USERPWD, $clientId . ':' . $clientSecret);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    $response = curl_exec($ch);
    if ($response === false) {
        die('Error in obtaining OAuth token: ' . curl_error($ch));
    }
    curl_close($ch);

    $responseData = json_decode($response, true);

    if (!isset($responseData['access_token'])) {
        die('Error retrieving PayPal OAuth token: ' . json_encode($responseData));
    }

    $accessToken = $responseData['access_token'];

    // Step 2: Create the PayPal order
    $paymentData = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => 'USD', // Ensure you're charging in USD
                    'value' => $product_price
                ]
            ]
        ]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v2/checkout/orders');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    if ($response === false) {
        die('Error in creating PayPal order: ' . curl_error($ch));
    }
    curl_close($ch);

    $orderData = json_decode($response, true);

    if (!isset($orderData['id'])) {
        die('Error creating PayPal order: ' . json_encode($orderData));
    }

    $orderId = $orderData['id'];

    // Redirect to the PayPal payment page
    echo "<script>
        location.href = 'payment_page.php?order_id=$orderId&name=" . urlencode($name) . "&email=" . urlencode($email) . "&phone=" . urlencode($phone) . "';
    </script>";
}
?>

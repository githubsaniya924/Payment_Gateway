<?php
// Retrieve query parameters securely
require 'config.php';
$order_id = htmlspecialchars($_GET['order_id'], ENT_QUOTES, 'UTF-8');
$name = htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_GET['email'], ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($_GET['phone'], ENT_QUOTES, 'UTF-8');



$sql = "INSERT INTO order_details(order_id,name,email,phone) VALUES('$order_id','$name','$email','$phone')";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Load PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=Aet7sMOOV45fLlt_nM2QsRv35CLA5-wjGEH2D72P5YHyyoGwjC3TqCVg1VnXx2AB_tCY74RQgwDrY4uX&currency=USD"></script>
</head>
<body>
    <h2>Complete Your Payment</h2>
    <p>Order ID: <?= $order_id ?></p>
    <p>Name: <?= $name ?></p>
    <p>Email: <?= $email ?></p>
    <p>Phone: <?= $phone ?></p>

    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // Set up the transaction
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '10.00' // Replace this with the actual amount in USD
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capture the transaction
                return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    // Redirect to callback page with success status
                    window.location.href = "payment_callback.php?status=success&order_id=<?= $order_id ?>&payer_id=" + data.payerID;
                });
            },
            onCancel: function(data) {
                // Handle cancellation
                alert('Payment was canceled.');
                window.location.href = "payment_callback.php?status=canceled&order_id=<?= $order_id ?>";
            },
            onError: function(err) {
                // Handle errors
                console.error('Error during payment:', err);
                alert('An error occurred during the payment process.');
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>

<?php
    require 'config.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "SELECT * FROM product WHERE id='$id'";

        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);

        $pname = $row['product_name'];
        $pprice = $row['product_price'];
        $del_charge = 50;
        $total_price = $pprice + $del_charge;
        $pimage = $row['product_image'];
    }
    else{
        echo "No product found";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php
    require 'navbar.html';
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-5">
            <h2 class="text-center p-2">Fill the details to complete your order</h2>
            <h3>Product Details:</h3>
            <table class="table table-bordered" width="500px">
                <tr>
                    <th>Product Name: </th>
                    <td><?= $pname ?></td>
                    <td rowspan="4"><img src="<?= $pimage ?>" width="200"></td>
                </tr>
                <tr>
                    <th>Product Price: </th>
                    <td><?= number_format($pprice) ?></td>
                </tr>
                <tr>
                    <th>Delivery Charge: </th>
                    <td><?= number_format($del_charge) ?></td>
                </tr>
                <tr>
                    <th>Total Price: </th>
                    <td><?= number_format($total_price) ?></td>
                </tr>
            </table>
            <h4>Enter your details: </h4>
            <form action="pay1.php" method="POST" accept-charset="UTF-8">
                <input type="hidden" name="product_name" value="<?= $pname?>">
                <input type="hidden" name="product_price" value="<?= $pprice?>">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Enter your name" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Enter your email id" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" placeholder="Enter your Phone no" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Click to Pay: Rs.<?= number_format($total_price)?>" class="btn btn-danger" required>
                </div>
            </form>

        </div>
    </div>

</div>
</body>
</html>
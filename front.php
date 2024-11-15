<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Product page</title>
</head>
<body>
    <?php include 'navbar.html'; ?>
    <?php require 'config.php';
        $sql = "SELECT * FROM product";

        $result = mysqli_query($conn, $sql);
       
    ?>

<div class="container mt-4">
	<div class="row">
		<?php while ($row = mysqli_fetch_array($result)) { ?>
			<div class="col-lg-4 mt-3 mb-3">
				<div class="card p-2" style="border-color: 1px solid grey">
					<img src="<?= $row['product_image']; ?>" class="card-img-top" height="320">
					<h5 class="card-title">Product: <?= $row['product_name']; ?></h5>
					<h3>Price: <?= number_format($row['product_price']); ?>/-</h3>
					<a href="order.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-block">Buy Now</a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
</body>
</html>
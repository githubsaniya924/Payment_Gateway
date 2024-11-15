<?php
    require 'config.php';
    $msg="";
    if(isset($_POST['submit'])){
        $pname = $_POST['pName'];
        $pprice = $_POST['pPrice'];

        $target_dir = "image/";
        $target_file = $target_dir.basename($_FILES['pImage']['name']);
        move_uploaded_file($_FILES['pImage']['tmp_name'],$target_file);

        $sql = "INSERT INTO product(product_name,product_price,product_image) VALUES('$pname','$pprice','$target_file')";

        if(mysqli_query($conn,$sql)){
           $msg= "Product Added to the database successfully";
        }
        else{
            $msg="Failed to Add the product";
        }
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
    <title>Add products</title>
</head>
<body class="bg-info">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-light mt-5 rounded">
                <h2 class="text-center p-2">Add Product Information</h2>
                <form action="" method="POST" class="p-2" enctype="multipart/form-data" id="form-box">
                    <div class="form-group">
                        <input type="text" name="pName" class="form-control" placeholder="product Name" required>
                    </div><br>

                    <div class="form-group">
                        <input type="text" name="pPrice" class="form-control" placeholder="product Price" required>
                    </div><br>
						
                    <div class="form-group">
						<div class="input-group">
							<input type="file" name="pImage" class="form-control" id="pImage" style="display: none;" required>
							<input type="text" class="form-control" placeholder="Select File" id="filePlaceholder" readonly>
							<label class="input-group-text btn btn-secondary" for="pImage">Choose File</label>
						</div>
					</div><br>
                    
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-danger btn-block w-100" value="Add">
                    </div>
                    <div class="form-group">
                        <h4 class="text-center"><?=$msg;?></h4>
                    </div>
                </form>
            </div>
        </div>
            <div class="row justify-content-center">
                <div class="col-md-6 mt-3 p-4 bg-light rounded">
                    <a href="front.php" class="btn btn-warning btn-block w-100">Go to product</a> 
            </div>
            </div>
    </div>
    
</body>
</html>
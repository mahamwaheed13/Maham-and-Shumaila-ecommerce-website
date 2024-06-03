<?php
include('../includes/connect.php');

if(isset($_POST['insert_product'])){
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $keyword = $_POST['keyword'];
    $price = $_POST['price'];
    $product_status = 'true';

    // Accessing images
    $product_image = $_FILES['product_image']['name'];
    // Accessing images temp
    $temp_image = $_FILES['product_image']['tmp_name'];

    // Checking empty condition
    if($product_title == '' || $description == '' || $product_image == '' || $price == '' || $keyword == ''){
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    } else {
        move_uploaded_file($temp_image, "./product_images/$product_image");
        
        // Make sure $con is defined and not null
        if (isset($con) && $con) {
            // Insert query
            $insert_product = "INSERT INTO products (product_title, product_description, product_keywords, product_image, product_price, date, status) VALUES ('$product_title', '$description', '$keyword', '$product_image', '$price', NOW(), '$product_status')";
            
            $result_query = mysqli_query($con, $insert_product);
            if($result_query){
                echo "<script>alert('Successfully inserted the product')</script>";
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Error: Database connection is not established.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <!-- Description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>
            <!-- Keyword -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="keyword" class="form-label">Product Keyword</label>
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Enter product keyword" autocomplete="off" required="required">
            </div>
            <!-- Image -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image" class="form-label">Product Image</label>
                <input type="file" name="product_image" id="product_image" class="form-control" required="required">
            </div>
            <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="price" class="form-label">Product Price</label>
                <input type="text" name="price" id="price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            <!-- Submit -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Product">
            </div>
        </form>
    </div>
</body>
</html>

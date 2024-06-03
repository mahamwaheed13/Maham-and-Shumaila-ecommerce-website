<?php
// Include database connection code
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    // Retrieve form data
    $customer_name = $_POST['customer_name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    
    // Calculate total amount based on selected items
    $total_amount = 0;
    if (!empty($_POST['selected_items'])) {
        foreach ($_POST['selected_items'] as $product_id) {
            // Retrieve product details
            $product_query = "SELECT product_price FROM products WHERE product_id = '$product_id'";
            $product_result = mysqli_query($con, $product_query);
            $product = mysqli_fetch_assoc($product_result);
            
            // Add product price to total amount
            $total_amount += $product['product_price'];
        }
    }
    
    // Insert order into the database
    $insert_query = "INSERT INTO orders (customer_name, contact, address, total_amount) VALUES ('$customer_name', '$contact', '$address', '$total_amount')";
    $result = mysqli_query($con, $insert_query);
    
    // Check if the order was successfully inserted
    if ($result) {
        // Retrieve the last inserted order ID
        $order_id = mysqli_insert_id($con);
        
        // Iterate over selected items and insert them into order_details table
        if (!empty($_POST['selected_items'])) {
            foreach ($_POST['selected_items'] as $product_id) {
                // Retrieve product details
                $product_query = "SELECT * FROM products WHERE product_id = '$product_id'";
                $product_result = mysqli_query($con, $product_query);
                $product = mysqli_fetch_assoc($product_result);
                
                // Insert item into order_details table
                $insert_detail_query = "INSERT INTO order_details (order_id, product_id, product_name, quantity, price) VALUES ('$order_id', '{$product['product_id']}', '{$product['product_title']}', '{$product['quantity']}', '{$product['product_price']}')";
                mysqli_query($con, $insert_detail_query);
            }
        }
        
        echo '<div class="alert alert-success" role="alert">Order placed successfully! On its way' . $order_id . '</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Failed to place order. Please try again.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <!-- Your order form HTML code -->
</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>

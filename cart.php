<?php
// Include database connection code
include('db_connection.php');

// Handle adding items to the cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if the item is already in the cart
    $check_query = "SELECT * FROM cart_details WHERE product_id = '$product_id'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // If item is already in the cart, update the quantity
        $update_query = "UPDATE cart_details SET quantity = quantity + '$quantity' WHERE product_id = '$product_id'";
        mysqli_query($con, $update_query);
    } else {
        // Add the item to the cart
        $insert_query = "INSERT INTO cart_details (product_id, quantity) VALUES ('$product_id', '$quantity')";
        mysqli_query($con, $insert_query);
    }
}

// Handle removing items from the cart
if (isset($_POST['remove_item'])) {
    $product_id = $_POST['product_id'];

    // Remove the item from the cart
    $remove_query = "DELETE FROM cart_details WHERE product_id = '$product_id'";
    mysqli_query($con, $remove_query);
}

// Fetch cart items from the database
$cart_query = "SELECT products.product_id, products.product_title, products.product_price, cart_details.quantity FROM products INNER JOIN cart_details ON products.product_id = cart_details.product_id";
$cart_result = mysqli_query($con, $cart_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Shopping Cart</h1>
        <form method='POST' action='place_order.php'>
            <?php
            if (mysqli_num_rows($cart_result) > 0) {
                $total_price = 0;
                while ($row = mysqli_fetch_assoc($cart_result)) {
                    $product_total = $row['product_price'] * $row['quantity'];
                    $total_price += $product_total;
                    echo "<div class='card mb-3'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row['product_title']}</h5>
                                <p class='card-text'>Quantity: {$row['quantity']}</p>
                                <p class='card-text'>Price: {$row['product_price']}</p>
                                <p class='card-text'>Total: $product_total</p>
                                <form method='POST' action=''>
                                    <input type='hidden' name='product_id' value='{$row['product_id']}'>
                                    <button type='submit' class='btn btn-danger' name='remove_item'>Remove</button>
                                </form>
                            </div>
                        </div>";
                }
                // Display the total price
                echo "<h3>Total Price: $total_price</h3>";

                // Order form
                echo "<div class='card mb-3'>
                        <div class='card-body'>
                            <h5 class='card-title'>Proceed to Checkout</h5>
                            <label for='customer_name'>Your Name:</label><br>
                            <input type='text' id='customer_name' name='customer_name' required><br><br>

                            <label for='contact'>Contact:</label><br>
                            <input type='text' id='contact' name='contact' required><br><br>

                            <label for='address'>Address:</label><br>
                            <textarea id='address' name='address' required></textarea><br><br>
                            
                            <input type='submit' class='btn btn-primary' name='place_order' value='Place Order'>
                        </div>
                    </div>";
            } else {
                echo "<p>Your cart is empty</p>";
            }
            ?>
        </form>
    </div>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>

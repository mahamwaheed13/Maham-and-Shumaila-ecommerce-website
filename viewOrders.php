<?php
// Define connection parameters
$servername = 'localhost:3307';  // or '127.0.0.1'
$username = 'root';              // Replace with your MySQL username
$password = '';                  // Replace with your MySQL password
$dbname = 'mystore';             // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories from the database
$sql = "SELECT * FROM orders";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
    <!-- BOOTSTRAP CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
          crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Orders</h1>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            echo '<div class="list-group">';
            while ($row = $result->fetch_assoc()) {
                echo '<a href="#" class="list-group-item list-group-item-action">';
                echo '<h5 class="mb-1">' . htmlspecialchars($row["customer_name"]) . '</h5>';
                echo '<h5 class="mb-1">' . htmlspecialchars($row["total_amount"]) . '</h5>';
                echo '<h5 class="mb-1">' . htmlspecialchars($row["product_name"]) . '</h5>';
                echo '</a>';
            }
            echo '</div>';
        } else {
            echo "<p>No orders found</p>";
        }
        // Close connection
        $conn->close();
        ?>
    </div>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
            crossorigin="anonymous"></script>
</body>
</html>

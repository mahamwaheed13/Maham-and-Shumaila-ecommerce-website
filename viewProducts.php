<?php
// Database connection
$servername = 'localhost:3307';  // or '127.0.0.1'
$username = 'root';              // Replace with your MySQL username
$password = '';                  // Replace with your MySQL password
$dbname = 'mystore';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row["product_title"] . "</h2>";
        echo "<p>Description: " . $row["product_description"] . "</p>";
        echo "<p>Price: $" . $row["product_price"] . "</p>";
        // Add more fields if needed
        echo "</div>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

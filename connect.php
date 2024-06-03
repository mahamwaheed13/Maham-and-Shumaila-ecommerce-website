<?php
// Define connection parameters
$servername = 'localhost:3307';  // or '127.0.0.1'
$username = 'root';              // Replace with your MySQL username
$password = '';                  // Replace with your MySQL password
$dbname = 'mystore';             // Replace with your MySQL database name

// Attempt to establish a connection to MySQL
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

// Example query execution
$query = "SELECT * FROM products";
$result = mysqli_query($con, $query);
if ($result) {
    // Query executed successfully
    // Process the result set
} else {
    // Query execution failed
    echo "Error: " . mysqli_error($con);
}

// Optionally, you can close the connection at the end of your script execution
// mysqli_close($con);
?>

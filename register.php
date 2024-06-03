<?php
// Define connection parameters
$servername = 'localhost:3307';  // or '127.0.0.1'
$username = 'root';              // Replace with your MySQL username
$password = '';                  // Replace with your MySQL password
$dbname = 'mystore';             // Replace with your MySQL database name

// Attempt to establish a connection to MySQL
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle signup form submission
if(isset($_POST['signup'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $insert_query = "INSERT INTO users (name, password) VALUES ('$name', '$hashed_password')";
    $result_insert = mysqli_query($con, $insert_query);
    if($result_insert) {
        // User registered successfully
        echo '<div class="alert alert-success" role="alert">Registration successful!</div>';
    } else {
        // Error registering user
        echo '<div class="alert alert-danger" role="alert">Failed to register. Please try again.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Register</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="signup">Sign Up</button>
    </form>
</div>
</body>
</html>

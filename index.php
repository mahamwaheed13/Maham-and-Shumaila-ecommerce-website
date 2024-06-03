<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Meta Description for SEO -->
    <meta name="description" content="Admin Dashboard to manage products, categories, orders, and payments.">

    <!-- BOOTSTRAP CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
          crossorigin="anonymous">

    <!-- Custom CSS link -->
    <link rel="stylesheet" href="../style.css">
    <style>
        .admin_image {
            width: 100px;
            object-fit: contain;
        }
        .button a {
            text-decoration: none;
            color: white;
        }
        .button a:hover {
            color: #000;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../img/logo.png" alt="Company Logo" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Welcome Guest</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    
    <!-- Manage Details Section -->
    <div class="bg-light">
        <h3 class="text-center p-2">Manage Details</h3>
    </div>

    <!-- Buttons Section -->
    <div class="row">
        <div class="col-md-12 bg-secondary p-1 d-flex align-items-center justify-content-center">
            <div class="px-5">
                <div class="button text-center">
                    <button class="btn btn-info my-1">
                        <a href="insert_products.php">Insert Products</a>
                    </button>
                    <button class="btn btn-info my-1">
                        <a href="viewProducts.php">View Products</a>
                    </button>
                    <button class="btn btn-info my-1">
                        <a href="view_categories.php">View Categories</a>
                    </button>
                    <button class="btn btn-info my-1">
                        <a href="viewOrders.php">All Orders</a>
                    </button>
                   
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
            crossorigin="anonymous"></script>
</body>
</html>

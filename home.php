<?php
// Start the session
session_start();
?>
<!DOCTYPE html>

<html>
  
  <head>
    <title>Home Page</title>
    <meta name="author" content="Brandon Jillson">
    <meta charset="utf-8">
    <meta name="description" content="Shopping project">
    <meta name="keywords" content="e-commerce, online store, shopping, shop">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    * {
      box-sizing: border-box;
    }

    body {
        background-color: #ffffff;
      font-family: Arial, Helvetica, sans-serif;
    }

    /* Style the header */
    header {
      background-color: #000000;
      padding: 10px;
      width: 30%;
      text-align: left;
      font-size: 25px;
      color: rgb(255, 255, 255);
    }

    /* Create two columns/boxes that floats next to each other */
    nav {
      float: left;
      width: 30%;
      height: 300px; /* only for demonstration, should be removed */
      background: #ccc;
      padding: 20px;
    }

    /* Style the list inside the menu */
    nav ul {
      list-style-type: none;
      padding: 0;
    }



    /* Clear floats after the columns */
    section::after {
      content: "";
      display: table;
      clear: both;
    }

    /* Style the footer */
    footer {
      background-color: #ffffff;
      padding: 10px;
      text-align: left;
      color: rgb(0, 0, 0);
    }

    /* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
    @media (max-width: 600px) {
      nav, article {
        width: 100%;
        height: auto;
      }
    }
    </style>
  </head>
  <body>





    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Home</a>
            
          <ul class="navbar-nav ms-auto">
            
            <?php 
            if ($_SESSION['logged_in']): ?>
              <li class="nav-item"><a class="nav-link" href="profile.php">Profile <?= $_SESSION['name'] ?></a></li>
              <li class="nav-item"><a class="nav-link" href="index.php">Logout</a></li>
            <?php  else: ?>
              <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
              <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            <?php endif; ?>
            <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>

          </ul>

      </div>
    </nav>

    <!-- Category Menu -->
    <div class="container mt-4">
      <h3 class="text-center">Shop by Category</h3>
      <div class="row text-center">
        <div class="col">
          <a href="category.php?cat=electronics" class="btn btn-outline-primary m-2">Electronics</a>
          <a href="category.php?cat=clothing" class="btn btn-outline-success m-2">Clothing</a>
          <a href="category.php?cat=home" class="btn btn-outline-warning m-2">Home</a>
          <a href="category.php?cat=books" class="btn btn-outline-info m-2">Books</a>
        </div>
      </div>
    </div>

    <!-- Featured Products (Dynamic) -->
    <div class="container mt-5">
      <h3 class="text-center mb-4">Featured Products</h3>
      <div class="row">
        <?php
        $query = "SELECT * FROM products LIMIT 4";
        
        ?>
      </div>
    </div>



    <!-- Contact Info + Map -->
    <div class="container my-5">
      <h4 class="text-center">Visit Our Store</h4>
      <div class="row">
        <div class="col-md-6">
          <p><strong>Address:</strong> 123 E-Commerce Rd, Windsor, ON</p>
          <p><strong>Email:</strong> support@shopsmart.com</p>
          <p><strong>Phone:</strong> (519) 555-1234</p>
        </div>
        <div class="col-md-6">
          <div id="map" style="height:300px;"></div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
      &copy; <?= date("Y") ?> ShopSmart. All rights reserved.
    </footer>



  </body>
</html>

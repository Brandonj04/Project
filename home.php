<?php
session_start();
?>
<!DOCTYPE html>

<html>
  
  <head>
    <title>Home Page</title>
    <meta name="author" content="Brandon Jillson">
    <meta name="description" content="Shopping project">
    <meta name="keywords" content="e-commerce, online store, shopping, shop">
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    * {
      box-sizing: border-box;
    }

    body {
        background-color: #ffffff;
      font-family: Arial, Helvetica, sans-serif;
    }

    header {
      background-color: #000000;
      padding: 10px;
      width: 30%;
      text-align: left;
      font-size: 25px;
      color: rgb(255, 255, 255);
    }


    nav {
      float: left;
      width: 30%;
      height: 300px;
      background: #ccc;
      padding: 20px;
    }

    nav ul {
      list-style-type: none;
      padding: 0;
    }



    section::after {
      content: "";
      display: table;
      clear: both;
    }

    footer {
      background-color: #ffffff;
      padding: 10px;
      text-align: left;
      color: rgb(0, 0, 0);
    }

    @media (max-width: 600px) {
      nav, article {
        width: 100%;
        height: auto;
      }
    }
    </style>
  </head>
  <body>






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


    <div class="container mt-4">
      <h3 class="text-center">Shop by Category</h3>
      <div class="row text-center">
        <div class="col">
          <a href="products.php?category=Electronics" class="btn btn-outline-primary m-2">Electronics</a>
          <a href="products.php?category=Clothing" class="btn btn-outline-success m-2">Clothing</a>
          <a href="products.php?category=Home" class="btn btn-outline-warning m-2">Home</a>
          <a href="products.php?category=Books" class="btn btn-outline-info m-2">Books</a>
        </div>
      </div>
    </div>







    <div class="container my-5">
      <h4 class="text-center">Visit Our Store</h4>
      <div class="row">
        <div class="col-md-6">
          <p><strong>Address:</strong> 123 E-Commerce Rd, Windsor, ON</p>
          <p><strong>Email:</strong> </p>
          <p><strong>Phone:</strong> (519) 555-1234</p>
        </div>
        <div class="col-md-6">
          <div id="map" style="height:300px;"></div>
        </div>
      </div>
    </div>


    <footer class="bg-dark text-white text-center py-3">
      &copy; <?= date("Y") ?> All rights reserved.
    </footer>



  </body>
</html>

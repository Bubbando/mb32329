<?php 
session_start();
include("admin/includes/db.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Site meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>mb32329
    </title>
    <!-- CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">mb32329
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
          </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
          <ul class="navbar-nav m-auto">
            <li class="nav-item <?php if($active=='Home') echo"active"; ?>">
              <a class="nav-link" href="index.php">Home
              </a>
            </li>
            <li class="nav-item <?php if($active=='Buy') echo"active"; ?>">
              <a class="nav-link" href="buy.php">Buy
              </a>
            </li>
            <li class="nav-item <?php if($active=='Trade') echo"active"; ?>">
              <a class="nav-link" href="trade.php">Trade 
                <span class="sr-only">(current)
                </span>
              </a>
            </li>
            <?php if(isset($_SESSION["loggedin"])){ ?>
            <li class="nav-item <?php if($active=='Cart') echo"active"; ?>">
              <a class="nav-link" href="cart.php">Cart
              </a>
            </li>
            <li class="nav-item <?php if($active=='Orders') echo"active"; ?>">
              <a class="nav-link" href="orders.php">Orders
              </a>
            </li>
            <li class="nav-item <?php if($active=='Logout') echo"active"; ?>">
              <a class="nav-link" href="logout.php">Logout
              </a>
            </li>
            <?php }else{ ?>
            <li class="nav-item <?php if($active=='Login') echo"active"; ?>">
              <a class="nav-link" href="login.php">Login
              </a>
            </li>
            <li class="nav-item <?php if($active=='Register') echo"active"; ?>">
              <a class="nav-link" href="register.php">Register
              </a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>

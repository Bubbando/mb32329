<?php
include("includes/db.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>mb32329 Admin Panel</title>

    <style>
    body{background:#fff;}
#wrapper{padding:30px 15px;}
.navbar-expand-lg .navbar-nav.side-nav{flex-direction: column;}
@media(min-width:992px) {
#wrapper{margin-left: 200px;padding: 15px;}
.navbar-nav.side-nav{background: #585f66;position:fixed;top:56px;flex-direction: column;left:0;width:200px;overflow-y:auto;bottom:0;overflow-x:hidden;padding-bottom:40px}
}

h2 {
  text-align: center;
}

table caption {
	padding: .5em 0;
}

@media screen and (max-width: 767px) {
  table caption {
    border-bottom: 1px solid #ddd;
  }
}

.p {
  text-align: center;
  padding-top: 140px;
  font-size: 14px;
}

    </style>
  </head>
  <body>
    <h1>Hello, world!</h1>



    <div id="wrapper">
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
              <a class="navbar-brand" href="#">mb32329 ADMIN</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav side-nav">
								   <li class="nav-item <?php if($active=='Home') echo"active"; ?>">
                    <a class="nav-link" href="index.php">Home</a>
					</li>
				
				   <li class="nav-item <?php if($active=='Manage games') echo"active"; ?>">
                    <a class="nav-link" href="manage_games.php">Manage games</a>
					</li>
					
                  <li class="nav-item <?php if($active=='Manage platforms') echo"active"; ?>">
                    <a class="nav-link" href="platforms.php">Manage platforms</a>
                  </li>
                  <li class="nav-item <?php if($active=='Manage listed games') echo"active"; ?>">
                    <a class="nav-link" href="manage_listed_games.php">Manage listed games</a>
                  </li>
				   <li class="nav-item <?php if($active=='Manage orders') echo"active"; ?>">
                    <a class="nav-link" href="manage_orders.php">Manage orders</a>
                  </li>
				  				   <li class="nav-item <?php if($active=='Manage users') echo"active"; ?>">
                    <a class="nav-link" href="manage_users.php">Manage users</a>
                  </li>
                </ul>
<!-- -->
              </div>
            </nav>
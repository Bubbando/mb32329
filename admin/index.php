<?php 
$active='Home';
include("includes/header.php");
?>
<div class="container-fluid">
  <h1>Home
  </h1>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          Manage games database
        </div>
        <div class="card-body">
          <h5 class="card-title">Here you can add, remove or edit the games from the database
          </h5>
          <p class="card-text">You can add a new game by clicking "Manage games", there, you will see all the existing games always sorted by highest stock quantity. You can use the search filter with barcode to make it fast to find a game to edit or delete, and you can click "Insert new videogame" to add new videogames to the database.
          </p>
          <a href="manage_games.php" class="btn btn-primary">Manage games
          </a>
          <h5 class="card-title mt-2">Here you can add, remove or edit the platforms that are used when inserting a new game in the database
          </h5>
          <a href="platforms.php" class="btn btn-primary">Manage platforms
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <div class="card">
        <div class="card-header">
          Manage listed games
        </div>
        <div class="card-body">
          <h5 class="card-title">Here you can add, remove or edit the games that are listed and are currently being sold on the main website
          </h5>
          <p class="card-text">You can list a game by clicking "Manage listed games", which will show all the listed games, sorted by the highest stock quantity. To add a new game, you must search for a game by using the barcode (previously added in the "Insert new videogame" function). You can also unlist, edit, or delete games. (Note: If you click delete it will delete the game from the database completely!)
          </p>
          <a href="manage_listed_games.php" class="btn btn-primary">Manage listed games
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <div class="card">
        <div class="card-header">
          Manage orders
        </div>
        <div class="card-body">
          <h5 class="card-title">Here you can add, remove or edit the games from the database
          </h5>
          <p class="card-text">You can add a new game by clicking "Manage games", there, you will see all the existing games always sorted by highest stock quantity. You can use the search filter with barcode to make it fast to find a game to edit or delete, and you can click "Insert new videogame" to add new videogames to the database.
          </p>
          <a href="#" class="btn btn-primary">Manage orders
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <div class="card">
        <div class="card-header">
          Manage customers
        </div>
        <div class="card-body">
          <h5 class="card-title">Here you can add, remove or edit the games from the database
          </h5>
          <p class="card-text">You can add a new game by clicking "Manage games", there, you will see all the existing games always sorted by highest stock quantity. You can use the search filter with barcode to make it fast to find a game to edit or delete, and you can click "Insert new videogame" to add new videogames to the database.
          </p>
          <a href="#" class="btn btn-primary">Manage customers
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<hr />

<?php include("includes/footer.php"); ?>

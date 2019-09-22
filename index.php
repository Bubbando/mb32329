<?php
$active = 'Home';
include("includes/header.php");
?>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">MB32329 EMA
    </h1>
    <p class="lead text-muted mb-0">A stock management system for a store selling and trading videogames
    </p>
  </div>
</section>
<div class="container">
  <div class="row mb-2">
    <!-- Image -->
    <div class="col-12 col-lg-6">
      <div class="card bg-light mb-3">
        <div class="card-header bg-primary text-white text-uppercase">
          <i class="fa fa-align-justify">
          </i> Our location
        </div>
        <div class="card-body">
          <a href="" data-toggle="modal" data-target="#productModal">
            <img class="img-fluid" src="images/map.png" />
          </a>
        </div>
      </div>
    </div>
    <!-- Add to cart -->
    <div class="col-12 col-lg-6 add_to_cart_block">
      <div class="card bg-light mb-3">
        <div class="card-header bg-primary text-white text-uppercase">
          <i class="fa fa-align-justify"> About us </i> 
        </div>
        <div class="card-body">
          <h2>Contact details</h2>
          <p>Phone: +44123412234</p>
          <p>Email: email@shop.com</p>
          <p>Opening times: Monday to Saturday 9AM-5PM</p>
          <p>Sunday: Closed</p>
        </div>
      </div>
      <div class="card bg-light mb-3">
        <div class="card-header bg-primary text-white text-uppercase">
          <i class="fa fa-align-justify"> Information</i> 
        </div>
        <div class="card-body">
          <h2>Our trading system
          </h2>
          <p>Click on trade above and insert your games' barcode to see what you can trade your game for!
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include("includes/footer.php");
?>
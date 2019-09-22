<?php 
$active='Buy';
include("includes/header.php");
?>
<?php
// Adds a game to the cart if it's not already in the card as the same purchase type
// User must be logged in
if(isset($_GET['videogame_id'])){
if(isset($_SESSION['customer_id']))
{
	$customer_id = $_SESSION['customer_id'];
	$videogame_id = $_GET['videogame_id'];
	$purchase_type = 'buy';
	// retrieve the quantity from the form (each game has a quantity named form)
	$quantity = $_POST['quantity'];
	$check_product = "select * from cart where customer_id='$customer_id' AND videogame_id='$videogame_id' AND purchase_type='$purchase_type'";
	$run_check = mysqli_query($con,$check_product);
	if(mysqli_num_rows($run_check)>0){
	echo "<script>alert('This product is already in the cart')</script>";
	}
	else {
	$query = "insert into cart (videogame_id,customer_id,quantity,purchase_type) values ('$videogame_id','$customer_id','$quantity','$purchase_type')";
	$run_query = mysqli_query($con,$query);
	echo "<script>alert('Item added to cart')</script>";
	}
}
else
{ 
	echo "<script>alert('Not logged in')</script>"; }
}
?>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">BUY</h1>
    <p class="lead text-muted mb-0">Here you can buy games</p>
  </div>
</section>
<div class="container">
  <div class="row">
	<?php include("includes/filters.php"); ?>
    <div class="col">
      <div class="row">
        <?php	
// Set the page script and number of records per page
if (isset($_GET['pageno'])) {
$pageno = $_GET['pageno'];
} else {
$pageno = 1;
}
// Number of records, set to 15 as per requirements
$no_of_records_per_page = 6;
$offset = ($pageno-1) * $no_of_records_per_page;

//SQL with variables for pagination
$total_pages_sql = "SELECT COUNT(*) FROM videogame where is_listed='yes'";
// SQL For showing games
$sql = "SELECT * FROM videogame where is_listed='yes'";
// Add multiple filters at once
if(isset($_GET['filter']) & !empty($_GET['filter'])){
$id = $_GET['filter'];
$sql .= " AND platform_id=$id";
// Include filters in pages
$total_pages_sql .= " AND platform_id=$id";
}
if(isset($_GET['price']) & !empty($_GET['price'])){
$price = $_GET['price'];
$sql .= " AND used_price=$price";
// Include filters in pages
$total_pages_sql .= " AND used_price=$price";
}
// Calculate pages with all the filters
$result = mysqli_query($con,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
// Retrieve all games to show in each page
$sql .= " ORDER BY stock_quantity DESC LIMIT $offset, $no_of_records_per_page";
$run_products = mysqli_query($con, $sql);



// Iterate over games and their properties to list them
while($row_pro=mysqli_fetch_array($run_products)){
$videogame_id = $row_pro['videogame_id'];
$image = $row_pro['image'];
$title = $row_pro['title'];
$genre = $row_pro['genre'];
$platform_id = $row_pro['platform_id'];
$publisher = $row_pro['publisher'];
$developer = $row_pro['developer'];
$release_date = $row_pro['release_date'];
$retail_price_new = $row_pro['retail_price_new'];
$barcode = $row_pro['barcode'];
$used_price = $row_pro['used_price'];
$stock_quantity = $row_pro['stock_quantity'];
$is_listed = $row_pro['is_listed'];
$select_platforms = "select platform_name from platform WHERE platform_id='$platform_id'";
$run_platforms_sql = mysqli_query($con,$select_platforms);
$platform_row = mysqli_fetch_array($run_platforms_sql);
$platform_name = $platform_row['platform_name'];
?>
<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
<div class='card'>
<img class='card-img-top' style="height:300px" src='admin/game_images/<?php echo $image;?>' alt='Card image cap'>
<div style="height:440px" class='card-body'>
<div style="margin-bottom:2px; height:110px;" class='form-group'>
<form method='post' action='buy.php?videogame_id=<?php echo $videogame_id;?>'>
<h4 class='card-title'><a href='product.html' title='View Product'><?php echo $title;?></a></h4>
<input type='hidden' id='title' name='hidden_name' value='<?php echo $title;?>'>
<input type='hidden' id='used_price' name='hidden_price' value='<?php echo $used_price;?>'>
<p class='card-text'><strong>Genre:</strong><?php echo $genre;?></p>
<p class='card-text'><strong>Publisher:</strong><?php echo $publisher;?></p>
<p class='card-text'><strong>Developer:</strong><?php echo $developer;?></p>
</div>
<div style="margin-top:120px" class='form-group'>
<label  for='quantity'>Quantity:</label>
<select class='form-control' name='quantity' id='quantity'>
<?php	
$i = 1;
while ($i <= $stock_quantity)
{
echo "<option value='$i'>$i</option>";
$i++;
}	
?>
</select>
</div>			
<div class='row'>
<div class='col'>
<p class='btn btn-primary btn-block'>Price: £<?php echo $used_price;?></p>
<button type='submit' name='add_tocart' class='btn btn-success btn-block'>Add to cart</button>
</form>
</div></div>
</div></div></div>
<?php
}	
?>		

<?php include("includes/pagination.php"); ?>	
		
      </div>
    </div>
  </div>
</div>
<?php 
include("includes/footer.php");
?>

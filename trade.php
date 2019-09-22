<?php
$active = 'Trade';
include("includes/header.php");
?>
<section class="jumbotron text-center">
  <div class="container">
    <div class="container-fluid">
      <h1>Search for a game by Barcode
      </h1>
      <div class="row">
        <div class="col">
          <form class="card-body" action="trade.php" method="get" id="bootstrapForm">
            <div class="form-group">
              <input type="text" placeholder="Barcode" class="form-control" name="user_query" id="input3" required>
            </div>
            <div>
              <button type="submit"  class="btn btn-secondary">Evaluate your game!
              </button>
            </div>  
          </form>  
          <?php
if (isset($_GET['user_query']))
  {
    // if the barcode is set then select everything from the game with the same abrcode
    $user_keyword = $_GET['user_query']; //barcode
    $get_products = "select * from videogame where barcode='$user_keyword'";
    $run_products = mysqli_query($con, $get_products);
    $count        = mysqli_num_rows($run_products);
    // any results?
    if ($count == 0)
      {
        echo "<div class='box'><h2>No Search Results Found</h2></div>";
      }
    else
      {
        while ($row_pro = mysqli_fetch_array($run_products))
          {
            // If there are results, iterate 
            $videogame_id      = $row_pro['videogame_id'];
            $image             = $row_pro['image'];
            $title1            = $row_pro['title'];
            $genre             = $row_pro['genre'];
            $platform_id       = $row_pro['platform_id'];
            $publisher         = $row_pro['publisher'];
            $developer         = $row_pro['developer'];
            $used_price        = $row_pro['used_price'];
            $selling_price     = $used_price / 2;
            $select_platforms  = "select platform_name from platform WHERE platform_id='$platform_id'";
            $run_platforms_sql = mysqli_query($con, $select_platforms);
            $platform_row      = mysqli_fetch_array($run_platforms_sql);
            $platform_name     = $platform_row['platform_name'];
        ?>
    <div class='mx-auto col-12 col-md-6 col-lg-4 mb-3'>
    <div class='card'>
    <img class='card-img-top' src='admin/game_images/<?php echo $image;?>' alt='Card image cap'>
    <div class='card-body'>
    <form method='post' action='trade.php?sell_id=<?php echo $videogame_id;?>&user_query=<?php echo $user_keyword;?>'>
    <h4 class='card-title'><a href='product.html' title='View Product'><?php echo $title1;?>(<?php echo $platform_name;?>)</a></h4>
    <input type='hidden' id='title' name='hidden_name' value='<?php echo $title1;?>'>
    <input type='hidden' id='used_price' name='hidden_price' value='<?php echo $used_price;?>'>
    <p class='card-text'><strong>Genre: </strong><?php echo $genre;?></p>
    <p class='card-text'><strong>Publisher: </strong><?php echo $publisher;?></p>
    <p class='card-text'><strong>Developer: </strong><?php echo $developer;?></p>
    <div class='row'>
    <div class='col'>
    <button type='submit' name='add_tocart' class='btn btn-success btn-block'>Sell game for: £<?php echo $selling_price;?></button>
    </form>
   <?php }}} ?> 
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="row">
	<?php include("includes/filters.php"); ?>
    <div class="col">
      <div class="row">
        <?php
// User searches for game via barcode
// Barcode is used to check the value of the games price
// All the games with that price are returned
// Games can be filtered by price and/or platform
if (isset($_GET['user_query']))
  {
    $user_keyword = $_GET['user_query']; //barcode
    $sql1         = "SELECT used_price FROM videogame WHERE barcode='$user_keyword'";
    $search_price = mysqli_query($con, $sql1);
    $price_row    = mysqli_fetch_array($search_price);
    if (!empty($price_row))
      {
        $used_price = $price_row['used_price'];
        // Page script 
        if (isset($_GET['pageno']))
          {
            $pageno = $_GET['pageno'];
          }
        else
          {
            $pageno = 1;
          }
        $no_of_records_per_page = 6;
        $offset                 = ($pageno - 1) * $no_of_records_per_page;
        $total_pages_sql        = "SELECT COUNT(*) FROM videogame where is_listed='yes' AND used_price='$used_price' AND barcode !='$user_keyword'";
        $sql                    = "SELECT * FROM videogame WHERE used_price='$used_price' AND barcode !='$user_keyword'";
        //$sql = "SELECT * FROM videogame";
        if (isset($_GET['filter']) & !empty($_GET['filter']))
          {
            //echo "<script>alert('test DIO')</script>";
            $id = $_GET['filter'];
            $sql .= " AND platform_id='$id'";
            $total_pages_sql .= " AND platform_id='$id'";
          }
        $result      = mysqli_query($con, $total_pages_sql);
        $total_rows  = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        $sql .= " ORDER BY stock_quantity DESC LIMIT $offset, $no_of_records_per_page";
        $run_products = mysqli_query($con, $sql);
        while ($row_pro = mysqli_fetch_array($run_products))
          {
            // I ADDED
            $videogame_id      = $row_pro['videogame_id'];
            $image             = $row_pro['image'];
            $title             = $row_pro['title'];
            $genre             = $row_pro['genre'];
            $platform_id       = $row_pro['platform_id'];
            $publisher         = $row_pro['publisher'];
            $developer         = $row_pro['developer'];
            $retail_price_new  = $row_pro['retail_price_new'];
            $barcode           = $row_pro['barcode'];
            $used_price        = $row_pro['used_price'];
            $stock_quantity    = $row_pro['stock_quantity'];
            $is_listed         = $row_pro['is_listed'];
            $select_platforms  = "select platform_name from platform WHERE platform_id='$platform_id'";
            $run_platforms_sql = mysqli_query($con, $select_platforms);
            $platform_row      = mysqli_fetch_array($run_platforms_sql);
            $platform_name     = $platform_row['platform_name'];
            echo "
<div class='col-12 col-md-6 col-lg-4 mb-3'>
<div class='card'>
<img class='card-img-top' src='admin/game_images/$image' alt='Card image cap'>
<div class='card-body'>
";
            if (isset($_GET['filter']))
              {
                echo "
<form method='post' action='trade.php?videogame_id=$videogame_id&user_query=$user_keyword&filter=$id'>";
              }
            else
              {
                echo "<form method='post' action='trade.php?videogame_id=$videogame_id&user_query=$user_keyword'>";
              }
?>
<h4 class='card-title'><a href='product.html' title='View Product'><?php echo $title;?></a></h4>
<input type='hidden' id='title' name='hidden_name' value='<?php echo $title;?>'>
<input type='hidden' id='used_price' name='hidden_price' value='<?php echo $used_price;?>'>
<p class='card-text'><strong>Genre:</strong><?php echo $genre;?></p>
<p class='card-text'><strong>Publisher:</strong><?php echo $publisher;?></p>
<p class='card-text'><strong>Developer:</strong><?php echo $developer;?></p>
<div class='row'>
<div class='col'>
<p class='btn btn-primary btn-block'>£<?php echo $used_price;?></p>
<button type='submit' name='add_tocart' class='btn btn-success btn-block'>Trade for this game!</button>
</form>
</div></div></div></div></div>
 <?php }}} ?>        
<?php include("includes/pagination.php"); ?>	
      </div>
    </div>
  </div>
</div>
<?php
// THIS SCRIPT GETS CALLED WHEN "SELL GAME FOR £XX" IS PUSHED ON THE TOP OF THE TRADE.PHP PAGE!
if (isset($_GET['user_query']))
  {
    $user_keyword = $_GET['user_query']; //barcode
  }
if (isset($_GET['videogame_id']))
  {
    $customer_id  = $_SESSION['customer_id'];
    $user_keyword = $_GET['user_query'];
    $videogame_id = $_GET['videogame_id'];
    $get_products = "select * from videogame where videogame_id='$videogame_id'";
    $run_products = mysqli_query($con, $get_products);
    $row_pro      = mysqli_fetch_array($run_products);
    if (!empty($row_pro))
      {
        $platform_id       = $row_pro['platform_id'];
        $select_platforms  = "select platform_name from platform WHERE platform_id='$platform_id'";
        $run_platforms_sql = mysqli_query($con, $select_platforms);
        $platform_row      = mysqli_fetch_array($run_platforms_sql);
        $platform_name     = $platform_row['platform_name'];
        $title             = $row_pro['title'];
        $videogame_id      = $_GET['videogame_id'];
        $purchase_type     = 'Trade for: ' . $title1 . '';
        $check_product     = "select * from cart where customer_id='$customer_id' AND videogame_id='$videogame_id' AND purchase_type='$purchase_type'";
        $run_check         = mysqli_query($con, $check_product);
        if (mysqli_num_rows($run_check) > 0)
          {
            echo "<script>alert('This product is already in the cart')</script>";
            echo "<script>window.open('trade.php?user_query='$user_keyword'','_self')</script>";
          }
        else
          {
            $query     = "insert into cart (videogame_id,customer_id,quantity,purchase_type,trading_for) values ('$videogame_id','$customer_id','1','$purchase_type','$user_keyword')";
            $run_query = mysqli_query($con, $query);
            echo "<script>alert('Trade added into the cart successfully')</script>";
          }
      }
  }
?>
<?php
// THIS SCRIPT GETS CALLED WHEN "SELL GAME FOR £XX" IS PUSHED ON THE TOP OF THE TRADE.PHP PAGE!
if (isset($_GET['sell_id']))
  {
    $customer_id  = $_SESSION['customer_id'];
    $user_keyword = $_GET['user_query'];
    $videogame_id = $_GET['sell_id'];
    $get_products = "select * from videogame where videogame_id='$videogame_id'";
    $run_products = mysqli_query($con, $get_products);
    $row_pro      = mysqli_fetch_array($run_products);
    if (!empty($row_pro))
      {
        $platform_id       = $row_pro['platform_id'];
        $select_platforms  = "select platform_name from platform WHERE platform_id='$platform_id'";
        $run_platforms_sql = mysqli_query($con, $select_platforms);
        $platform_row      = mysqli_fetch_array($run_platforms_sql);
        $platform_name     = $platform_row['platform_name'];
        $title             = $row_pro['title'];
        $videogame_id      = $_GET['sell_id'];
        // Add the purchase sale type as Sale
        $purchase_type     = 'Sale';
        $check_product     = "select * from cart where customer_id='$customer_id' AND videogame_id='$videogame_id' AND purchase_type='$purchase_type'";
        $run_check         = mysqli_query($con, $check_product);
        if (mysqli_num_rows($run_check) > 0)
          {
            echo "<script>alert('This product is already in the cart')</script>";
            echo "<script>window.open('trade.php?user_query='$user_keyword'','_self')</script>";
          }
        else
          {
            $query     = "insert into cart (videogame_id,customer_id,quantity,purchase_type,trading_for) values ('$videogame_id','$customer_id','1','$purchase_type','$user_keyword')";
            $run_query = mysqli_query($con, $query);
            echo "<script>alert('Sale added into the cart successfully')</script>";
            echo "<script>window.open('trade.php','_self')</script>";
          }
      }
  }
?>
<?php
include("includes/footer.php");
?>
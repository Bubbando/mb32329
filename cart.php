<?php 
$active='Cart';
include("includes/header.php");
?>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">E-COMMERCE CART
    </h1>
  </div>
</section>
<div class="container mb-4">
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Videogame</th>
              <th scope="col">Transaction Type</th>
              <th scope="col" class="text-center">Quantity</th>
              <th scope="col" class="text-right">Price</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           <?php


$total       = 0;
$customer_id = $_SESSION['customer_id'];
$select_cart = "select * from cart where customer_id='$customer_id'";
$run_cart    = mysqli_query($con, $select_cart);
$count       = mysqli_num_rows($run_cart);

while ($row_cart = mysqli_fetch_array($run_cart)) {
    // first get each videogame id from the cart    
    $videogame_id  = $row_cart['videogame_id'];
    $quantity      = $row_cart['quantity'];
    $purchase_type = $row_cart['purchase_type'];
    $get_products  = "select * from videogame where videogame_id='$videogame_id'";
    $run_products  = mysqli_query($con, $get_products);
    // then get all the details from it
    while ($row_products = mysqli_fetch_array($run_products)) {
        $title             = $row_products['title'];
        $image             = $row_products['image'];
        $used_price        = $row_products['used_price'];
        $used_price_sale   = $used_price / 2;
        $sub_total         = $row_products['used_price'] * $quantity;
        $platform_id       = $row_products['platform_id'];
        $stock_quantity    = $row_products['stock_quantity'];
        $select_platforms  = "select platform_name from platform WHERE platform_id='$platform_id'";
        $run_platforms_sql = mysqli_query($con, $select_platforms);
        $platform_row      = mysqli_fetch_array($run_platforms_sql);
        $platform_name     = $platform_row['platform_name'];
        // Changes the total amount based on the type of transaction (sale, trade, buy)
        if ($purchase_type == 'Sale') {
            $total += 0;
        } else if ($purchase_type != 'buy') {
            $total += 5;
        } else {
            $total += $sub_total;
        }
        // finally, display every item + every detail
?>
            <p> 
            <form action="cart.php" method="post" enctype="multipart/form-data">
              <!-- form Begin -->
              <tr>
                <td><img width="60" height="60" src="admin/game_images/<?php echo $image; ?>" />
                </td>
                <td><?php echo $title; ?>
                  <input type='hidden' id='title' name='videogame_id' value='<?php echo $videogame_id; ?>'></td>
				<td><?php echo $purchase_type; ?></td>
                <td>
<?php
// show different options based on the purchase type
if ($purchase_type == 'buy'){
    echo "
<select class='form-control' name='quantity' id='quantity'>
<option selected value='$quantity'>$quantity</option>
";
    $i = 1;
    while ($i <= $stock_quantity){
        echo "<option  value='$i'>$i</option>";
        $i++;
      }
    echo "</select>";
  }
else {
    echo "<input type='hidden' id='title' name='quantity' value='1'>";
    echo "1";
  }
?>						
                </td>
                <?php 
if ($purchase_type == 'buy')
{
?>
                <td class="text-right">£<?php echo $used_price; ?></td>
                <?php } else if ($purchase_type =='Sale'){ ?>
                <td class="text-right"><?php echo "You receive £$used_price_sale"; ?></td>
                <?php } else { ?>
                <td class="text-right"><?php echo "£5 trading fee"; ?></td>
                <?php }  ?>
                <td class="text-right"><?php if ($purchase_type == 'buy') { ?>
                  <button type="submit" name="update" value="Update Cart" class="btn btn-sm btn-success">Update q.ty</button>
                  <?php } ?>
                </td>
            </form>
            <td>
              <a class="btn btn-sm btn-danger" href="cart.php?delete_id=<?php echo $videogame_id; ?>&purchase_type=<?php echo $purchase_type; ?>">Remove
              </a>
            </td>
          </tr>
        <?php 
} }?>
        </tbody>
      </table>
  </div>
</div>
<div class="col mb-2">
  <div class="row">
    <div class="col-sm-12  col-md-6">
    </div>
    <div class="col-sm-12 col-md-6 text-right">
      <form action="checkout.php" method="post">
        <input type='hidden' id='total' name='total' value='<?php echo $total; ?>'>
        <button type="submit" name="checkout" value="Complete order" class="btn btn-lg btn-block btn-success text-uppercase">Checkout for £
          <?php echo $total; ?>
        </button>
      </form>
      </form>
  </div>
</div>
</div>
</div>
</div>

<?php
// Script to remove items from cart 
if (isset($_GET['delete_id']))
  {
    $delete_id        = $_GET['delete_id'];
    $purchase_type    = $_GET['purchase_type'];
    $customer_id      = $_SESSION['customer_id'];
    $remove_videogame = "delete from cart where videogame_id='$delete_id' AND customer_id='$customer_id' AND purchase_type='$purchase_type'";
    $run_delete       = mysqli_query($con, $remove_videogame);
    if ($run_delete)
      {
        echo "<script>window.open('cart.php','_self')</script>";
      }
  }
if (isset($_POST['update']))
  {
    $update_id       = $_POST['videogame_id'];
    $customer_id     = $_SESSION['customer_id'];
    $quantity        = $_POST['quantity'];
    $update_quantity = "update cart set quantity='$quantity' where videogame_id='$update_id' and customer_id='$customer_id'";
    $run_delete      = mysqli_query($con, $update_quantity);
    if ($run_delete)
      {
        echo "<script>alert('Quantity updated successfully to ' + $quantity)</script>";
        echo "<script>window.open('cart.php','_self')</script>";
      }
  }
?>
<?php 
include("includes/footer.php");
?>

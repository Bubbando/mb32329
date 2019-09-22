<?php
$active = 'Checkout';
include("includes/header.php");
?>
<?php
// grab the total calculated from the cart
if (isset($_POST['total']))
  {
    $total = $_POST['total'];
  }
// check that the payment type is set
if (isset($_POST['payment']))
  {
    if (!isset($_SESSION['customer_id']) & empty($_SESSION['customer_id']))
      {
        header('location: login.php');
      }
    $customer_id    = $_SESSION['customer_id'];
    // Update customer details
    $fname          = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
    $lname          = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
    $address        = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $sql            = "SELECT * FROM customer WHERE customer_id='$customer_id'";
    $run_update_sql = mysqli_query($con, $sql);
    $count          = mysqli_num_rows($run_update_sql);
    if ($count == 1)
      {
        $usql = "UPDATE customer SET first_name='$fname', last_name='$lname', address='$address' WHERE customer_id=$customer_id";
        $ures = mysqli_query($con, $usql) or die(mysqli_error($con));
      }
    //
    // Calculate total money
    // end
    $status         = "";
    $invoice_number = mt_rand();
    $payment_type   = $_POST['payment'];
    //$total = $_POST['total'];
    $select_cart    = "select * from cart where customer_id='$customer_id'";
    $run_cart       = mysqli_query($con, $select_cart);
    // If there is a trade or a sale, the order is pending, otherwise automatically completed because the shop just needs to send the game
    while ($row_cart = mysqli_fetch_array($run_cart))
      {
        $purchase_type = $row_cart['purchase_type'];
        if ($purchase_type != 'buy')
          {
            $status = "pending";
            break;
          }
        else
          {
            $status = "completed";
          }
      }
    // Insert first the order in the order table
    $insert_customer_order = "insert into `order` (customer_id,total_price,order_status,order_date,invoice_number,payment_type) values ('$customer_id','$total','$status',CURDATE(),'$invoice_number', '$payment_type')";
    $run_customer_order    = mysqli_query($con, $insert_customer_order);
    $insert_order_id       = mysqli_insert_id($con);
    // then retrieve the ID that we just insert in the order table
    $select_cart           = "select * from cart where customer_id='$customer_id'";
    $run_cart              = mysqli_query($con, $select_cart);
    // and use it to iterate for every item, and insert it into the order details database, based on the purchase type
    // different queries will be run
    while ($row_cart = mysqli_fetch_array($run_cart))
      {
        $videogame_id      = $row_cart['videogame_id'];
        $quantity          = $row_cart['quantity'];
        $purchase_type     = $row_cart['purchase_type'];
        $get_products      = "select * from videogame where videogame_id='$videogame_id'";
        $run_products      = mysqli_query($con, $get_products);
        $row_products      = mysqli_fetch_array($run_products);
        $title             = $row_products['title'];
        $image             = $row_products['image'];
        $barcode           = $row_products['barcode'];
        $used_price        = $row_products['used_price'];
        $used_price_sale   = $used_price / 2;
        $sub_total         = $row_products['used_price'] * $quantity;
        $platform_id       = $row_products['platform_id'];
        $stock_quantity    = $row_products['stock_quantity'];
        $select_platforms  = "select platform_name from platform WHERE platform_id='$platform_id'";
        $run_platforms_sql = mysqli_query($con, $select_platforms);
        $platform_row      = mysqli_fetch_array($run_platforms_sql);
        $platform_name     = $platform_row['platform_name'];
        // Depending on the purchase type, we insert different prices in the table
        if ($purchase_type == 'Sale')
          {
            $money_received         = $used_price_sale;
            $insert_customer_order1 = "insert into order_detail (order_id,videogame_id,barcode,order_type,quantity,price_sold) values ('$insert_order_id','$videogame_id','$barcode','$purchase_type','$quantity','$used_price_sale')";
          }
        else if ($purchase_type != 'buy')
          {
            $insert_customer_order1 = "insert into order_detail (order_id,videogame_id,barcode,order_type,quantity,price_paid) values ('$insert_order_id','$videogame_id',,'$barcode','$purchase_type','$quantity','5')";
          }
        else
          {
            $insert_customer_order1 = "insert into order_detail (order_id,videogame_id,barcode,order_type,quantity,price_paid) values ('$insert_order_id','$videogame_id','$barcode','$purchase_type','$quantity','$used_price')";
          }
        $run_customer_order = mysqli_query($con, $insert_customer_order1);
        // Then we delete the products from the cart
        $delete_cart        = "delete from cart where customer_id='$customer_id'";
        $run_delete         = mysqli_query($con, $delete_cart);
        echo "<script>alert('Your order has been submitted, Thanks')</script>";
        echo "<script>window.open('orders.php','_self')</script>";
      }
  }
?>
<?php
$customer_id  = $_SESSION['customer_id'];
$get_customer = "select * from customer where customer_id='$customer_id'";
$run_customer = mysqli_query($con, $get_customer);
$row_customer = mysqli_fetch_array($run_customer);
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
          </i> Billing Details
        </div>
        <div class="card-body">
          <div class="billing-details">
            <form action="checkout.php" method="post">
              <div class="space30">
              </div>
              <div class="clearfix space20">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>First Name 
                  </label>
                  <input name="fname" class="form-control" placeholder="" value="<?php
if (!empty($row_customer['first_name']))
  {
    echo $row_customer['first_name'];
  }
elseif (isset($fname))
  {
    echo $fname;
  }
?>" type="text">
                </div>
                <div class="col-md-6">
                  <label>Last Name 
                  </label>
                  <input name="lname" class="form-control" placeholder="" value="<?php
if (!empty($row_customer['last_name']))
  {
    echo $row_customer['last_name'];
  }
elseif (isset($lname))
  {
    echo $lname;
  }
?>" type="text">
                </div>
              </div>
              <div class="clearfix space20">
              </div>
              <label>Address 
              </label>
              <input name="address" class="form-control" placeholder="Street address" value="<?php
if (!empty($row_customer['address']))
  {
    echo $row_customer['address'];
  }
elseif (isset($address1))
  {
    echo $address1;
  }
?>" type="text">
              <div class="clearfix space20">
              </div>                        
              </div>
          </div>
        </div>
      </div>
      <!-- Add to cart -->
      <div class="col-12 col-lg-6 add_to_cart_block">
        <div class="card bg-light mb-3">
          <div class="card-header bg-primary text-white text-uppercase">
            <i class="fa fa-align-justify">
            </i> About us
          </div>
          <div class="card-body">
            <div class="col-md">
              <input name="payment" id="radio1" class="css-checkbox" type="radio" value="Collect in store">
              <span> Collect in Store
              </span>
              <div class="space20">
              </div>
              <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.
              </p>
            </div>
            <div class="col-md">
              <input name="payment" id="radio3" class="css-checkbox" value="Online Payment" type="radio">
              <span value="card"> Card Payment
              </span>
              <div class="space20">
              </div>
              <p>Pay via PayPal; you can pay with your credit card if you don't have a PayPal account
              </p>
            </div>
          </div>
        </div>
        <div class="card bg-light mb-3">
          <div class="card-header bg-primary text-white text-uppercase">
            <i class="fa fa-align-justify">
            </i> Information
          </div>
          <div class="card-body">
            <div class="col-md">
              <div class="space20">
              </div>
              <input type='hidden' id='total' name='total' value='<?php
echo $total;
?>'>
              <button type="submit" name="pay" value="Complete order" class="btn btn-lg btn-block btn-success text-uppercase">Complete order (£<?php
echo $total;
?>)
              </button>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include("includes/footer.php");
?>
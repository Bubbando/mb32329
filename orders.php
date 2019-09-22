<?php $active='Orders';
include("includes/header.php"); ?>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">ORDERS</h1>
  </div>
</section>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Order Status</th>
              <th>Invoice Number</th>
              <th>Payment Type</th>
              <th>Date</th>
              <th>Total price</th>
              <th>View order details</th>
            </tr>
          </thead>
          <tbody>
           <?php
		   // Iterate over all the orders and display them
$customer_id = $_SESSION['customer_id'];
$get_orders  = "select * from `order` where customer_id='$customer_id'";
$run_orders  = mysqli_query($con, $get_orders);
while ($row_orders = mysqli_fetch_array($run_orders))
  {
    $order_id       = $row_orders['transaction_id'];
    $order_status   = $row_orders['order_status'];
    $invoice_number = $row_orders['invoice_number'];
    $payment_type   = $row_orders['payment_type'];
    $order_date     = $row_orders['order_date'];
    $total_price    = $row_orders['total_price'];
?>
            <tr>
              <td><?php echo $order_id; ?></td>
              <td><?php echo $order_status; ?></td>
              <td><?php echo $invoice_number; ?></td>
              <td><?php echo $payment_type; ?></td>
              <td><?php echo $order_date; ?></td>
              <td><?php echo $total_price; ?></td>
              <td><a href="view_order.php?order=<?php echo $order_id; ?>"><i>View order details</i></a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include("includes/footer.php"); ?>

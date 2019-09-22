<?php 
$active='Manage orders';
include("includes/header.php");
?>
<div class="container-fluid">
  <h1>Orders
  </h1>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <form action="manage_orders.php" class="form-horizontal" method="get">
        <div class="form-group ">
          <label class="control-label col-sm-2 requiredField" for="date">
            Date
            <span class="asteriskField">
              *
            </span>
          </label>
          <div class="col-sm-10">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar">
                </i>
              </div>
              <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-10 col-sm-offset-2">
            <button class="btn btn-primary " type="submit">
              Submit
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Order ID
              </th>
              <th>Order Status
              </th>
              <th>Invoice Number
              </th>
              <th>Payment Type
              </th>
              <th>Date
              </th>
              <th>Total price
              </th>
              <th>View order details
              </th>
              <th>Function 1
              </th>
              <th>Function 2
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
$get_orders = "select * from `order`";
if(isset($_GET['date'])){
$date = $_GET['date'];
$new_date = date("Y-m-d", strtotime($date));
$get_orders .= " where order_date >='$new_date' AND order_date<='$new_date'";
echo "Date selected: ". $new_date;
}
else
{
echo "Today's orders";
$get_orders .= " where order_date = CURDATE()";
}
$get_orders .= " order by order_date DESC " ;               
$run_orders = mysqli_query($con,$get_orders);
while($row_orders = mysqli_fetch_array($run_orders)){
$order_id = $row_orders['transaction_id'];
$order_status = $row_orders['order_status'];
$invoice_number = $row_orders['invoice_number'];
$payment_type = $row_orders['payment_type'];
$order_date = $row_orders['order_date'];
$total_price = $row_orders['total_price'];
?>
		<tr>
              <td><?php echo $order_id; ?></td>
              <td><?php echo $order_status; ?></td>
              <td><?php echo $invoice_number; ?></td>
              <td><?php echo $payment_type; ?></td>
              <td><?php echo $order_date; ?></td>
              <td><?php echo $total_price; ?></td>
              <td><a href="view_order_details.php?order=<?php echo $order_id; ?>"><i>View order details</i></a></td>
			  <?php
			  if($order_status == 'pending'){
			  echo "<td><a href='manage_orders.php?order=$order_id&mark_as=complete'><i>Mark as complete</i></a></td>"; }
			  else {
			  echo "<td><a href='manage_orders.php?order=$order_id&mark_as=pending'><i>Mark as pending</i></a></td> "; }
			  ?>		
              <td><a href="manage_orders.php?order=<?php echo $order_id; ?>&mark_as=cancelled"><i>Mark as cancelled</i></a></td>
        </tr>
<?php } ?>
          </tbody>
        </table>
      </div>
      <!--end of .table-responsive-->
    </div>
  </div>
</div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>
  $(document).ready(function(){
    var date_input=$('input[name="date"]');
    //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
      format: 'mm/dd/yyyy',
      container: container,
      todayHighlight: true,
      autoclose: true,
    }
                         )
  }
                   )
</script>
</body>
</html>
<?php
if(isset($_GET['mark_as'])){
$mark_as = $_GET['mark_as'];
$order_id = $_GET['order'];
$update_videogame = "update `order` set order_status='$mark_as' where transaction_id='$order_id'";
$run_delete = mysqli_query($con,$update_videogame);
if($run_delete){
echo "<script>alert('Order marked as $mark_as')</script>";
echo "<script>window.open('manage_orders.php','_self')</script>";
}
}
?>

<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</body>
</html>
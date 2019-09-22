<?php 
$active='Manage orders';
include("includes/header.php");
?>
<div class="container-fluid">
  <h1>Order detail
  </h1>
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Order ID
              </th>
              <th>Videogame Name
              </th>
              <th>Order Type
              </th>
              <th>Price paid
              </th>
              <th>Item sold for
              </th>
              <th>Quantity
              </th>
              <th>Barcode
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
if(isset($_GET['order'])){
$order = $_GET['order'];
$get_orders = "select * from order_detail where order_id='$order'";
$run_orders = mysqli_query($con,$get_orders);
while($row_orders = mysqli_fetch_array($run_orders)){
$order_id = $row_orders['order_id'];
$order_type = $row_orders['order_type'];
$videogame_id = $row_orders['videogame_id'];
$price_paid = $row_orders['price_paid'];
$price_sold = $row_orders['price_sold'];
$quantity = $row_orders['quantity'];
$get_videogame = "select * from videogame where videogame_id='$videogame_id'";
$run_videogame = mysqli_query($con,$get_videogame);
$row_videogame = mysqli_fetch_array($run_videogame);
$barcode = $row_videogame['barcode'];
$videogame_name = $row_videogame['title'];
?>
            <tr>
              <td> 
                <?php echo $order_id; ?> 
              </td>
              <td> 
                <?php echo $videogame_name; ?> 
              </td>
              <td> 
                <?php echo $order_type; ?> 
              </td>
              <td> 
                <?php echo $price_paid; ?> 
              </td>
              <td> 
                <?php echo $price_sold; ?> 
              </td>
              <td> 
                <?php echo $quantity; ?> 
              </td>
              <td> 
                <?php echo $barcode; ?> 
              </td>
            </tr>
            <?php }  }?>
          </tbody>
        </table>
      </div>
      <!--end of .table-responsive-->
    </div>
  </div>
</div>
</div>
<?php include("includes/footer.php"); ?>

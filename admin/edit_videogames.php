<?php 
$active='Manage games';
include("includes/header.php");
?>
<?php
if(isset($_GET['videogame_id'])){
$videogame_id= $_GET['videogame_id'];
$get_pro = "select * from videogame where videogame_id='$videogame_id'";
$run_edit = mysqli_query($con,$get_pro);
$row_edit = mysqli_fetch_array($run_edit);
$videogame_id = $row_edit['videogame_id'];
$image = $row_edit['image'];
$title = $row_edit['title'];
$genre = $row_edit['genre'];
$platform_id = $row_edit['platform_id'];
$publisher = $row_edit['publisher'];
$developer = $row_edit['developer'];
$release_date = $row_edit['release_date'];
$retail_price_new = $row_edit['retail_price_new'];
$barcode = $row_edit['barcode'];
$used_price = $row_edit['used_price'];
$stock_quantity = $row_edit['stock_quantity'];
$is_listed = $row_edit['is_listed'];
$select_order_items1 = "SELECT platform_name FROM platform WHERE platform_id = '$platform_id'" ;
$run_order_items = mysqli_query($con,$select_order_items1);
$row_pro=mysqli_fetch_array($run_order_items);
$platform_name = $row_pro['platform_name'];
}
?>
<?php
if(isset($_POST['update'])){
$title = mysqli_real_escape_string($con, $_POST['title']);
$genre = mysqli_real_escape_string($con, $_POST['genre']);
$publisher = mysqli_real_escape_string($con, $_POST['publisher']);
$developer = mysqli_real_escape_string($con, $_POST['developer']);
$release_date = mysqli_real_escape_string($con, $_POST['release_date']);
$retail_price_new = mysqli_real_escape_string($con, $_POST['retail_price_new']);
$used_price = mysqli_real_escape_string($con, $_POST['used_price']);
$barcode = mysqli_real_escape_string($con, $_POST['barcode']);
$stock = mysqli_real_escape_string($con, $_POST['stock']);
$platform = mysqli_real_escape_string($con, $_POST['platform']);
$is_listed = mysqli_real_escape_string($con, $_POST['is_listed']);
$status = "product";
$product_img1 = $_FILES['product_img1']['name'];
$temp_name1 = $_FILES['product_img1']['tmp_name'];
$allowed = array('jpeg','jpg','gif','png');
$product_img1_extension = pathinfo($product_img1, PATHINFO_EXTENSION);
if(empty($product_img1)){
$product_img1 = $image;
}else{
if(!in_array($product_img1_extension,$allowed)){
echo "<script> alert('Your Product Image 1 File Extension Is Not Supported.'); </script>";
$product_img1 = "";
}else{
move_uploaded_file($temp_name1,"game_images/$product_img1");
}
}
if((int)$stock < 1 && $is_listed == 'yes'){
$is_listed = 'no';
}
else
{
}
$update_product =  "update videogame set image='$product_img1', title='$title', genre='$genre', platform_id='$platform', publisher='$publisher', developer='$developer', release_date='$release_date', retail_price_new='$retail_price_new', barcode='$barcode', used_price='$used_price', stock_quantity='$stock', is_listed='$is_listed' WHERE videogame_id='$videogame_id'";
$run_product = mysqli_query($con,$update_product);
if($run_product && isset($_GET['user_query'])){
$user_query = $_GET['user_query'];
echo "<script> alert('Product has been updated successfully') </script>";
echo "<script>window.open('manage_games_search_results.php?user_query=$user_query&search=Search','_self')</script>";
}
else
{
echo "<script> alert('Product has been updated successfully') </script>";
echo "<script>window.open('manage_games.php?edit=complete','_self')</script>";
}
}
?>
<div class="container-fluid">
  <h1>Insert new Videogame
  </h1>
  <div class="row">
    <div class="col">
      <div class="card bg-light">
        <form class="card-body" action="" method="post" id="bootstrapForm" enctype="multipart/form-data">
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Title 
            </label>
            <input type="text" name="title" class="form-control" required value="<?php echo $title; ?>">
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Genre 
            </label>
            <input type="text" name="genre" class="form-control" value="<?php echo $genre; ?>">
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Publisher 
            </label>
            <input type="text" name="publisher" class="form-control" required value="<?php echo $publisher; ?>">
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Developer 
            </label>
            <input type="text" name="developer" class="form-control" value="<?php echo $developer; ?>">
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Release Date 
            </label>
            <input type="text" name="release_date" class="form-control" required value="<?php echo $release_date; ?>">
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Price new 
            </label>
            <input type="text" name="retail_price_new" class="form-control" required value="<?php echo $retail_price_new; ?>">
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Price used 
            </label>
            <input type="text" name="used_price" class="form-control" required value="<?php echo $used_price; ?>">
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Barcode 
            </label>
            <input type="text" name="barcode" class="form-control" required value="<?php echo $barcode; ?>">
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Stock quantity 
            </label>
            <input type="text" name="stock" class="form-control" required value="<?php echo $stock_quantity; ?>">
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > List the product for sale? (Q.ty > 0) 
            </label>
            <select class="form-control" name="is_listed">
              <!-- select manufacturer Starts -->
              <option selected value="<?php echo $is_listed; ?>"> 
                <?php echo $is_listed; ?> 
              </option>
              <option value="yes"> yes 
              </option>
              <option value="no"> no  
              </option>
            </select>
            <!-- select manufacturer Ends -->
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Select A Platform 
            </label>
            <select class="form-control" name="platform">
              <!-- select manufacturer Starts -->
              <option selected value="<?php echo $platform_id; ?>"> 
                <?php echo $platform_name; ?> 
              </option>
              <?php
$get_manufacturer = "select * from platform";
$run_manufacturer = mysqli_query($con,$get_manufacturer);
while($row_manufacturer= mysqli_fetch_array($run_manufacturer)){
$manufacturer_id = $row_manufacturer['platform_id'];
$manufacturer_title = $row_manufacturer['platform_name'];
echo "<option value='$manufacturer_id'>
$manufacturer_title
</option>";
}
?>
            </select>
            <!-- select manufacturer Ends -->
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Product Image 1 
            </label>
            <input type="file" name="product_img1" class="form-control">
            <br>
            <img src="game_images/<?php echo $image; ?>" width="70" height="70" >
          </div>
          <!-- form-group Ends -->
          <div>
            <button type="submit" name="update" class="btn btn-secondary">Send Form
            </button>
          </div>  
        </form>  
      </div>
    </div>
  </div>
</div>
<hr />
</div>


<?php 
$active='Manage games';
include("includes/header.php");
?>
<?php
if(isset($_POST['submit'])){
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
$status = "product";
$product_img1 = $_FILES['product_img1']['name'];
$temp_name1 = $_FILES['product_img1']['tmp_name'];
$allowed = array('jpeg','jpg','gif','png');
$product_img1_extension = pathinfo($product_img1, PATHINFO_EXTENSION);
if(!in_array($product_img1_extension,$allowed)){
echo "<script> alert('Your Product Image 1 File Extension Is Not Supported.'); </script>";
$product_img1 = "";
}else{
move_uploaded_file($temp_name1,"game_images/$product_img1");
}
$insert_product =  "insert into videogame (image, title, genre, platform_id, publisher, developer, release_date, retail_price_new, barcode, used_price, stock_quantity,is_listed) VALUES ('$product_img1', '$title', '$genre','$platform','$publisher','$developer','$release_date','$retail_price_new', '$barcode', '$used_price', '$stock', 'no') ";
$run_product = mysqli_query($con,$insert_product);
if($run_product){
echo "<script>alert('Product has been inserted successfully')</script>";
echo "<script>window.open('manage_games.php','_self')</script>";
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
            <input type="text" name="title" class="form-control" required >
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Genre 
            </label>
            <input type="text" name="genre" class="form-control" >
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Publisher 
            </label>
            <input type="text" name="publisher" class="form-control" required >
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Developer 
            </label>
            <input type="text" name="developer" class="form-control">
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Release Date 
            </label>
            <input type="text" name="release_date" class="form-control" required >
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Price new 
            </label>
            <input type="text" name="retail_price_new" class="form-control" required >
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Price used 
            </label>
            <input type="text" name="used_price" class="form-control" required >
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Barcode 
            </label>
            <input type="text" name="barcode" class="form-control" required >
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Stock quantity 
            </label>
            <input type="text" name="stock" class="form-control" required >
          </div>
          <!-- form-group Ends -->
          <div class="form-group" >
            <!-- form-group Starts -->
            <label class="control-label" > Select A Platform 
            </label>
            <select class="form-control" name="platform">
              <!-- select manufacturer Starts -->
              <option selected disabled> Platform 
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
            <input type="file"  name="product_img1" class="form-control" required >
          </div>
          <!-- form-group Ends -->
          <div>
            <button type="submit" name="submit" class="btn btn-secondary">Send Form
            </button>
          </div>  
        </form>  
      </div>
    </div>
  </div>
</div>
<hr />
</div>
<?php include("includes/footer.php"); ?>

<?php 
$active='Manage games';
include("includes/header.php");
?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <a class="btn btn-success btn-primary btn-lg btn-block" href="#" role="button">Insert new videogame
        </a>
      </div>
    </div>
  </div>
</div>
<hr />
<?php
if(isset($_POST['submit'])){
$platform_name = $_POST['platform_name'];
$insert_platform = "INSERT INTO platform (platform_name) VALUES ('$platform_name')";
$runsql = mysqli_query($con,$insert_platform);
if($runsql){
echo "<script>alert('New Product Category Has been Inserted')</script>";
echo "<script>window.open('platforms.php','_self')</script>";
}
}
?>
<div class="container-fluid">
  <h1>Search for a game by Barcode
  </h1>
  <div class="row">
    <div class="col">
      <div class="card bg-light">
        <form class="card-body" action="manage_games_search_results.php" method="get" id="bootstrapForm">
          <div class="form-group">
            <label class="h4 form-control-label" for="input3">Barcode
            </label>
            <input type="text" placeholder="Barcode" class="form-control" name="user_query" id="input3" required>
          </div>
          <div>
            <button type="submit" name="search" class="btn btn-secondary">Send Form
            </button>
          </div>  
        </form>  
      </div>
    </div>
  </div>
</div>
<hr />
<div class="container-fluid">
  <h1>Videogames found:
  </h1>
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID
              </th>
              <th>Title
              </th>
              <th>Image
              </th>
              <th>Genre
              </th>
              <th>Platform
              </th>
              <th>Publisher
              </th>
              <th>Developer
              </th>
              <th>Release date
              </th>
              <th>New price
              </th>
              <th>Barcode
              </th>
              <th>Used price
              </th>
              <th>Stock Quantity
              </th>
              <th>Is listed
              </th>
              <th>Function 1
              </th>
              <th>Function 2
              </th>
              <th>Function 3
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
if(isset($_GET['search'])){
$user_keyword = $_GET['user_query'];
$get_products = "select * from videogame where barcode like '%$user_keyword%'";
$run_products = mysqli_query($con,$get_products);
$count = mysqli_num_rows($run_products);
if($count==0){
echo "
<div class='box'>
<h2>No Search Results Found</h2>
</div>
";
}else{
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
echo "
<tbody>
<tr>
<td>  $videogame_id </td>
<td>  $title </td>
<td><img src='game_images/$image ' width='60' height='60'></td>
<td>$genre </td>
<td>
";
$select_order_items1 = "SELECT platform_name FROM platform WHERE platform_id = '$platform_id'" ;
$platform_name = '';
$run_order_items = mysqli_query($con,$select_order_items1);
while($row_pro=mysqli_fetch_array($run_order_items)){
$platform_name = $row_pro['platform_name'];
}
echo $platform_name;
echo "
</td>
<td>   $publisher  </td>
<td>  $developer </td>
<td>  $release_date </td>
<td>  $retail_price_new </td>
<td>  $barcode </td>
<td>  $used_price </td>
<td>  $stock_quantity </td>
<td>  $is_listed </td>
<td>
";
if($is_listed == "no" && (int)$stock_quantity > 0){
echo "
<a href='list_videogames.php?videogame_id=$videogame_id&user_query=$user_keyword '>
<i class='fa fa-trash-o'></i> List
</a>
</td>
<td>
<a href='edit_videogames.php?videogame_id=$videogame_id&user_query=$user_keyword'>
<i class='fa fa-pencil'> </i> Edit
</a>
</td>
<td>
<a href='delete_videogames.php?videogame_id=$videogame_id&user_query=$user_keyword'>
<i class='fa fa-trash-o'></i> Delete
</a>
</td>
";
}
else if($is_listed == "no" && (int)$stock_quantity == 0 ){
echo "
<p>
No stock
</p>
</td>
<td>
<a href='edit_videogames.php?videogame_id=$videogame_id&user_query=$user_keyword'>
<i class='fa fa-pencil'> </i> Edit
</a>
</td>
<td>
<a href='delete_videogames.php?videogame_id=$videogame_id&user_query=$user_keyword'>
<i class='fa fa-trash-o'></i> Delete
</a>
</td>
";
}
else{
echo "
<a href='unlist_videogames.php?videogame_id=$videogame_id&user_query=$user_keyword'>
<i class='fa fa-trash-o'></i> Unlist
</a>
</td>
<td>
<a href='edit_videogames.php?videogame_id=$videogame_id&user_query=$user_keyword '>
<i class='fa fa-pencil'> </i> Edit
</a>
</td>
<td>
<a href='delete_videogames.php?videogame_id=$videogame_id&user_query=$user_keyword'>
<i class='fa fa-trash-o'></i> Delete
</a>
</td>
</tr>
";
}
"
<td>
<a href='edit_videogames.php?videogame_id=$videogame_id'>
<i class='fa fa-pencil'> </i> Edit
</a>
</td>
</tbody>
</table><!-- table table-bordered table-hover table-striped Ends -->
</div><!-- table-responsive Ends -->
</div><!-- panel-body Ends -->
";
}
}
}
?>
          </tr>
        </tbody>
      </table>
  </div>
  <!--end of .table-responsive-->
</div>
</div>
</div>
</div>
<?php include("includes/footer.php"); ?>
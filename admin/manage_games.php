<?php 
$active='Manage games';
include("includes/header.php");
?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <a class="btn btn-success btn-primary btn-lg btn-block" href="insert_videogame.php" role="button">Insert new videogame
        </a>
      </div>
    </div>
  </div>
</div>
<hr />
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
            <button type="submit" name="search" class="btn btn-secondary">Search
            </button>
          </div>  
        </form>  
      </div>
    </div>
  </div>
</div>
<hr />
<div class="container-fluid">
  <h1>View All Existing Games (Use search above for easy matching)
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
              <th>Is Listed
              </th>
              <th>F1
              </th>
              <th>F2
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
if (isset($_GET['pageno'])) {
$pageno = $_GET['pageno'];
} else {
$pageno = 1;
}
$no_of_records_per_page = 1;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages_sql = "SELECT COUNT(*) FROM videogame";
$result = mysqli_query($con,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
$i = 0;
$get_pro = "select * from videogame ORDER BY stock_quantity DESC LIMIT $offset, $no_of_records_per_page";
//$get_pro = "select * from videogame where status='product'";
$i = 0;
//$get_pro = "select * from videogame ORDER BY stock_quantity DESC";
//$get_pro = "select * from videogame where status='product'";
$run_pro = mysqli_query($con,$get_pro);
while($row_pro=mysqli_fetch_array($run_pro)){
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
$i++;
?>
            <tr>
              <td>
                <?php echo $i; ?>
              </td>
              <td>
                <?php echo $title; ?>
              </td>
              <td>
                <img src="game_images/<?php echo $image; ?>" width="60" height="60">
              </td>
              <td>
                <?php echo $genre; ?>
              </td>
              <td>
                <?php
$select_order_items1 = "SELECT platform_name FROM platform WHERE platform_id = '$platform_id'" ;
$platform_name = "";
$run_order_items = mysqli_query($con,$select_order_items1);
while($row_pro=mysqli_fetch_array($run_order_items)){
$platform_name = $row_pro['platform_name'];
}
echo $platform_name;
?>
              </td>
              <td> 
                <?php echo $publisher; ?> 
              </td>
              <td>
                <?php echo $developer; ?>
              </td>
              <td>
                <?php echo $release_date; ?>
              </td>
              <td>
                <?php echo $retail_price_new; ?>
              </td>
              <td>
                <?php echo $barcode; ?>
              </td>
              <td>
                <?php echo $used_price; ?>
              </td>
              <td>
                <?php echo $stock_quantity; ?>
              </td>
              <td>
                <?php echo $is_listed; ?>
              </td>
              <td>
                <a href="delete_videogames.php?videogame_id=<?php echo $videogame_id; ?>">
                  <i class="fa fa-trash-o">
                  </i> Delete
                </a>
              </td>
              <td>
                <a href="edit_videogames.php?videogame_id=<?php echo $videogame_id; ?>">
                  <i class="fa fa-pencil"> 
                  </i> Edit
                </a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!--end of .table-responsive-->
    </div>
  </div>
</div>
<hr />
<ul class="pagination">
  <li class="page-item">
    <a class="page-link" href="?pageno=1">First
    </a>
  </li>
  <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
    <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev
    </a>
  </li>
  <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
    <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next
    </a>
  </li>
  <li class="page-item">
    <a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last
    </a>
  </li>
</ul>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
</body>
</html>

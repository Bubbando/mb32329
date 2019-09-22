<?php 
$active='Manage platforms';
include("includes/header.php");
?>
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
  <h1>Insert Platform
  </h1>
  <div class="row">
    <div class="col">
      <div class="card bg-light">
        <form class="card-body" action="" method="post" id="bootstrapForm">
          <div class="form-group">
            <label class="h4 form-control-label" for="input3">Platform Name
            </label>
            <input type="text" placeholder="Platform Name" class="form-control" name="platform_name" id="input3" required>
          </div>
          <div>
            <button type="submit" name="submit" class="btn btn-secondary">Insert platform
            </button>
          </div>  
        </form>  
      </div>
    </div>
  </div>
</div>
<hr />
<div class="container-fluid">
  <h1>Insert Platform
  </h1>
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Product Category Id
              </th>
              <th>Product Category Title
              </th>
              <th>Delete Product Category
              </th>
              <th>Edit Product Category
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
$i=0;
$get_platforms = "select * from platform";
$run_p_cats = mysqli_query($con,$get_platforms);
while($row_platforms = mysqli_fetch_array($run_p_cats)){
$platform_id = $row_platforms['platform_id'];
$platform_name = $row_platforms['platform_name'];
$i++;
?>
            <tr>
              <td> 
                <?php echo $i; ?> 
              </td>
              <td> 
                <?php echo $platform_name; ?> 
              </td>
              <td> 
                <a href="delete_platform.php?platform=<?php echo $platform_id; ?>">
                  <i>
                  </i> Delete
                </a>
              </td>
              <td> 
                <a href="edit_platform.php?platform=<?php echo $platform_id; ?>">
                  <i>
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
</div>
<?php include("includes/footer.php"); ?>

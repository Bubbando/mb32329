<?php 

    $active='Manage platforms';
    include("includes/header.php");

?>








<?php

if(isset($_GET['platform'])){

$edit_platforms = $_GET['platform'];

$edit_platforms_query = "select * from platform where platform_id='$edit_platforms'";

$run_edit = mysqli_query($con,$edit_platforms_query);

$row_edit = mysqli_fetch_array($run_edit);
$platform_id = $row_edit['platform_id'];
$platform_name = $row_edit['platform_name'];

}


?>
            <div class="container-fluid">
            <h1>Insert Platform</h1>
              <div class="row">
                <div class="col">
                        <div class="card bg-light">
                                <form class="card-body" action="" method="post" id="bootstrapForm">
                                                                                                     
                                    <div class="form-group">
                                        <label class="h4 form-control-label" for="input3">Platform Name</label>
										<input type="text" id="input3" name="platform_name" class="form-control" value="<?php echo $platform_name; ?>" >
                                    </div>

                                    <div>
                                        <button type="submit" name="update" class="btn btn-secondary">Send Form</button>
                                    </div>  
                                </form>  
                        </div>
                </div>
              </div>
            </div>

<hr />









        
    </div>

<?php

if(isset($_POST['update'])){

$platform_name = $_POST['platform_name'];

$update_platform = "UPDATE platform set platform_name = ('$platform_name') where platform_id='$platform_id'";

$runsql = mysqli_query($con,$update_platform);

if($runsql){

echo "<script>alert('New Product Category Has been Inserted')</script>";

echo "<script>window.open('platforms.php','_self')</script>";

}



}



?>
<?php include("includes/footer.php"); ?>
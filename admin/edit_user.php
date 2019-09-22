<?php 

    $active='Manage platforms';
    include("includes/header.php");

?>








<?php

if(isset($_GET['user_id'])){

$user_id = $_GET['user_id'];

$edit_platforms_query = "select * from customer where customer_id='$user_id'";

$run_edit = mysqli_query($con,$edit_platforms_query);

$row_edit = mysqli_fetch_array($run_edit);
$customer_id = $row_edit['customer_id'];
$first_name = $row_edit['first_name'];
$last_name = $row_edit['last_name'];
$address = $row_edit['address'];
$email_address = $row_edit['email_address'];

}


?>
            <div class="container-fluid">
            <h1>Insert Platform</h1>
              <div class="row">
                <div class="col">
                        <div class="card bg-light">
                                <form class="card-body" action="" method="post" id="bootstrapForm">
                                                                                                     
                                    <div class="form-group">
                                        <label class="h4 form-control-label" for="input1">First Name</label>
										<input type="text" id="input1" name="first_name" class="form-control" value="<?php echo $first_name; ?>" >
										  <label class="h4 form-control-label" for="input2">Last Name</label>
										<input type="text" id="input2" name="last_name" class="form-control" value="<?php echo $last_name; ?>" >
										  <label class="h4 form-control-label" for="input3">Address</label>
										<input type="text" id="input3" name="address" class="form-control" value="<?php echo $address; ?>" >
										  <label class="h4 form-control-label" for="input4">E-mail address</label>
										<input type="text" id="input4" name="email_address" class="form-control" value="<?php echo $email_address; ?>" >
										
										
                                    </div>

                                    <div>
                                        <button type="submit" name="update" class="btn btn-secondary">Update customer</button>
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

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$email_address = $_POST['email_address'];

$update_customer =  "update customer set first_name='$first_name', last_name='$last_name', address='$address', email_address='$email_address'";

$runsql = mysqli_query($con,$update_customer);

if($runsql){

echo "<script>alert('Updated')</script>";

echo "<script>window.open('manage_users.php','_self')</script>";

}



}



?>



<?php //} ?>
<?php include("includes/footer.php"); ?>
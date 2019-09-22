<?php 
$active='Manage users';
include("includes/header.php");
?>

<hr />

<div class="container-fluid">
  <h1>Users found:
  </h1>
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Customer ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Address</th>
              <th>E-mail Address</th>
              <th>F1</th>
              <th>F2</th>
            </tr>
          </thead>
          <tbody>
            <?php
if(isset($_GET['user_query'])){
$user_keyword = $_GET['user_query'];
$get_products = "select * from customer where email_address='$user_keyword'";
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
$customer_id = $row_pro['customer_id'];
$first_name = $row_pro['first_name'];
$last_name = $row_pro['last_name'];
$address = $row_pro['address'];
$email_address = $row_pro['email_address'];
echo "
<tbody>
<tr>
              <td>
                $customer_id
              </td>
              <td>
                $first_name
              </td>
              <td>
                 $last_name
              </td>
              <td>
                 $address
              </td>
              <td>
                 $email_address
              </td>

              <td>
                <a href='manage_users.php?user_id=$customer_id&delete_customer'>
                  <i>Delete</i> 
                </a>
              </td>
              <td>
                <a href='edit_user.php?user_id=$customer_id'>
                  <i>Edit</i> 
                </a>
              </td>
			  </tr>
";
}}}
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
<?php 
$active='Manage users';
include("includes/header.php");
?>
<hr />
<div class="container-fluid">
  <h1>Search for an user by their e-mail address
  </h1>
  <div class="row">
    <div class="col">
      <div class="card bg-light">
        <form class="card-body" action="manage_users_search_results.php" method="get" id="bootstrapForm">
          <div class="form-group">
            <label class="h4 form-control-label" for="input3">E-mail
            </label>
            <input type="text" placeholder="E-mail" class="form-control" name="user_query" id="input3" required>
          </div>
          <div>
            <button type="submit" class="btn btn-secondary">Search
            </button>
          </div>  
        </form>  
      </div>
    </div>
  </div>
</div>
<hr />
<div class="container-fluid">
  <h1>View All users
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
if (isset($_GET['pageno'])) {
$pageno = $_GET['pageno'];
} else {
$pageno = 1;
}
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages_sql = "SELECT COUNT(*) FROM customer";
$result = mysqli_query($con,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
$get_pro = "select * from customer LIMIT $offset, $no_of_records_per_page";
$run_pro = mysqli_query($con,$get_pro);
while($row_pro=mysqli_fetch_array($run_pro)){
$customer_id = $row_pro['customer_id'];
$first_name = $row_pro['first_name'];
$last_name = $row_pro['last_name'];
$address = $row_pro['address'];
$email_address = $row_pro['email_address'];

?>
            <tr>
              <td>
                <?php echo $customer_id; ?>
              </td>
              <td>
                <?php echo $first_name; ?>
              </td>
              <td>
                <?php echo $last_name; ?>
              </td>
              <td>
                <?php echo $address; ?>
              </td>
              <td>
                <?php echo $email_address; ?>
              </td>

              <td>
                <a href="manage_users.php?user_id=<?php echo $customer_id; ?>&delete_customer">
                  <i class="fa fa-trash-o">
                  </i> Delete
                </a>
              </td>
              <td>
                <a href="edit_user.php?user_id=<?php echo $customer_id; ?>">
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
<?php
if(isset($_GET['delete_customer'])){
$customer_id = $_GET['user_id'];
$delete_platforms = "delete from customer where customer_id='$customer_id'";
$run_delete = mysqli_query($con,$delete_platforms);
if($run_delete){
echo "<script>alert('Customer deleted')</script>";
echo "<script>window.open('manage_users.php','_self')</script>";
}
}
?>
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

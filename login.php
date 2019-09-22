<?php
$active = 'Login';
include("includes/header.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
  {
    echo "<script>alert('You are already logged in')</script>";
    echo "<script>window.open('buy.php','_self')</script>";
    exit;
  }
?>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">LOGIN</h1>
  </div>
</section>
<div class="container">
  <div class="row">
        <div class="col mb-2">
          <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
              <form class="form-horizontal" method="post" action="login.php">
                <div class="form-group">
                  <label for="email_address" class="cols-sm-2 control-label">E-mail address</label>
                  <div class="cols-sm-10">
                    <div class="input-group">
                      <input type="text" class="form-control" name="email_address" id="email_address" placeholder="Enter your E-mail address" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="cols-sm-2 control-label">Password
                  </label>
                  <div class="cols-sm-10">
                    <div class="input-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="text" name="login" class="btn btn-primary btn-lg btn-block login-button">Login
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
  </div>
</div>
<?php
include("includes/footer.php");
?>
<?php
// If e-mail and password are correct, run the SQL query, set session variables and login
if (isset($_POST['login']))
  {
    $customer_email        = mysqli_real_escape_string($con, $_POST['email_address']);
    $customer_pass         = mysqli_real_escape_string($con, $_POST['password']);
    $select_customer       = "select * from customer where email_address='$customer_email'";
    $run_customer_query    = mysqli_query($con, $select_customer);
    $check_customer_exists = mysqli_num_rows($run_customer_query);
    $customer_row          = mysqli_fetch_assoc($run_customer_query);
    $customer_id           = $customer_row['customer_id'];
    $hash_password         = $customer_row['hashed_password'];
    $decrypt_password      = password_verify($customer_pass, $hash_password);
    if ($decrypt_password == 0)
      {
        echo "<script>alert('Your password or email is wrong')</script>";
        exit();
      }
    else if ($check_customer_exists == 1)
      {
        $_SESSION["loggedin"]       = true;
        $_SESSION['customer_email'] = $customer_email;
        $_SESSION['customer_id']    = $customer_id;
        echo "<script>alert('You are logged in')</script>";
        echo "<script>window.open('buy.php','_self')</script>";
      }
  }
?>
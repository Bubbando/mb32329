<?php
$active = 'Register';
include("includes/header.php");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
  {
    echo "<script>alert('You are already logged in')</script>";
    echo "<script>window.open('index.php','_self')</script>";
    exit;
  }
?>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">REGISTER</h1>
 </div>
</section>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col mb-2">
                    <div class="card">
                            <div class="card-header">Register</div>
                            <div class="card-body">
                                <form class="form-horizontal" method="post" action="">
                                    <div class="form-group">
                                        <label for="first_name" class="cols-sm-2 control-label">First Name</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter your First Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="cols-sm-2 control-label">Last Name</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter your Last Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="cols-sm-2 control-label">Address</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter your Address" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email_address" class="cols-sm-2 control-label">E-mail address</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="email_address" id="email_address" placeholder="Enter your E-mail address" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Password</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <button type="register" name="register" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                                    </div>
                                </form>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include("includes/footer.php");
?>
<?php
// Register the user, then log the user in and redirect to buy.php
if (isset($_POST['register']))
  {
    $first_name      = mysqli_real_escape_string($con, $_POST['first_name']);
    $last_name       = mysqli_real_escape_string($con, $_POST['last_name']);
    $address         = mysqli_real_escape_string($con, $_POST['address']);
    $email_address   = mysqli_real_escape_string($con, $_POST['email_address']);
    $password        = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if (!filter_var($email_address, FILTER_VALIDATE_EMAIL))
      {
        echo "<script> alert('Your Email is not a valid email address.'); </script>";
        exit();
      }
    $get_email   = "select * from customer where email_address='$email_address'";
    $run_email   = mysqli_query($con, $get_email);
    $check_email = mysqli_num_rows($run_email);
    if ($check_email == 1)
      {
        echo "<script>alert('This email is already registered, try another one')</script>";
        exit();
      }
    $insert_customer = "insert into customer (first_name,last_name,address,email_address,hashed_password) values ('$first_name','$last_name','$address','$email_address','$hashed_password')";
    $run_customer    = mysqli_query($con, $insert_customer);
    if ($run_customer)
      {
        // Automatic log-in
        $_SESSION["loggedin"]       = true;
        $_SESSION['customer_email'] = $customer_email;
        $_SESSION['customer_id']    = $customer_id;
        echo "<script>alert('Registered and logged in successfully!')</script>";
        echo "<script>window.open('buy.php','_self')</script>";
      }
  }
?>
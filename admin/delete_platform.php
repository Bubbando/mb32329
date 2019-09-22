// 
<?php
include("includes/db.php");
// if(!isset($_SESSION['admin_email'])){
// echo "<script>window.open('login.php','_self')</script>";
// }
// else {
?>
<?php
if(isset($_GET['platform'])){
$delete_platform_id = $_GET['platform'];
$delete_platforms = "delete from platform where platform_id='$delete_platform_id'";
$run_delete = mysqli_query($con,$delete_platforms);
if($run_delete){
echo "<script>alert('One Product Category Has been Deleted')</script>";
echo "<script>window.open('platforms.php','_self')</script>";
}
}
?>
<?php //} ?>

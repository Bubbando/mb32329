// 
<?php
include("includes/db.php");
// if(!isset($_SESSION['admin_email'])){
// echo "<script>window.open('login.php','_self')</script>";
// }
// else {
?>
<?php
if(isset($_GET['videogame_id'])){
$delete_videogame_id = $_GET['videogame_id'];
$delete_videogame = "delete from videogame where videogame_id='$delete_videogame_id'";
$run_delete = mysqli_query($con,$delete_videogame);
if($run_delete){
echo "<script>alert('One Product Category Has been Deleted')</script>";
echo "<script>window.open('manage_games.php','_self')</script>";
}
}
?>

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
$user_query = $_GET['user_query'];
$delete_videogame_id = $_GET['videogame_id'];
$update_videogame = "update videogame set is_listed='no' where videogame_id='$delete_videogame_id'";
$run_delete = mysqli_query($con,$update_videogame);
if($run_delete && isset($_GET['unlist'])){
echo "<script>alert('ISSET UNLIST')</script>";
echo "<script>window.open('manage_listed_games.php','_self')</script>";
}
else if ($run_delete)
{
echo "<script>alert('2nd')</script>";
echo "<script>window.open('manage_games_search_results.php?user_query=$user_query&search=Search','_self')</script>";
}
}
?>

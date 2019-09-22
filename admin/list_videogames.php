<?php
include("includes/db.php");
if(isset($_GET['videogame_id'])){
$user_query = $_GET['user_query'];
$delete_videogame_id = $_GET['videogame_id'];
$update_videogame = "update videogame set is_listed='yes' where videogame_id='$delete_videogame_id'";
$run_delete = mysqli_query($con,$update_videogame);
if($run_delete){
echo "<script>alert('Videogame has been listed and is available for purchase')</script>";
echo "<script>window.open('manage_games_search_results.php?user_query=$user_query&search=Search','_self')</script>";
}
}
?>

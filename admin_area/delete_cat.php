<?php
session_start();
if(!isset($_SESSION['user_email']))
{
	echo "<script>window.open('login.php?not_admin=You are not admin!','_self')</script>";
}
else
{
	
?>
<?php
include("includes/db.php");
if(isset($_GET['delete_cat']))
{
$delete_id=$_GET['delete_cat'];
$delete_cat="delete from categories where cat_id='$delete_id'";
$run_delete=mysql_query($delete_cat);
if($run_delete)
{
	echo "<script>alert('A category has been deleted!')</script>";
	echo "<script>window.open('index.php?view_cats','_self')</script>";
}
}


?>
<?php } ?>
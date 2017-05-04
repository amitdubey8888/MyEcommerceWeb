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
if(isset($_GET['delete_pro']))
{
$delete_id=$_GET['delete_pro'];
$delete_pro="delete from product where product_id='$delete_id'";
$run_delete=mysql_query($delete_pro);
if($run_delete)
{
	echo "<script>alert('A product has been deleted!')</script>";
	echo "<script>window.open('index.php?view_products','_self')</script>";
}
}


?>
<?php } ?>
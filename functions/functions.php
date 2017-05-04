<?php
include("includes/db.php");
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySql:".mysqli_connect_error();
}

function getIp(){
	
	//getting the user ip address
	
	$ip=$_SERVER['REMOTE_ADDR'];
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	return $ip;
}

//getting the user cart

function cart(){
if(isset($_GET['add_cart'])){

$ip=getIp();
$pro_id=$_GET['add_cart'];
$check_pro="select * from cart where ip_add='$ip' AND p_id='$pro_id'";
$run_check=mysql_query($check_pro);
if(mysql_num_rows($run_check)>0)
{
	echo "";
}
else{
	$insert_pro="insert into cart (p_id,ip_add) values ('$pro_id','$ip')";
    $run_pro=mysql_query($insert_pro);
	echo "<script>window.open('index.php','_self')</script>";
	}

}
}

//getting the cart items

function total_items(){
	
	$count_items=0;
	if(isset($_GET['add_cart']))
	{
		$ip=getIp();
		$get_items="select * from cart where ip_add='$ip'";
		$run_items=mysql_query($get_items);
		$count_items=mysql_num_rows($run_items);
	}
	else{
		$ip=getIp();
		$get_items="select * from cart where ip_add='$ip'";
		$run_items=mysql_query($get_items);
		$count_items=mysql_num_rows($run_items);
	}
	echo $count_items;
}

//getting the total price of the item in the cart


function total_price()
{
	$total=0;
	$ip=getIp();
	$sel_price="select * from cart where ip_add='$ip'";
	$run_price=mysql_query($sel_price);
	while($p_price=mysql_fetch_array($run_price))
	{
		$pro_id=$p_price['p_id'];
		$pro_price="select * from product where product_id='$pro_id'";
		$run_pro_price=mysql_query($pro_price);
		while($pp_price=mysql_fetch_array($run_pro_price))
		{
			$product_price=array($pp_price['product_price']);
			$values=array_sum($product_price);
			$total +=$values;
		}
	}
  echo "$".$total;
}

//getting the categories

function getCats()
{
$get_cats="SELECT * FROM categories";
$run_cats=mysql_query($get_cats);	
while($row_cats=mysql_fetch_array($run_cats))
{
	$cat_id=$row_cats['cat_id'];
	$cat_title=$row_cats['cat_title'];
	echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
}

}

//getting the brands

function getBrands()
{
$get_brands="SELECT * FROM brands";
$run_brands=mysql_query($get_brands);	
while($row_brands=mysql_fetch_array($run_brands))
{
	$brand_id=$row_brands['brand_id'];
	$brand_title=$row_brands['brand_title'];
	echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
}

}

//getting the all product

function getPro(){

if(!isset($_GET['cat'])){
	if(!isset($_GET['brand'])){
	
$get_pro="select * from product order by rand() limit 0,8";

$run_pro=mysql_query($get_pro);

while($row_pro=mysql_fetch_array($run_pro))
{
	$pro_id=$row_pro['product_id'];
	$pro_cat=$row_pro['product_cat'];
	$pro_brand=$row_pro['product_brand'];
	$pro_title=$row_pro['product_title'];
	$pro_price=$row_pro['product_price'];
	$pro_image=$row_pro['product_image'];
	echo "
	     <div id='single_product'>
	        <h3>$pro_title</h3>
			   <img src='admin_area/product_images/$pro_image' width='180' height='180'/>
			   <p style='color:red;'><b>Price: $$pro_price</b></p>
			   <a href='details.php?pro_id=$pro_id' style='float:left; color:darkorchid;'>Details</a>
			   <a href='index.php?pro_id=$pro_id'><button style='float:right; color:white; background:darkgoldenrod;;'>Add to Cart</button></a>
	     </div>
	     ";
}	
}
}
}

//getting the products by category

function getCatPro(){
if(isset($_GET['cat'])){	
$cat_id=$_GET['cat'];
$get_cat_pro="select * from product where product_cat='$cat_id'";
$run_cat_pro=mysql_query($get_cat_pro);
$count_cats=mysql_num_rows($run_cat_pro);
	if($count_cats==0)
	{
		echo "<h2 style='padding:20px; color:cornflowerblue;'>There is no product in this category!</h2>";
		exit();
	}
while($row_cat_pro=mysql_fetch_array($run_cat_pro))
{
	$pro_id=$row_cat_pro['product_id'];
	$pro_cat=$row_cat_pro['product_cat'];
	$pro_brand=$row_cat_pro['product_brand'];
	$pro_title=$row_cat_pro['product_title'];
	$pro_price=$row_cat_pro['product_price'];
	$pro_image=$row_cat_pro['product_image'];	
	echo "
	     <div id='single_product'>
	        <h3>$pro_title</h3>
			   <img src='admin_area/product_images/$pro_image' width='180' height='180'/>
			   <p style='color:red;'><b>Price: $$pro_price</b></p>
			   <a href='details.php?pro_id=$pro_id' style='float:left; color:darkorchid;'>Details</a>
			   <a href='index.php?pro_id=$pro_id'><button style='float:right; color:white; background:darkgoldenrod;;'>Add to Cart</button></a>
	     </div>
	     ";	
   }	
  }
}

//getting the products by brands

function getBrandPro(){
if(isset($_GET['brand'])){	
$brand_id=$_GET['brand'];
$get_brand_pro="select * from product where product_brand='$brand_id'";
$run_brand_pro=mysql_query($get_brand_pro);
$count_brands=mysql_num_rows($run_brand_pro);
	if($count_brands==0)
	{
		echo "<h2 style='padding:20px; color:cornflowerblue;'>There is no product associated with this brand!</h2>";
	}
while($row_brand_pro=mysql_fetch_array($run_brand_pro))
{
	$pro_id=$row_brand_pro['product_id'];
	$pro_cat=$row_brand_pro['product_cat'];
	$pro_brand=$row_brand_pro['product_brand'];
	$pro_title=$row_brand_pro['product_title'];
	$pro_price=$row_brand_pro['product_price'];
	$pro_image=$row_brand_pro['product_image'];	
	echo "
	     <div id='single_product'>
	        <h3>$pro_title</h3>
			   <img src='admin_area/product_images/$pro_image' width='180' height='180'/>
			   <p style='color:red;'><b>Price: $$pro_price</b></p>
			   <a href='details.php?pro_id=$pro_id' style='float:left; color:darkorchid;'>Details</a>
			   <a href='index.php?pro_id=$pro_id'><button style='float:right; color:white; background:darkgoldenrod;;'>Add to Cart</button></a>
	     </div>
	     ";	
   }	
  }
}
?>
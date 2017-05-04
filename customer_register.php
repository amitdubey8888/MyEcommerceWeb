<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
?>
<!DOCTYPE html>
<html>
   <head>
    <title>My Online Shop</title>
	<link rel="stylesheet" href="styles/style.css  " media="all">
   </head>
<body>
<!--Main Container starts here-->
<div class="main_wrapper">
     
	 <!--Header starts here-->
     <div class="header_wrapper">
	    <a href="index.php"><img id="logo" src="images/2.jpg"/></a>
        <img id="banner" src="images/1.jpg"/>	     	
	</div>
	<!--Header ends here-->
	<!--Navbar starts here-->
		<div class="menubar">
		   <ul id="menu">
		       <li><a href="index.php">Home</a></li>
			   <li><a href="all_products.php">All Product</a></li>
			   <li><a href="customer/my_account.php">My Account</a></li>
			   <li><a href="#">Sign Up</a></li>
			   <li><a href="cart.php">Shopping Cart</a></li>
			   <li><a href="#">Contact Us</a></li>
		   </ul>
		   <div id="form">
		       <form method="get" action="results.php" enctype="multipart/form-data">
			    <input type="text" name="user_query" placeholder="Search a Product"/>
				<input type="submit" name="search" value="Search"/>
		   
		       </form>
		   </div>
		</div>
	 <!--Navbar ends here-->
	 <!--Content wrapper starts here-->
	 <div class="content_wrapper">
	      <div id="sidebar">
		    <div id="sidebar_title">Categories</div>
		    <ul id="cats">
			<?php getCats(); ?> 
			</ul>
		  <div id="sidebar_title">Brands</div>
		    <ul id="brands">
			  <?php getBrands(); ?>
			</ul>
		  </div>
	      <div id="content_area">
		      <?php cart(); ?>
		      <div id="shopping_cart">
		        <span style="float:right; font-size:18px; padding:5px; line-height:40px;">
				
				Welcome Guest! <b style="color:yellow"> Shopping Cart - </b> Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?> <a href="cart.php" style="color:yellow">  Go to Cart</a>
				
				</span>
			  </div>
      <form action="customer_register.php" method="POST" enctype="multipart/form-data">
	    <table align="center" width="750" style='color:red'>
		   <tr align="center">
		       <td colspan="5" style='color:crimson'><h2>Create an Account</h2></td>
		   </tr>
		   <tr>
		       <td align="right">Customer Name:</td>
			   <td><input type="text" name="c_name" required/></td>
		   </tr>
		   <tr>
		       <td align="right">Customer Email:</td>
			   <td><input type="text" name="c_email" required/></td>
		   </tr>
		   <tr>
		       <td align="right">Customer Password:</td>
			   <td><input type="password" name="c_pass" required/></td>
		   </tr>
		    <tr>
		       <td align="right">Customer Image:</td>
			   <td><input type="file" name="c_image" required/></td>
		   </tr>
		   <tr>
		       <td align="right">Customer Country:</td>
			   <td>
		            <select name="c_country" style='color:crimson;'>	
                       <option>Select a Country</option>
                       <option>India</option>
                       <option>America</option>
                       <option>Japan</option>
                       <option>France</option>
                       <option>England</option>
                       <option>Pakistan</option>		
                       <option>Afganistan</option>
                       <option>Nepal</option>
                       <option>Bhutan</option> 
                       <option>Russia</option>
                       <option>Bangladesh</option>
                       <option>Jarmany</option>
                       <option>Austrailiya</option>					   
			        </select>
			   </td>
		   </tr>
		   <tr>
		       <td align="right">Customer City:</td>
			   <td><input type="text" name="c_city" required/></td>
		   </tr>
		   <tr>
		       <td align="right">Customer Contact:</td>
			   <td><input type="text" name="c_contact" required/></td>
		   </tr>
		   <tr>
		       <td align="right">Customer Address:</td>
			   <td><input type="text" name="c_address"required/></td>
		   </tr>
		    <tr align="center">
		       
			   <td colspan="5"><input type="submit" name="register" style='background:green; color:white;' value="Create Account"/></td>
		   </tr>
		</table>    
      </form>              
		    
		  </div>
	 </div>
	 <!--Content wrapper ends here-->
	 <div id="footer">
	 <h2 style="text-align:center; padding-top:30px;">&copy; 2016 by www.Onlinewebsolutions.com</h2>
	 <h4 style="text-align:center;">Powered By Amit Dubey</h4>
	 </div>
</div>
<!--Main Container ends here-->
</body>
</html>

<?php 
if(isset($_POST['register'])){
$ip=getIp();	
$c_name=$_POST['c_name'];	
$c_email=$_POST['c_email'];
$c_pass=$_POST['c_pass'];
$c_image=$_FILES['c_image']['name'];
$c_image_tmp=$_FILES['c_image']['tmp_name'];
$c_country=$_POST['c_country'];
$c_city=$_POST['c_city'];
$c_contact=$_POST['c_contact'];
$c_address=$_POST['c_address'];

move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
$quer= "INSERT INTO `customers`(`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_image`, ` customer_country`, `customer_city`, `customer_contact`, `customer_address`) VALUES ('','$ip','$c_name','$c_email','$c_pass','$c_image','$c_country','$c_city','$c_contact','$c_address')";

$run_query=mysql_query($quer) or die('query error');
	
	$sel_cart="select * from cart where ip_add='$ip'";
	$run_cart=mysql_query($sel_cart);
	$check_cart=mysql_num_rows($run_cart);
	if($check_cart==0)
	{
	    $_SESSION['customer_email']=$c_email;
		echo "<script>alert('Account has been created successfully, Thanks!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
	}
	else
	{
		
	    $_SESSION['customer_email']=$c_email;
		echo "<script>alert('Account has been created successfully, Thanks!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
	}
}

?>

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
				
             <?php
				if(isset($_SESSION['customer_email']))
				{
					echo "<b>Welcome:</b>".$_SESSION['customer_email']."<b style='color:yellow'>Your</b>";
				}
				else{
					echo "<b>Welcome Guest!</b>";
				}
				?>			
			<b style="color:yellow"> Shopping Cart - </b> Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?> <a href="cart.php" style="color:yellow">  Go to Cart</a>
				
				</span>
			  </div>
             <div id="product_box">		  
		       <?php
                    if(!isset($_SESSION['customer_email'])){
						include("customer_login.php");	
					}	
                     else
					 {
						 include("payment.php");
					 }						 
			   ?>
		     </div>
		  </div>
	 </div>
	 <!--Content wrapper ends here-->
	 <div id="footer">
	 <h2 style="text-align:center; padding-top:30px;">&copy; 2016 by <a style="color:skyblue;" href="http://amitdubey.net23.net" target="_self">www.amitdubey.net23.net</a></h2>
	 <h4 style="text-align:center;">Designed & Developed By <a style="color:skyblue;" href="http://linkedin.com/in/amitdubey1993" target="_blank">Amit Dubey</a></h4>
	 </div>
</div>
<!--Main Container ends here-->
</body>
</html>
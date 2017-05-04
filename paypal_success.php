
<html>
      <head>
	        <title>Payment Successfull</title>
	  </head>
<body>
<?php
session_start();
?>
<?php

include("includes/db.php");
include("functions/functions.php");
//this is about the product detail
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
			$product_id=$pp_price['product_id'];
			$values=array_sum($product_price);
			$total +=$values;
		}
	}
	
	//getting quantity of the products
	
	
	$get_qty="select * from cart where p_id='$pro_id'";
	$run_qty=mysql_query($get_qty);
	$row_qty=mysql_fetch_array($run_qty);
	$qty=$row_qty['qty'];
	
	if($qty==0)
	{
		$qty=1;
	}
	else{
		$qty=$qty;
		$total=$total*$qty;
	}
	
	//this is about the customer detail
            $user=$_SESSION['customer_email'];
			$get_c="select * from customers where customer_email='$user'";
			$run_c=mysql_query($get_c);
			$row_c=mysql_fetch_array($run_c);
			$c_id=$row_c['customer_id'];
			
	//this is about payment detail from paypal
	$amount=$_GET['amt'];
	$currency=$_GET['cc'];
	$trx_id=$_GET['tx'];
	
	//inserting the payment to table
	
	$insert_payments="insert into payments (amount,customer_id,product_id,trx_id,currency,payment_date) values ('$amount','$c_id','$pro_id','$trx_id','$currency',NOW())";
	$run_payments=mysql_query($insert_payments);
	
	//inserting the order to table
	
	$insert_order="insert into orders (p_id,c_id,qty,order_date) values ('$pro_id','$c_id','$qty',NOW())";
	$run_order=mysql_query($insert_order);
	
	//removing the product from cart
	
	$empty_cart="delete from cart";
	$run_cart=mysql_query($empty_cart);
	
	if($amount==$total)
	{
		echo "<h2>Welcome:".$_SESSION['customer_email']."<br>"."Your payment was successful!</h2>";
		echo "<a href='http:/www.onlinewebsolutions.com/myshop/customer/my_account.php'>Go to your account</a>";
	}
	else
	{
		echo "<h2>Welcome Guest, payment was failed!</h2><br>";
		echo "<a href='http:/www.onlinewebsolutions.com/myshop'>Go back to shop</a>";
	}
	
	
?>
</body>
</html>

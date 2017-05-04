<div>
<?php
    include("includes/db.php");
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
			$product_name=$pp_price['product_title'];
			$values=array_sum($product_price);
			$total +=$values;
		}
	}
	
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
?>
<h2 align="center">Pay Now With PayPal</h2>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <input type="hidden" name="business" value="businesstest@shop.com">
  <!-- Saved buttons use the "secure click" command -->
  <input type="hidden" name="cmd" value="_s-xclick">

  <input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
  <input type="hidden" name="item_number" value="<?php echo $pro_id; ?>">
   <input type="hidden" name="amount" value="<?php echo $total; ?>">
    <input type="hidden" name="quantity" value="<?php echo $qty; ?>">
  <input type="hidden" name="currency_code" value="INR">
  
  <input type="hidden" name="return" value="http://www.onlinewebsolutions.com/myshop/paypal_success.php"/>
  <input type="hidden" name="cancel_return" value="http://www.onlinewebsolutions.com/myshop/paypal_cancel.php"/>
  <!-- Saved buttons are identified by their button IDs -->
  <input type="hidden" name="hosted_button_id" value="221">

  <!-- Saved buttons display an appropriate button image. -->
  <input type="image" name="submit"
    src="paypal_button.png"
    alt="PayPal - The safer, easier way to pay online">
  <img alt="" width="1" height="1"
    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>
</div>
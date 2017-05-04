<!DOCTYPE html>
<?php
include("includes/db.php");
?>
<html>
<head>
  <title>Inserting Product</title>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="skyblue">
<form action="insert_product.php" method="post" enctype="multipart/form-data">
  <table align="center" width="795" border="2" bgcolor="orange">
   <tr align="center">   
     <td colspan="6"><h2>Insert New Post Here</h2></td>
   </tr>
   <tr>
     <td align="right"><b>Product Title:</b></td>
	 <td><input type="text" name="product_title" size="60" required/></td>
   </tr>
   <tr>
     <td align="right"><b>Product Category:</b></td>
	 <td>
	     <select name="product_cat" required>
	         <option>Select a Category</option>
			 <?php
			 $get_cats="SELECT * FROM categories";
             $run_cats=mysql_query($get_cats);	
             while($row_cats=mysql_fetch_array($run_cats))
             {
	         $cat_id=$row_cats['cat_id'];
	         $cat_title=$row_cats['cat_title'];
	         echo "<option value='$cat_id'>$cat_title</option>";
             }
			 ?>
	     </select>
	 </td>
   </tr>
   <tr>
     <td align="right"><b>Product Brand:</b></td>
	 <td>
	 <select name="product_brand" required>
	 <option>Select a Brand</option>
	 <?php
	   $get_brands="SELECT * FROM brands";
       $run_brands=mysql_query($get_brands);	
       while($row_brands=mysql_fetch_array($run_brands))
       {
	   $brand_id=$row_brands['brand_id'];
	   $brand_title=$row_brands['brand_title'];
	   echo "<option value='$brand_id'>$brand_title</option>";
       }
	   
	 ?>
	 </select>
	 </td>
   </tr>
   <tr>
     <td align="right"><b>Product Image:</b></td>
	 <td><input type="file" name="product_image" required/></td>
   </tr>
   <tr>
     <td align="right"><b>Product price:</b></td>
	 <td><input type="text" name="product_price" required/></td>
   </tr>
   <tr>
     <td align="right"><b>Product Discription:</b></td>
	 <td><textarea name="product_desc" cols="20" rows="10"></textarea></td>
   </tr>
   <tr>
     <td align="right"><b>Product Keywords:</b></td>
	 <td><input type="text" name="product_keywords" size="50" required/></td>
   </tr>
   <tr align="center">
	 <td colspan="6"><input type="submit" name="insert_post" value="Insert Now"/></td>
   </tr>
  </table>
</form>
</body>
</html>

<?php
include("includes/db.php");
if(isset($_POST['insert_post']))
{
	$product_title=$_POST['product_title'];
	$product_cat=$_POST['product_cat'];
	$product_brand=$_POST['product_brand'];
	$product_price=$_POST['product_price'];
	$product_desc=$_POST['product_desc'];
	$product_keywords=$_POST['product_keywords'];
	$product_image=$_FILES['product_image']['name'];
	$product_image_tmp=$_FILES['product_image']['tmp_name'];
	
	move_uploaded_file($product_image_tmp,"product_images/$product_image");
	
    $insert_product="insert into product (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) values ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";

	$run_query=mysql_query($insert_product);
	
	if($run_query)
	{
		echo "<script>alert('Product has been submitted!')</script>";
		echo "<script>window.open('index.php?view_products','_self')</script>";
	}	
}
?>
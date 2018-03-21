<?php
	require("DAO/productDAO.php");
	if(isset($_POST["bakerSubmit"]))
	{

		if($arrayResult["productSubmit"]==true)
		{
			$tempProduct=new Product($_POST["bakerId"],$_POST["price"],$_POST["product"]);
			//var_dump($tempUser);
			$tempDAO=new productDAO();
			$productCreated=$tempDAO->createProduct($tempProduct);
			if($productCreated==true)
			{
				echo "Product created";
			}
			else
			{
				echo "couldn't create a Product, please try again later";
			}
		}
		else
		{
			echo "Product isnt submitted, please try again";
		}//else if the reCAPTCHA was a failure(for the user)
	}//if data was submitted successfully from the form
?>

<body>
	<form method="post" id="createProductForm">
		<h3>Price</h3>
		<input type="text" name="price">
		<h3>Product Description</h3>
		<input type="text" name="product">
		<input type="hidden" value="<?php echo $_SESSION["userId"];?>" name="bakerId"></input>

		<input type="submit" value="Create Product" name="productSubmit">

	</form><!--end createProductForm-->
</body>
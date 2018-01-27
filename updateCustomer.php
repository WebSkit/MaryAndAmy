<?php
	require("userDAOClasses/customerDAO.php");
	if(isset($_POST["customerSubmit"]))
	{
		$tempUser=new newCustomer($_POST["customerName"],$_POST["password"],$_POST["surname"],$_POST["email"],$_POST["addressLine1"],$_POST["addressLine2"],$_POST["postcode"],$_POST["country"]);
		//var_dump($tempUser);
		$tempDAO=new customerDAO();
		$accountCreated=$tempDAO->createCustomer($tempUser);
		if($accountCreated==true)
		{
			echo "account created";
		}
		else
		{
			echo "something went wrong, please try again later";
		}
	}//if data was submitted successfully from the form
?>

<body>
	<form method="post" id="createCustomerForm">
		<h3>First Name</h3>
		<input type="text" name="customerName">
		<h3>Surname</h3>
		<input type="text" name="surname">
		<h3>Password</h3>
		<input type="password" name="password">
		<h3>Email</h3>
		<input type="text" name="email">
		<h3>address Line 1</h3>
		<input type="text" name="addressLine1">
		<h3>address Line 2</h3>
		<input type="text" name="addressLine2">
		<h3>Post Code</h3>
		<input type="text" name="postcode">
		<h3>County</h3>
		<input type="text" name="country">

		<input type="submit" value="Create Account" name="customerSubmit">
		
	</form><!--end createCustomerForm-->
</body>





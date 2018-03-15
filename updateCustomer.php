<?php
	require("userDAOClasses/customerDAO.php");
	if(isset($_POST["customerSubmit"]))
	{
		$tempCustomer=new Customer($_POST["firstName"],$_POST["password"],$_POST["surname"],$_POST["email"],$_POST["addressLine1"],$_POST["addressLine2"],$_POST["county"],$_POST["postcode"]);
		//var_dump($temp_user);
		$tempDao=new customerDAO();
		$accountCreated=$tempDao->createCustomer($tempCustomer);
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
	<form method="post" id="updateCustomerForm">
		<h3>First Name</h3>
		<input type="text" name="firstName">
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
		<h3>County</h3>
		<input type="text" name="county">
		<h3>Post Code</h3>
		<input type="text" name="postcode">
		<br><br>
		<input type="submit" value="Create Account" name="customerSubmit">

	</form><!--end update_customer_form-->
</body>

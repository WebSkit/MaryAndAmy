<?php
	require("userDAOClasses/customerDAO.php");
	if(isset($_POST["customer_submit"]))
	{
		$temp_user=new Customer($_POST["customer_name"],$_POST["password"],$_POST["surname"],$_POST["email"],$_POST["address_line1"],$_POST["address_line2"],$_POST["postcode"],$_POST["county"]);
		//var_dump($temp_user);
		$temp_dao=new customerDAO();
		$account_created=$temp_dao->createCustomer($temp_user);
		if($account_created==true)
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
	<form method="post" id="update_customer_form">
		<h3>First Name</h3>
		<input type="text" name="customer_name">
		<h3>Surname</h3>
		<input type="text" name="surname">
		<h3>Password</h3>
		<input type="password" name="password">
		<h3>Email</h3>
		<input type="text" name="email">
		<h3>address Line 1</h3>
		<input type="text" name="address_line1">
		<h3>address Line 2</h3>
		<input type="text" name="address_line2">
		<h3>County</h3>
		<input type="text" name="county">
		<h3>Post Code</h3>
		<input type="text" name="postcode">

		<input type="submit" value="Create Account" name="customer_submit">

	</form><!--end update_customer_form-->
</body>

<?php
	include("../userDAOClasses/customerDAO.php");
	
	//for deleting a customer
	if(isset($_POST["CDSubmit"]))
	{
		$tempDAO=new CustomerDAO();
		$accountDeleted=$tempDAO->deleteCustomer($_POST["customerId"]);
		if($accountDeleted==true)
		{
			echo "customer account is deleted";
		}
		else
		{
			echo "something went wrong, please try again later";
		}	
	}//if data was submitted successfully from the form
	?>

	<h2>Delete a Customer</h2>
	<form method="post" id="deleteCustomerForm">
		<h3>Comstumer ID</h3>
		<input type="text" name="customerId">
		<input type="submit" value="Delete Customer" name="CDSubmit">
	</form><!--end deleteCustomerForm-->
	</body>
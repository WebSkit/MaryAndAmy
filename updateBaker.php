<?php
	require("userDAOClasses/bakerDAO.php");

	if(isset($_POST["baker_submit"]))
	{

		$temp_baker=new Baker($_POST["company_name"],$_POST["password"],$_POST["email"],$_POST["address_line1"],$_POST["address_line2"],$_POST["postcode"],$_POST["county"],5,true);
		//var_dump($tempUser);
		$temp_dao=new bakerDAO();
		$account_created=$temp_dao->updateBaker($temp_baker);
		if($account_created==true)
		{
			echo "account has been updated";
		}
		else
		{
			echo "something went wrong, please try again later";
		}
	}//if data was submitted successfully from the form

?>

<body>
	<form method="post" id="update_baker_form">
		<h3>Company Name</h3>
		<input type="text" name="company_name">
		<h3>Password</h3>
		<input type="password" name="password">
		<h3>Email</h3>
		<input type="text" name="email">
		<h3>address Line 1</h3>
		<input type="text" name="address_line1">
		<h3>address Line 2</h3>
		<input type="text" name="address_line2">
		<h3>County</h3><!--feel free to remove country if it is irrelevant-->
		<input type="text" name="county">
		<h3>Post Code</h3>
		<input type="text" name="postcode">
		<p id="reCAPTCHAWarning">Please note that for the purposes of reCAPTCHA, data on hardware,software and your IP address will be collected and sent to Google
		by creating an account, you agree to allow them to do this</p>
		<div class="g-recaptcha" data-sitekey="<?php echo $siteKey ?>"></div>

		<input type="submit" value="Create Account" name="baker_submit">

	</form><!--end createCustomerForm-->
</body>

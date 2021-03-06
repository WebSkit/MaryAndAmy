<?php
	require("userDAOClasses/bakerDAO.php");

	if(isset($_POST["bakerSubmit"]))
	{

		$tempBaker=new Baker($_POST["companyName"],$_POST["password"],$_POST["email"],$_POST["addressLine1"],$_POST["addressLine2"],$_POST["county"],$_POST["postcode"],5,true);
		//var_dump($tempUser);
		$tempDao=new bakerDAO();
		$accountCreated=$tempDao->updateBaker($tempBaker);
		if($accountCreated==true)
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
	<form method="post" id="updateBakerForm">
		<h3>Company Name</h3>
		<input type="text" name="companyName">
		<h3>Password</h3>
		<input type="password" name="password">
		<h3>Email</h3>
		<input type="text" name="email">
		<h3>address Line 1</h3>
		<input type="text" name="addressLine1">
		<h3>address Line 2</h3>
		<input type="text" name="addressLine2">
		<h3>County</h3><!--feel free to remove country if it is irrelevant-->
		<input type="text" name="county">
		<h3>Post Code</h3>
		<input type="text" name="postcode">
		<p id="reCAPTCHAWarning">Please note that for the purposes of reCAPTCHA, data on hardware,software and your IP address will be collected and sent to Google
		by creating an account, you agree to allow them to do this</p>
		<div class="g-recaptcha" data-SITE_KEY="<?php echo $SITE_KEY ?>"></div>

		<input type="submit" value="Create Account" name="bakerSubmit">

	</form><!--end createCustomerForm-->
</body>

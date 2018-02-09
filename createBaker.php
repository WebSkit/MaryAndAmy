<?php
	require("userDAOClasses/bakerDAO.php");
	require("secretKey.php");
	if(isset($_POST["bakerSubmit"]))
	{
		$secretKey=$SECRET;//the reCAPTCHA secret key
		$response=$_POST["g-recaptcha-response"];//required reCAPTCHA response(aka sends the user data to google)
		$ip=$_SERVER['REMOTE_ADDR'];
		$url=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$response."&remoteip=".$ip);//the data is sent to this google page
		//file_get_contents, in this case, sends a request to google and gets the JSON response back in the form of a string
		$arrayResult=json_decode($url,true);//a JSON object was returned, converts to an array
		//param2=true means that it is returning an associative array
		if($arrayResult["success"]==true)
		{
			$tempBaker=new Baker($_POST["companyName"],$_POST["password"],$_POST["addressLine1"],$_POST["addressLine2"],$_POST["county"],$_POST["postCode"],5,false,$_POST["servedArea"],null,null,$_POST["phoneNumber"],null,null,$_POST["adminName"],$_POST["adminEmail"],$_POST["contactName"],$_POST["contactEmail"],null);
			//nulls exists either as they don't need to be
			//var_dump($tempUser);
			$tempDAO=new bakerDAO();
			$accountCreated=$tempDAO->createBaker($tempBaker);
			if($accountCreated==true)
			{
				echo "account created";
			}
			else
			{
				echo "something went wrong, please try again later";
			}
		}//if the reCAPTCHA was a success(for the user)
		else
		{
			echo "An error occured, please try again";
		}//else if the reCAPTCHA was a failure(for the user)






	}//if data was submitted successfully from the form

?>
<head>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="js/address_autocomplete.js"></script>

</head>

<body>
	<form method="post" id="createBakerForm">
		<h3>Company Name</h3>
		<input type="text" name="companyName">

		<h3>Password</h3>
		<input type="password" name="password">
		<h3>Admin Email</h3>
		<input type="text" name="adminEmail">
		<h3>Admin Name</h3>
		<input type="text" name="adminName">
		<h3>Contact Email</h3>
		<input type="text" name="contactEmail">
		<h3>Contact Name</h3>
		<input type="text" name="contactName">
		<h3>address Line 1</h3>
		<input type="text" name="addressLine1">
		<h3>address Line 2</h3>
		<input type="text" name="addressLine2">
		<h3>Post Code</h3>
		<input type="text" name="postCode">
		<h3>County</h3><!--feel free to remove country if it is irrelevant-->
		<input type="text" name="county">
		<h3>Served Area(in miles)</h3>
		<input type="text" name="servedArea">
		<h3>Phone Number</h3>
		<input type="text" name="phoneNumber">

		<p id="reCAPTCHAWarning">Please note that for the purposes of reCAPTCHA, data on hardware,software and your IP address will be collected and sent to Google
		by creating an account, you agree to allow them to do this</p>
		<div class="g-recaptcha" data-sitekey="<?php echo $SITE_KEY ?>"></div>

		<input type="submit" value="Create Account" name="bakerSubmit">

	</form><!--end createCustomerForm-->
</body>

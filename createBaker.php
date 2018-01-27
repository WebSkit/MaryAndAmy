<?php
	require("userDAOClasses/bakerDAO.php");
	require("secretKey.php");
	if(isset($_POST["customer_submit"]))
	{
		$secret_key=$secret;//the reCAPTCHA secret key
		$response=$_POST["g-recaptcha-response"];//required reCAPTCHA response(aka sends the user data to google)
		$ip=$_SERVER['REMOTE_ADDR'];
		//file_get_contents, in this case, sends a request to google and gets the JSON response back in the form of a string
		$url=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$response."&remoteip=".$ip);//the data is sent to this google page
		$array_result=json_decode($url,true);//a JSON object was returned, converts to an array
		//param2=true means that it is returning an associative array
		if($array_result["success"]==true)
		{
			$temp_baker=new Baker($_POST["company_name"],$_POST["password"],$_POST["email"],$_POST["address_line1"],$_POST["address_line2"],$_POST["postcode"],$_POST["county"],5,false,$_POST["served_area"]);
			//var_dump($tempUser);
			$temp_dao=new bakerDAO();
			$account_created=$temp_dao->createBaker($temp_baker);
			if($account_created==true)
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
</head>

<body>
	<form method="post" id="createBakerForm">
		<h3>Company Name</h3>
		<input type="text" name="company_name" required>

		<h3>Password</h3>
		<input type="password" name="password" required>
		<h3>Email</h3>
		<input type="text" name="email" required>
		<h3>address Line 1</h3>
		<input type="text" name="address_line1" required>
		<h3>address Line 2</h3>
		<input type="text" name="address_line2">
		<h3>County</h3><!--feel free to remove country if it is irrelevant-->
		<input type="text" name="county">
		<h3>Post Code</h3>
		<input type="text" name="postcode" required>
		<h3>Served Area(in miles)</h3>
		<input type="text" name="served_area">
		<p id="reCAPTCHAWarning">Please note that for the purposes of reCAPTCHA, data on hardware,software and your IP address will be collected and sent to Google
		by creating an account, you agree to allow them to do this</p>
		<div class="g-recaptcha" data-sitekey="<?php echo $siteKey ?>"></div>

		<input type="submit" value="Create Account" name="customer_submit">

	</form><!--end createCustomerForm-->
</body>

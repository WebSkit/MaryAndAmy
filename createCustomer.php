<?php
	require("userDAOClasses/customerDAO.php");
	require("secretKey.php");
	if(isset($_POST["customerSubmit"]))
	{
		$secretKey=$secret;//the reCAPTCHA secret key
		$response=$_POST["g-recaptcha-response"];//required reCAPTCHA response(aka sends the user data to google)
		$ip=$_SERVER['REMOTE_ADDR'];
		$url=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$response."&remoteip=".$ip);//the data is sent to this google page
		//file_get_contents, in this case, sends a request to google and gets the JSON response back in the form of a string
		$arrayResult=json_decode($url,true);//a JSON object was returned, converts to an array
		//param2=true means that it is returning an associative array
		if($arrayResult["success"]==true)
		{
			$tempUser=new newCustomer($_POST["customerName"],$_POST["password"],$_POST["surname"],$_POST["email"],$_POST["addressLine1"],$_POST["addressLine2"],$_POST["postCode"],$_POST["country"]);
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
		<input type="text" name="postCode">
		<h3>Country</h3><!--feel free to remove country if it is irrelevant-->
		<input type="text" name="country">
		<p id="reCAPTCHAWarning">Please note that for the purposes of reCAPTCHA, data on hardware,software and your IP address will be collected and sent to Google
		by creating an account, you agree to allow them to do this</p>
		<div class="g-recaptcha" data-sitekey="<?php echo $siteKey ?>"></div>

		<input type="submit" value="Create Account" name="customerSubmit">
		
	</form><!--end createCustomerForm-->
</body>

<!--Developer notes:
1.Never change the name of the "name" attributes within the input tags
2.keep the types as they are when they are "password" types
3.Do not change the location of any file in the directory, this file is reliant on others
4.In relation to the "reCAPTCHAWarning" tag, feel free to change it or place it as a pop up on this page, however it must exist and be easily visible
-->





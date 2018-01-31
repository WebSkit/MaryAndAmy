<?php
	require("userDAOClasses/bakerDAO.php");
	require("secretKey.php");
	if(isset($_POST["bakerSubmit"]))
	{
		$secretKey=$SECRET;//the reCAPTCHA secret key
		$response=$_POST["g-recaptcha-response"];//required reCAPTCHA response(aka sends the user data to google)
		$ip=$_SERVER['REMOTE_ADDR'];
		//file_get_contents, in this case, sends a request to google and gets the JSON response back in the form of a string
		$url=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$response."&remoteip=".$ip);//the data is sent to this google page
		$arrayResult=json_decode($url,true);//a JSON object was returned, converts to an array
		//param2=true means that it is returning an associative array
		if($arrayResult["success"]==true)
		{
			$tempBaker=new Baker($_POST["companyName"],$_POST["password"],$_POST["email"],$_POST["addressLine1"],$_POST["addressLine2"],$_POST["county"],$_POST["postcode"],5,false,$_POST["servedArea"]);
			//var_dump($tempUser);
			$tempDao=new bakerDAO();
			$accountCreated=$tempDao->createBaker($tempBaker);
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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC378_jfZXOZmOIHg9qBtRcN3fC3rXWgOk&libraries=places&callback=initAutocomplete"
	  async defer></script>
</head>

<body>
	<form method="post" id="newBakerForm">
		<h3>Company Name</h3>
		<input type="text" name="companyName" required>
		<h3>Email</h3>
		<input type="text" name="email" required>
		<h3>Password</h3>
		<input type="password" name="password" required>
		<br><br>
		<div id="locationField">
	    	<input id="autocomplete" placeholder="Enter your address"
				onFocus="geolocate()" type="text"></input>
	    </div>
		<h3>address Line 1</h3>
		<input type="text" name="addressLine1" id="route" required>
		<h3>address Line 2</h3>
		<input type="text" name="addressLine2" id="postal_town">
		<h3>County</h3><!--feel free to remove country if it is irrelevant-->
		<input type="text" name="county" id="administrative_area_level_2">
		<h3>Postcode</h3>
		<input type="text" name="postcode" id="postal_code" required>
		<h3>Served Area(in miles)</h3>
		<input type="text" name="servedArea">
		<p id="reCAPTCHAWarning">Please note that for the purposes of reCAPTCHA, data on hardware,software and your IP address will be collected and sent to Google
		by creating an account, you agree to allow them to do this</p>
		<div class="g-recaptcha" data-sitekey="<?php echo $SITE_KEY ?>"></div>

		<input type="submit" value="Create Account" name="bakerSubmit">

	</form><!--end createCustomerForm-->
</body>

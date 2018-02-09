<?php
	require("userDAOClasses/customerDAO.php");
	require("secretKey.php");
	require("userClasses/validation.php");
	function testInput($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	$firstName=$surname=$password=$email=$addressLine1=$addressLine2=$county=$postcode="";
	if(isset($_POST["customerSubmit"]))
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
			$validation = new Validation();
			$accountCreated = false;
			$firstName = testInput($_POST["customerName"]);
			$surname = testInput($_POST["surname"]);
			$password = testInput($_POST["password"]);
			$passwordReenter = testInput($_POST["passwordReenter"]);
			$email = testInput($_POST["email"]);
			$addressLine1 = testInput($_POST["addressLine1"]);
			$addressLine2 = testInput($_POST["addressLine2"]);
			$county = testInput($_POST["county"]);
			$postcode = testInput($_POST["postcode"]);
			if($validation -> validateAll($firstName, $surname, $email, $addressLine1, $addressLine2, $county, $postcode) && $password == $passwordReenter) {
				$tempCustomer=new Customer($firstName,$password,$surname,$email,$addressLine1,$addressLine2,$county,$postcode);
				//var_dump($temp_customer);
				$tempDAO=new customerDAO();
				$accountCreated=$tempDAO->createCustomer($tempCustomer);
			}
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
	<!--htmlspecialchars() converts special characters like '<' and '>' to HTML entities.(in this case &lt; and &gt;).
		This prevents attackers from exploiting the code by injecting HTML or Javascript code (Cross-site Scripting attacks) in the form.
		$_SERVER["PHP_SELF"] allows error messages generated when submitting the form, such as not filling in a required field, to be displayed
		on the same page.
	-->
	<form method="post" id="newCustomerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<h3>First Name</h3>
		<!--value attribute will allow the values entered by user to remain in the fields in the event that the form has been submitted
			but validation has failed-->
		<input type="text" name="customerName" value="<?php echo $firstName;?>" required>*
		<h3>Surname</h3>
		<input type="text" name="surname" value="<?php echo $surname;?>" required>*
		<h3>Password</h3>
		<input type="password" name="password" required>*
		<h3>Re-enter Password</h3>
		<input type="password" name="passwordReenter" required>*
		<h3>Email</h3>
		<input type="email" name="email" value="<?php echo $email;?>" required>*
		<br><br>
		<div id="locationField">
	    	<input id="autocomplete" placeholder="Enter your address"
				onFocus="geolocate()" type="text"></input>
		</div>
	    <h3>Address Line 1</h3>
	    <input name = "addressLine1" id="route" value="<?php echo $addressLine1;?>" required></input>*
	    <h3>City/Town</h3>
	    <input name = "addressLine2" id="postal_town" value="<?php echo $addressLine2;?>" required></input>*
	    <h3>County</h3>
	    <input name="county" id="administrative_area_level_2" value="<?php echo $county;?>" required></input>*
	    <h3>Postcode</h3>
	    <input name = "postcode" id="postal_code" value="<?php echo $postcode;?>" required></input>*

		<p id="reCAPTCHAWarning">Please note that for the purposes of reCAPTCHA, data on hardware,software and your IP address will be collected and sent to Google
		by creating an account, you agree to allow them to do this</p>
		<div class="g-recaptcha" data-sitekey="<?php echo $SITE_KEY ?>"></div>

		<input type="submit" value="Create Account" name="customerSubmit">

	</form><!--end new_customer_form-->
</body>

<!--Developer notes:
1.Never change the name of the "name" or "id" attributes within the input tags
2.keep the types as they are when they are "password" types
3.Do not change the location of any file in the directory, this file is reliant on others
4.In relation to the "reCAPTCHAWarning" tag, feel free to change it or place it as a pop up on this page, however it must exist and be easily visible
-->

<?php

	require("secretKey.php");
	require("DAO/hashClassDAO.php");
	function getConnection()
	{
		$connection=new mysqli($GLOBALS["server"],$GLOBALS["usernameS"],$GLOBALS["passwordS"],$GLOBALS["database"]);
		if($connection->connect_error)
		{
			die("Failed to establish a connection, please try again later");
		}//if there was a connection error
			return $connection;
    }
    function sendMail($email,$accountType)
    {
    	$token = "1234567890-=+_)(*&^%$£!qwertyuiop[]#';~#@;:lLkjhgfdsa\|zxcvbnm,./?><MNBVCXZKJHGFDSAQWERTYUIOP";
    	//Shuffles the string
    	$token = str_shuffle($token);
    	//Takes the 35 first in the sequence
    	$token = substr($token, 0,35);
    	//url received by the user

    	$url = "http://maryandamyt/resetPassword.php?token='". $token . "'&email='". $email ."'";

    	$customerQuery = "UPDATE customer SET token = '". $token . "' WHERE email='" .
                           $email;

		$bakerQuery = "UPDATE baker SET token = '". $token . "' WHERE contactEmail='" .
                           $email;


    	if($accountType == 1)
    	{
    		$connection->query($customerQuery);
    	}
    	else if($accountType == 2)
    	{
    		$connection->query($bakerQuery);
    	}
    	else
    	{
    		echo "An error occured";
    	}
		



    	mail($email,"Reset Password","Please click on the link: http:// ...........   to reset your password");
    }

	if(isset($_POST["forgottenPasswordSubmitButton"]))
	{
		$secretKey=$SECRET;//the reCAPTCHA secret key
		$response=$_POST["g-recaptcha-response"];//required reCAPTCHA response(aka sends the user data to google)
		$ip=$_SERVER['REMOTE_ADDR'];

		$url=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$response."&remoteip=".$ip);//the data is sent to this google page
		//file_get_contents, in this case, sends a request to google and gets the JSON response back in the form of a string
		$arrayResult=json_decode($url,true);//a JSON object was returned, converts to an array
		//param2=true means that it is returning an associative array

		$bakerConnQuery = "SELECT * FROM baker WHERE contactEmail='" .
                           $_POST["email"];
    
    	$customerConnQuery = "SELECT * FROM customer WHERE email='" .
                           $_POST["email"];
    

		$connection = getConnection();

		//Stores query results 
		$bakerResult = $connection->query($bakerConnQuery);
		$customerResult = $connection->query($customerConnQuery);

		//Variable used to store specific query rows
    	$bakerRow  = $bakerResult->fetch_assoc();
		$customerRow  = $customerResult->fetch_assoc();







		if($arrayResult["success"] == true)
		{
			if($customerRow != null) 
    		{
    			$accountType = 1;
    			$userEmail = $customerRow["email"];
    			sendMail($userEmail,$accountType);
			} 
    		else if($bakerRow != null)
    		{	
    			$accountType = 2;
				$userEmail = $bakerRow["email"];
				sendMail($userEmail,$accountType);
			}
     		else
    		{
	   			$message = "Invalid Email address";
			}
		}
		else
		{
			echo "An error occured with the captcha, please try again";
		}
	}


?>

<html>
	<head>
		<title>Recover Password</title>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>


	<body>
		<p>Recover password</p>
		<form action ="" method="post" id="forgot_password_form">
		<label for="login">Email address: </label>
		<input name = "email" type = "text" class="input_field" required>
		<br><br>
		<div class="g-recaptcha" data-sitekey="<?php echo $SITE_KEY ?>"></div>
		<p id="reCAPTCHAWarning">Please note that for the purposes of reCAPTCHA, data on hardware,software and your IP address will be collected and sent to Google
		by creating an account, you agree to allow them to do this</p>
		<br><br>
		<input type="submit" name="forgottenPasswordSubmitButton" value="Submit" class="form-submit-button">
		</form>

	</body>
	
</html>
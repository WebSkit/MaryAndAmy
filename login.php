

<?php 
session_start();
$conn = mysqli_connect("localhost","root","","maryandamy");

$message="Version 1";

if(isset($_POST["login"]))
	{
		$secretKey=$SECRET;//the reCAPTCHA secret key
		$response=$_POST["g-recaptcha-response"];//required reCAPTCHA response(aka sends the user data to google)
		$ip=$_SERVER['REMOTE_ADDR'];

		$url=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$response."&remoteip=".$ip);//the data is sent to this google page
		//file_get_contents, in this case, sends a request to google and gets the JSON response back in the form of a string
		$arrayResult=json_decode($url,true);//a JSON object was returned, converts to an array
		//param2=true means that it is returning an associative array


		echo '<pre>';  print_r(arrayResult); echo '</pre>';
		
		if($arrayResult["login"]==true)
		{
			$validation = new Validation();
			$CustomerEmail = testInput($_POST['email']);
			$password = testInput($_POST["password"]);
			
			if($validation -> validateAll($email) && $password == $passwordReenter) 
			{
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


if(!empty($_POST["login"])) 
{
    $bakerResult = mysqli_query($conn,"SELECT * FROM baker WHERE contactEmail='" .
                           $_POST["email"] . "' and password = '". $_POST["password"]."'");
    
     $customererResult = mysqli_query($conn,"SELECT * FROM customer WHERE email='" .
                           $_POST["email"] . "' and password = '". $_POST["password"]."'");
    
     $adminResult = mysqli_query($conn,"SELECT * FROM admin WHERE email='" .
                           $_POST["email"] . "' and password = '". $_POST["password"]."'");
    
    $bakerRow  = mysqli_fetch_array($bakerResult);
	$customerRow  = mysqli_fetch_array($customererResult);
    $adminRow  = mysqli_fetch_array($adminResult);
    
    
	if(is_array($customerRow)) 
    {
	   $_SESSION["customerID"] = $customerRow['customerID'];
	} 
    if(is_array($bakerRow))
    {
	   $_SESSION["bakerID"] = $bakerRow['bakerID'];
	}
    if(is_array($adminRow))
    {
	   $_SESSION["adminID"] = $adminRow['adminID'];
	}
     else 
    {
	   $message = "Invalid Email address or Password!";
	}
}

if(!empty($_POST["logout"])) 
{
	session_destroy();
    header("Refresh:0");
}
?>


<html>
<head>
<title>User Login</title>
<style>
#login_form {
	padding: 20px 60px;
	background: #B6E0FF;
	color: #555;
	display: inline-block;
	border-radius: 4px;
}
.field-group {
	margin:15px 0px;
}
.input-field {
	padding: 8px;width: 200px;
	border: #A3C3E7 1px solid;
	border-radius: 4px;
}
.form-submit-button {
	background: #65C370;
	border: 0;
	padding: 8px 20px;
	border-radius: 4px;
	color: #FFF;
	text-transform: uppercase;
}
.member-dashboard {
	padding: 40px;
	background: #D2EDD5;
	color: #555;
	border-radius: 4px;
	display: inline-block;
	text-align:center;
}
.logout-button {
	color: #09F;
	text-decoration: none;
	background: none;
	border: none;
	padding: 0px;
	cursor: pointer;
}
.error-message {
	text-align:center;
	color:#FF0000;
}
.demo-content label{
	width:auto;
}
</style>
</head>
<body>
<div>
    
<div style="display:block;margin:0px auto;">
    
    
<?php if(empty($_SESSION["customerID"]) and empty($_SESSION["bakerID"])  and empty($_SESSION["adminID"])) { ?>
    
    
<form action="" method="post" id="login_form">  
    <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
    <div class="field-group">
        
		<div><label for="login">Email address</label></div>
		<div><input name="email" type="text" class="input-field"></div>
	</div>
	<div class="field-group">
		<div><label for="password">Password</label></div>
		<div><input name="password" type="password" class="input-field"> </div>
	</div>
	<div class="field-group">
        <div>
            <input type="submit" name="login" value="Login" class="form-submit-button">
            <input type="submit" name="register" value="Register" class="form-submit-button">
            <br>
            <a href="https://www.w3schools.com/html/">forgot password?</a>
        </div>
	</div>
    
</form>
<?php
} else {
    
    if(!empty($_SESSION["bakerID"]))
    {
        $result =  mysqli_query($conn,"SELECT * FROM baker WHERE bakerID='" . $_SESSION["bakerID"] . "'");
        $f = 'companyName';
    }
        if(!empty($_SESSION["adminID"]))
    {
        $result = mysqli_query($conn,"SELECT * FROM admin WHERE adminID='" . $_SESSION["adminID"] . "'");
        $f = 'username';
    }
            if(!empty($_SESSION["customerID"]))
    {
        $result = mysqli_query($conn,"SELECT * FROM customer WHERE customerID='" . $_SESSION["customerID"] . "'");
        
        $f = 'firstName';
    }



$row  = mysqli_fetch_array($result);
?>
<form action="" method="post" id="logoutForm">
    
<div class="member-dashboard">Welcome <?php echo ucwords($row[$f]); ?>, You have successfully logged in!<br>
Click to <input type="submit" name="logout" value="Logout" class="logout-button">.</div>
</form>
</div>
    
</div>
<?php } ?>
    


</body>
</html>

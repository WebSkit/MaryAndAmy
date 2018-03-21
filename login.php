

<?php

if (session_status() == PHP_SESSION_NONE) {
session_start();    
}

	require(realpath(dirname(__FILE__).'\databaseDetails.php'));

	$message="Version 1";

	function getConnection()
	{
		$connection=new mysqli($GLOBALS["server"],$GLOBALS["usernameS"],$GLOBALS["passwordS"],$GLOBALS["database"]);
		if($connection->connect_error)
		{
			die("Failed to establish a connection, please try again later");
		}//if there was a connection error
			return $connection;
    }


    // if the login button hasn't been clicked
	if(isset($_POST["login"]))

	{
		//Query for each account types
    	$bakerConnQuery = "SELECT * FROM baker WHERE contactEmail='" .
                           $_POST["email"] . "' and password = '". $_POST["password"]."'";

     	$customerConnQuery = "SELECT * FROM customer WHERE email='" .
                           $_POST["email"] . "' and password = '". $_POST["password"]."'";
    
    	$adminConnQuery = "SELECT * FROM admin WHERE email='" .
                           $_POST["email"] . "' and password = '". $_POST["password"]."'";
    
        //Stores getConnection fuction
    	$connection = getConnection();

    	//Stores query results 
		$bakerResult = $connection->query($bakerConnQuery);
		$customerResult = $connection->query($customerConnQuery);
		$adminResult = $connection->query($adminConnQuery);

		//Variable used to store specific query rows
    	$bakerRow  = $bakerResult->fetch_assoc();
		$customerRow  = $customerResult->fetch_assoc();
    	$adminRow  = $adminResult->fetch_assoc();

    	//If account type query is a match
    	//Create new session variables
    	//
		if($customerRow != null) 
    	{
    		/*
    		//Current session has account type 'customer'
	   		$_SESSION["accountType"] = "customer";
	   		//Current sessionID is the customerID
	   		$_SESSION["customerSessionID"] = $customerRow['customerID'];
			*/
	   		$_SESSION["userId"] = $customerRow['customerID'];
	   		$_SESSION["accountType"]="customer";
	   		$url="customerHome.php";
	  	    header('Location: '.$url);
		} 
    	else if($bakerRow != null)
    	{	
	   		$_SESSION["userId"] = $bakerRow['bakerID'];
	   		$_SESSION["accountType"]="baker";
	    	$url="bakerPage(bakersView).php";
	  		header('Location: '.$url);
		}
    	else if($adminRow != null)
    	{
	   		$_SESSION["userId"] = $adminRow['adminID'];
	   		$_SESSION["accountType"]="admin";
	    	$url="adminHome.php";
	 		header('Location: '.$url);
		}
     	else
    	{
	   		$message = "Invalid Email address or Password!";
		}
	}
	else if(isset($_POST["logout"])) 
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
    
    
<?php 
	if(empty($_SESSION["userId"]))
	{ 

?>
    
    
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
            			<br>
            			<a href="https://www.w3schools.com/html/">Register as a customer</a>
        			</div>
        			<a href="https://www.createbakerpath.com/html/">Register as a baker</a>
            		<a href="forgotPassword.php">forgot password?</a>
				</div>
    
			</form>
<?php
	} 
	else
	{
		$connection=getConnection();
    	if($_SESSION["accountType"] == "baker")
    	{
        	$newBakerQuery = "SELECT * FROM baker WHERE bakerID='" . $_SESSION["userId"] . "'";
        	$newBakerResult = $connection->query($newBakerQuery);
        	$row  = $newBakerResult->fetch_assoc();
        	$f = 'companyName';
    	}
        else if($_SESSION["accountType"] == "admin")
    	{
        	$newAdminQuery = "SELECT * FROM admin WHERE adminID='" . $_SESSION["userId"] . "'";
        	$newAdminResult = $connection->query($newAdminQuery);
        	$row  = $newAdminResult->fetch_assoc();
        	$f = 'username';
    	}
        else if($_SESSION["accountType"] == "customer")
    	{
        	$newCustomerQuery = "SELECT * FROM customer WHERE customerID='" . $_SESSION["userId"] . "'";
        	$newCustomerResult = $connection->query($newCustomerQuery);
        	$row  = $newCustomerResult->fetch_assoc();
        	$f = 'firstName';
    	}
?>
<?php 	
	if(isset($_SESSION["userId"]) && $_SESSION["userId"]!=null)
	{ 
?>

				<form action="" method="post" id="logoutForm">
    
					<div class="member-dashboard">Welcome <?php echo ucwords($row[$f]); ?>, You have successfully logged in!<br>
					Click to <input type="submit" name="logout" value="Logout" class="logout-button">.</div>
					<a href="bakerPage(customersView).php">clcikefwe</a>
				</form>
<?php
	} 
?>

			</div>
    
		</div>
<?php 
	}
?>
	</body>
</html>

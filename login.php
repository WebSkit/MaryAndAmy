

<?php
	require(realpath(dirname(__FILE__).'\databaseDetails.php'));
	session_start();

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
    		//Current session has account type 'customer'
	   		$_SESSION["accountType"] = "customer";
	   		//Current sessionID is the customerID
	   		$_SESSION["customerSessionID"] = $customerRow['customerID'];
		} 
    	else if($bakerRow != null)
    	{	
	   		$_SESSION["accountType"] = "baker";
	   		$_SESSION["bakerSessionID"] = $bakerRow['bakerID'];
		}
    	else if($adminRow != null)
    	{
	   		$_SESSION["accountType"] = "admin";
	   		$_SESSION["adminSessionID"] = $adminRow['adminID'];
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
    
    
<?php 
	if(empty($_SESSION["customerSessionID"]) and empty($_SESSION["bakerSessionID"])  and empty($_SESSION["adminSessionID"])) 
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
    	if(!empty($_SESSION["bakerSessionID"]))
    	{
        	$newBakerQuery = "SELECT * FROM baker WHERE bakerID='" . $_SESSION["bakerSessionID"] . "'";
        	$newBakerResult = $connection->query($newBakerQuery);
        	$row  = $newBakerResult->fetch_assoc();
        	$f = 'companyName';
    	}
        if(!empty($_SESSION["adminSessionID"]))
    	{
        	$newAdminQuery = "SELECT * FROM admin WHERE adminID='" . $_SESSION["adminSessionID"] . "'";
        	$newAdminResult = $connection->query($newAdminQuery);
        	$row  = $newAdminResult->fetch_assoc();
        	$f = 'username';
    	}
        if(!empty($_SESSION["customerSessionID"]))
    	{
        	$newCustomerQuery = "SELECT * FROM customer WHERE customerID='" . $_SESSION["customerSessionID"] . "'";
        	$newCustomerResult = $connection->query($newCustomerQuery);
        	$row  = $newCustomerResult->fetch_assoc();
        	$f = 'firstName';
    	}
?>
				<form action="" method="post" id="logoutForm">
    
					<div class="member-dashboard">Welcome <?php echo ucwords($row[$f]); ?>, You have successfully logged in!<br>
					Click to <input type="submit" name="logout" value="Logout" class="logout-button">.</div>
					<a href="bakerPage(customersView).php">clcikefwe</a>
				</form>
			</div>
    
		</div>
<?php 
	}
?>
	</body>
</html>

<?php
	require("databaseDetails.php");

	function getConnection()
	{
		$connection=new mysqli($GLOBALS["server"],$GLOBALS["usernameS"],$GLOBALS["passwordS"],$GLOBALS["database"]);
		if($connection->connect_error)
		{
				die("Failed to establish a connection, please try again later");
		}//if there was a connection error
		return $connection;
    }

//!empty($_POST["password"]) && !empty($_POST["retypedPassword"]) 
	if(isset($_GET["email"]) && isset($_GET["token"]))
	{

		if(isset($_POST["submit"])  )
		{
			$password1 = $_POST["password"];
			$password2 = $_POST["retypedPassword"];
		
			if($password1 == $password2)
			{
				echo "password modified";
			}
			else
			{
				echo "Please type the same password";
			}
		}

	}
	else
	{
		header("Location: login.php");
		exit();
	}





?>

<html>
	<head>
		<title></title>
	</head>

	<body>
		<form method="post">

			<label for="password">Password</label>
			<input name="password" type="password" class="input-field" required>*
			<br><br><br>
			<label for="refg">Retype password</label>
			<input name="retypedPassword" type="password"  class="input-field" required>*
			<input type="submit" name="submit" value="Submit" class="form-submit-button">
		</form>
	</body>

</html>

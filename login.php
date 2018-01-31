<?php
session_start();
$conn = mysqli_connect("localhost","root","","maryandamy");

$message="Version 1";
if(!empty($_POST["login"])) {
	$result = mysqli_query($conn,"SELECT * FROM customer WHERE email='" . $_POST["email"] . "' and password = '". $_POST["password"]."'");
	$row  = mysqli_fetch_array($result);
	if(is_array($row)) {
	$_SESSION["customerId"] = $row['customerId'];
	} else {
	$message = "Invalid Username or Password!";
	}
}
if(!empty($_POST["logout"])) {
	$_SESSION["customerId"] = "BYE";
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
<?php if(empty($_SESSION["customer_id"])) { ?>
<form action="" method="post" id="login_form">
	<div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
	<div class="field-group">
		<div><label for="login">Username</label></div>
		<div><input name="email" type="text" class="input-field"></div>
	</div>
	<div class="field-group">
		<div><label for="password">Password</label></div>
		<div><input name="password" type="password" class="input-field"> </div>
	</div>
	<div class="field-group">
		<div><input type="submit" name="login" value="Login" class="form-submit-button"></div>
	</div>
</form>
<?php
} else {
$result = mysqli_query($conn,"SELECT * FROM customer WHERE customerID='" . $_SESSION["customerID"] . "'");
$row  = mysqli_fetch_array($result);
?>
<form action="" method="post" id="logoutForm">
<div class="member-dashboard">Welcome <?php echo ucwords($row['name']); ?>, You have successfully logged in!<br>
Click to <input type="submit" name="logout" value="Logout" class="logout-button">.</div>
</form>
</div>
</div>
<?php } ?>
</body>
</html>

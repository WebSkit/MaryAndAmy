 

<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$conn = mysqli_connect("localhost","root","","maryandamy");

$message="";

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
		echo "hello customer";
	   $_SESSION["userId"] = $customerRow['customerID'];
	   $_SESSION["accountType"]="customer";
	   $url="customerHome.php";
	   header('Location: '.$url);

	} 
    if(is_array($bakerRow))
    {
				echo "hello baker";

	   $_SESSION["userId"] = $bakerRow['bakerID'];
	   $_SESSION["accountType"]="baker";
	    $url="bakerPage(bakersView).php";
	   header('Location: '.$url);
	}
    if(is_array($adminRow))
    {
				echo "hello admin";

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
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Login</title>
<link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/style copy 3.css" />
		
</head>
<body>
<header>


      <div class="container">
        <div id="branding">
	
         
 <h1>  Mary <span class="highlight"> & </span> Amy </h1>
 
 
        </div>
 
 
        <nav>
          <ul>
            <li class="current"><a href="homeaPage.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
<?php if(isset($_SESSION["userId"]) && $_SESSION["userId"]!=null){ ?><li><a href="logout.php"><h2>Logout</h2></a></li><?php } else{ ?> <li><a href="login2.php"><h2>Login/Register<h2></a></li>  <?php } ?>
<img src="images/logins.png">
 
          </ul>
        </nav>
      </div>
 
 
 
    </header>
 
    <section id="showcase">
      <div class="container">
     
        <h1></h1>
        <p></p>
      </div>
    </section>
	
<div>
    
<div style="display:block;margin:0px auto;">
    
    
<?php if(empty($_SESSION["userId"])) { ?>
    
    
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
    
    if($_SESSION["accountType"]=="baker")
    {
        $result =  mysqli_query($conn,"SELECT * FROM baker WHERE bakerID='" . $_SESSION["userId"] . "'");
        $f = 'companyName';
    }
        if($_SESSION["accountType"]=="admin")
    {
        $result = mysqli_query($conn,"SELECT * FROM admin WHERE adminID='" . $_SESSION["userId"] . "'");
        $f = 'username';
    }
   if($_SESSION["accountType"]=="customer")
    {
        $result = mysqli_query($conn,"SELECT * FROM customer WHERE customerID='" . $_SESSION["userId"] . "'");
        
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
    

<footer>
	<p style="color:white;">Mary And Amy, Copyright &copy; 2017</p>
</footer>
</body>
</html>

<?php
include("../userDAOClasses/bakerDAO.php");//this require contains a session_start() within it, so it does not need to be used here
$_SESSION["userId"]=1;
$_SESSION["accountType"]="baker";//remove both of these tester session variables after you have completed this page

if($_SESSION["accountType"]!="baker")
{
	die("Only bakers are allowed on this page");
}
else
{
$bakerDAO=new bakerDAO();
$bakerObject=$bakerDAO->getBakerObject($_SESSION["userId"]);
if($bakerObject==false)
{
	die("Something went wrong,Please try again later");
}

if(isset($_POST["editDetails"]))
{
	echo "posting done";
	$bakerObject->setName($_POST["companyName"]);
	$bakerObject->setPassword($_POST["password"]);
	$bakerObject->setAddressLine1($_POST["addressLine1"]);
	$bakerObject->setAddressLine2($_POST["addressLine2"]);
	$bakerObject->setCounty($_POST["county"]);
	$bakerObject->setShopPhoneNumber($_POST["phoneNumber"]);
	$bakerObject->setFacebookPage($_POST["faceBookPage"]);
	$bakerObject->setWebsite($_POST["companyWebSite"]);
	if($bakerDAO->updateBaker($bakerObject)==true)
	{
		echo "update successful";
	}
	else
	{
		echo "update failure";
	}

}
?>
<!doctype html>
<head>
</head>

<!-- this page will allow the following fields to be editted
	-companyName
	-password
	-addressLine1
	-addressLine2
	-county
	-postCode
	-shopPhoneNumber
	-minNoticeTime
	-facebookPage
	-website
	
	The following will be editted on different pages
	-adminName
	-adminEmail(as the two emails are for two different people)
	-contactName
	-contactEmail
	-servedArea(it goes with some other stuff)
	-buisnessType(because there are multiple)
	-logo(due to it needing an upload)
	
	
	-->
<body>
	<form method="post" id="createBakerForm">

		<h3>Company Name</h3>
		<input type="text" name="companyName" value="<?php echo $bakerObject->getName();?>">
		
		<h3>Password</h3>
		<input type="password" name="password">
		
		<h3>address Line 1</h3>
		<input type="text" name="addressLine1" value="<?php echo $bakerObject->getAddressLine1();?>">
		<h3>address Line 2</h3>
		<input type="text" name="addressLine2" value="<?php echo $bakerObject->getAddressLine2();?>">
		<h3>Post Code</h3>
		<input type="text" name="postCode" value="<?php echo $bakerObject->getPostCode();?>">
		<h3>County</h3><!--feel free to remove country if it is irrelevant-->
		<input type="text" name="county" value="<?php echo $bakerObject->getCounty();?>">
		
		<h3>Phone Number</h3>
		<input type="text" name="phoneNumber" value="<?php echo $bakerObject->getShopPhoneNumber();?>">
		
		<!--<h3>Minimum Notice Time</h3>
		<input type="text" name="minNoticeTime"> I will change this to a different update form-->
		
		<h3>Facebook Page</h3>
		<input type="text" name="faceBookPage"value="<?php echo $bakerObject->getFacebookPage();?>">
		
		<h3>Website Address</h3>
		<input type="text" name="companyWebSite"><br>
		<input type="submit" name="editDetails" value="Update Account" value="<?php echo $bakerObject->getWebsite();?>"></input>
	</form>
</body>

</html>

<?php
}//else if you are a logged in baker
?>
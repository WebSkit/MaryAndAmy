<?php
	require("../DAO/enquiryDAO.php");
	$_SESSION["userId"]=1;
	$_SESSION["accountType"]="customer";
	if(isset($_POST["enquirySubmit"]))
	{	
		echo $_POST["DBD"];
		//still making the date datatype respondable
		$tempEnquiry= new enquiry ($_SESSION["userId"],$_POST["eD"],$_POST["priceRange"],$_POST["DBD"]);
		$tempDAO=new enquiryDAO();
		$enquiryCreated=$tempDAO->createEnquiry($tempEnquiry);
		if($enquiryCreated==true)
		{
			echo "account created";
		}
		else
		{
			echo "something went wrong, please try again later";
		}
	}//if data was submitted successfully from the form
?>


<body>
	<h2>Create an Enquiry</h2>
	<form method="post" id="createEnquiryForm">
		<h3>Enquiry Description</h3>
		<input type="text" name="eD">
		
		<h3>Price Range</h3>
		<input type="text" name="priceRange">
		
		<h3>Due By Date (YYYY-MM-DD)</h3>
		<input type="text" name="DBD">
		
		<input type="submit" value="Create An Enquiry" name="enquirySubmit">
	</form><!--end createEnquiryForm-->
</body>

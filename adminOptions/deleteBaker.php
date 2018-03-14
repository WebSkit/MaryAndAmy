<?php
	include("../userDAOClasses/bakerDAO.php");
	$_SESSION["userId"]=1;
	$_SESSION["accountType"]="admin";
	
	//for deleting a baker
	if(isset($_POST["BDSubmit"]))
	{
		$tempDAO=new bakerDAO();
		$accountDeleted=$tempDAO->deleteBaker($_POST["bakerId"]);
		if($accountDeleted==true)
		{
			echo "baker account is deleted";
		}
		else
		{
			echo "something went wrong, please try again later";
		}	
	}//if data was submitted successfully from the form
	
?>
	<body>
	<h2>Delete a Baker</h2>
	<form method="post" id="deleteBakerForm">
		<h3>Baker ID</h3>
		<input type="text" name="bakerId">
		<input type="submit" value="Delete Baker" name="BDSubmit">
	</form><!--end deleteBakerForm-->
	</body>
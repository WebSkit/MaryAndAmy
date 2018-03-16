<?php
	//session_start();
	include('../MaryAndAmy/userDAOClasses/bakerDAO.php');
	$_SESSION["userId"]=1;
	$_SESSION["accountType"]="admin";
	?>
	<!--changes here-->
	<a href="adminOptions/addAdmin.php"><button type="button" name="addAcount" value="Add admin">Add a new admin</button></a>
	<a href="adminOptions/updateAdmin.php"><button type="button" name="editAccountDetails" value="Edit Account Details">Change admin details</button></a>
	<a href="adminOptions/deleteCustomer.php"><button type="button" name="deleteCustomer" value="Delete Customer">Delete Customer</button></a>
	<a href="adminOptions/deleteBaker.php"><button type="button" name="deleteBaker" value="Delete Baker">Delete Baker</button></a>
	
<?php	
	//for seeing potential bakers
	//editing
	if(isset($_POST["YBSubmit"]))
	{
		$tempDAO=new bakerDAO();
		$verify=$tempDAO->verifyBaker($_POST["bakerId"]);	
		if($verify==true)
		{
			echo "acount is verify";
		}
		else
		{
			echo "something went wrong, please try again later";
		}	
	}//if data was submitted successfully from the form	
?>


	
	<h2>Verify a Baker</h2>
	<form method="post" id="yesBakerForm">
		<h3>Baker ID</h3>
		<input type="text" name="bakerId">
		<input type="submit" value="verify" name="YBSubmit">
	</form><!--end yesBakerForm-->
	
	<h2>See Applying Bakers</h2>
	<form method="post" id="seeBakers">
		<?php
			$tempDAO=new bakerDAO();
			$bakerArray=$tempDAO->selectBaker('isApproved',0);
			if($bakerArray!=null)
			{				
			$bakerCount=sizeof($bakerArray);
			$tempCount=0;
			while($tempCount<$bakerCount)
			{
		?>			
			<ul id="review "<?php echo $tempCount+1;?>>
				<li>BakerId:<?php echo $bakerArray[$tempCount]["bakerId"];?></li>
				<ul>Address line 1: <?php echo $bakerArray[$tempCount]["addressLine1"];?></ul>
				<ul>addressLine2: <?php echo $bakerArray[$tempCount]["addressLine2"];?></ul>
				<ul>county: <?php echo $bakerArray[$tempCount]["county"];?></ul>
				<ul>postcode: <?php echo $bakerArray[$tempCount]["postcode"];?></ul>
				<ul>servedArea: <?php echo $bakerArray[$tempCount]["servedArea"];?></ul>
				<ul>shopPhoneNumber: <?php echo $bakerArray[$tempCount]["shopPhoneNumber"];?></ul>
				<ul>adminName: <?php echo $bakerArray[$tempCount]["adminName"];?></ul>
				<ul>adminEmail: <?php echo $bakerArray[$tempCount]["adminEmail"];?></ul>
				<ul>contactName: <?php echo $bakerArray[$tempCount]["contactName"];?></ul>
				<ul>contactEmail: <?php echo $bakerArray[$tempCount]["contactEmail"];?></ul>
				<ul>facebookPage: <?php echo $bakerArray[$tempCount]["facebookPage"];?></ul>
			</ul>
			
<?php
			$tempCount++;
		}//while there are reviews in the list
	}
	else
	{
		echo "something went wrong, please try again later";
	}
?>
	</form><!--end deleteCustomerForm-->
	
</body>


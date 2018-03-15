<?php
	//session_start();
	include('../MaryAndAmy/userDAOClasses/customerDAO.php');
	include('../MaryAndAmy/DAO/enquiryDAO.php');
	$_SESSION["userId"]=1;
	$_SESSION["accountType"]="customer";
	?>
	
	
	<a href="customerOptions/updatecustomer.php"><button type="button" name="editAccountDetails" value="Edit Account Details">Change your details</button></a>
	<a href="customerOptions/createEnquiries.php"><button type="button" name="addEnquiry" value="Add enquiry">Make an enquiry</button></a>
	
	<h2>Current Enquiries</h2>
	<form method="post" id="seeBakers">
<?php
		$tempDAO=new enquiryDAO();
		$enquiryArray=$tempDAO->getEnquiriesCust($_SESSION["userId"]);
		if($enquiryArray!=null)
		{				
			$enquiryCount=sizeof($enquiryArray);
			$tempCount=0;
			while($tempCount<$enquiryCount)
			{
				$d=$enquiryArray[$tempCount]["dueBy"]
?>		
				<ul id="enquiry "<?php echo $tempCount+1;?>>
					<li>Enquiry Description: <?php echo $enquiryArray[$tempCount]["enquiryDescription"];?></li>
					<ul>Price Range: <?php echo $enquiryArray[$tempCount]["priceRange"];?></ul>
					<!--not working yet-->
					<!--<ul>Due By Date: <?php //echo date("d.m.Y",$d);?></ul>-->
				</ul>	
<?php
				$tempCount++;
			}//while there are reviews in the list
		}else
		{
			echo "something went wrong, please try again later";
		}	
?>
	</form>
	
</body>


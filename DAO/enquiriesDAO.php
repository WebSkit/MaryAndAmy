<?php

	$requiredAddress=realpath(dirname(__FILE__).'\..\databaseDetails.php');
	require($requiredAddress);
	class enquiriesDAO{
		function __construct()
		{
		}//constructor
		function getConnection()
		{
			$connection=new mysqli($GLOBALS["server"],$GLOBALS["usernameS"],$GLOBALS["passwordS"],$GLOBALS["database"]);
			if($connection->connect_error)
			{
				die("Failed to establish a connection, please try again later");
			}//if there was a connection error
			return $connection;
		}//end getConnection

		function getEnquiries($bakerID)
		{
			//not using prepared statement as the bakerId is never chosen by the user, please tell me if there is anything I may have missed
			$connection=$this->getConnection();
			//query gets all fields from enquiry table as long as the bakerID in enquirebaker table is equal to the passed parameter
            //AND the enquiryID matches in both tables.
            $query="SELECT *, DATE_FORMAT(dueBy,'%d-%m-%Y') AS dueByDate FROM enquiry AS e JOIN enquirebaker AS eb WHERE eb.bakerID=".$bakerID." AND e.enquiryID=eb.enquiryID ORDER BY dueByDate";
			if($result=$connection->query($query))
			{
				echo "successful query";
			}
			else
			{
				echo $connection->error;
			}
			$enquiriesArray=array();
			$tempCount=0;
			if($result->num_rows>0)
			{
				while($row=$result->fetch_assoc())
				{
					echo "<br>";
                    //possible to add enquiryid: ->>> "enquiryID"=>$row["enquiryID"],
					$enquiriesArray[$tempCount]=array("customerID"=>$row["customerID"],"enquiryDescription"=>$row["enquiryDescription"],"priceRange"=>$row["priceRange"],"dueBy"=>$row["dueByDate"]);
					$tempCount++;
				}//while item in result object
				return $enquiriesArray;
			}//if there is data about enquiries
			else
			{
				return null;
			}//if no data, return null
		}//end getEnquiries

	}//end enquiriesDAO class


?>

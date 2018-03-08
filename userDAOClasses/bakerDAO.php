<?php
	session_start();
	$_SESSION["baker_id"]=1;//this is only testing will need to change it later
	require('../MaryAndAmy/databaseDetails.php');
	require("../MaryAndAmy/userClasses/Baker.php");//go up a level, then find the file
	class BakerDAO
	{
		var $serverName;
		var $username;
		var $password;
		var $database;
		function __construct()
		{
			$this->serverName=$GLOBALS["server"];
			$this->username=$GLOBALS["usernameS"];
			$this->password=$GLOBALS["passwordS"];
			$this->database=$GLOBALS["database"];
		}//end constructor

		function getConnection()
		{
			$connection = new mysqli($this->serverName, $this->username, $this->password, $this->database);
			if($connection->connect_error)
			{
				die("Failed to establish a connection, please try again later");
			}//if there was a connection error
			return $connection;
		}//end getConnection

		function createBaker($newBaker)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("INSERT INTO baker (companyName,password,addressLine1,addressLine2,county,postcode,pictureCount,isApproved,
				servedArea,logo,website,shopPhoneNumber,minNoticeTime,adminName,adminEmail,contactName,contactEmail,facebookPage)
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			if($prepStatement==false)
			{
				die("something went wrong with the PREPARE method<br>".$connection->error);
			}
			$companyName=$newBaker->getName();
			$password=$newBaker->getPassword();
			$addressLine1=$newBaker->getAddressLine1();
			$addressLine2=$newBaker->getAddressLine2();
			$county=$newBaker->getCounty();
			$postcode=$newBaker->getPostCode();
			$pictureCount=$newBaker->getPictureCount();
			$isApproved=$newBaker->getIsApproved();
			$servedArea=$newBaker->getServedArea();
			$logo=$newBaker->getLogo();
			$website=$newBaker->getWebsite();
			$shopPhoneNumber=$newBaker->getShopPhoneNumber();
			$minNoticeTime=$newBaker->getMinNoticeTime();
			$adminName=$newBaker->getAdminName();
			$adminEmail=$newBaker->getAdminEmail();
			$contactName=$newBaker->getContactName();
			$contactEmail=$newBaker->getContactEmail();
			$facebookPage=$newBaker->getFacebookPage();

			$prepStatement->bind_param("ssssssssssssssssss",$companyName,$password,$addressLine1,$addressLine2,$county,$postcode,$pictureCount,$isApproved,
				$servedArea,$logo,$website,$shopPhoneNumber,$minNoticeTime,$adminName,$adminEmail,$contactName,$contactEmail,$facebookPage);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				die("something went wrong".$connection->error);
				return false;
			}//if query was a failure
		}//end createBaker

		function updateBaker($newBakerObject)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("UPDATE baker SET companyName=?,password=?, email=?,addressLine1=?,addressLine2=?,county=?, postCode=?,pictureCount=?,isApproved=?,
				servedArea=?, logo=?, website=?, shopPhoneNumber=?, businessType=?, minNoticeTime=?, adminName=?, adminEmail=?, contactName=?, contactEmail=?, facebookPage=?
				WHERE bakerID=?;");

			$id=$_SESSION["bakerID"];
			$companyName=$newBakerObject->getName();
			$passwordUser=$newBakerObject->getPassword();
			//$email=$newBakerObject->getEmail();
			$addressLine1=$newBakerObject->getAddressLine1();
			$addressLine2=$newBakerObject->getAddressLine2();
			$county=$newBakerObject->getCounty();
			$postCode=$newBakerObject->getPostCode();
			$pictureCount=$newBakerObject->getPictureCount();
			$isApproved=$newBakerObject->getIsApproved();
			$servedArea=$newBakerObject->getServedArea();

			$logo=$newBakerObject->getLogo();
			$website==$newBakerObject->getWebsite();
			$shopPhoneNumber=$newBakerObject->getShopePhoneNumber();
			//$businessType=$newBakerObject->getBusinessType();
			$minNoticeTime=$newBakerObject->getMinNoticeTime();
			$adminName=$newBakerObject->getAdminName();
			$adminEmail=$newBakerObject->getAdminEmail();
			$contactName=$newBakerObject->getContactName();
			$contactEmail=$newBakerObject->getContactEmail();
			$facebookPage==$newBakerObject->getFacebookPage();

			$prepStatement->bind_param("sssssssssssssssssssss",$companyName,$passwordUser,$email,$addressLine1,$addressLine2,$county,$postCode,$pictureCount,$isApproved,
				$servedArea,$logo,$website,$shopPhoneNumber,$businessType,$minNoticeTime,$adminName,$adminEmail,$contactName,$contactEmail,$facebookPage,$id);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end updateCustomer

		function deleteBaker($bakerNumber)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("DELETE FROM baker WHERE bakerID = ?;");

			$prepStatement->bind_param("s", $bakerNumber);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end deleteBaker

		function selectBaker($type,$condition)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("SELECT * FROM baker WHERE ? = ?");
			$prepStatement->bind_param("ss", $type,$condition);
			$result=$prepStatement->execute();
			if($prepStatement->execute())
			{
				return $result;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end of selectBaker

		function getBakerObject($id)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("SELECT * FROM baker WHERE bakerId = ?");
			$prepStatement->bind_param("s", $id);
			$result;//=$prepStatement->execute();
			if($prepStatement->execute())
			{
				$result = $prepStatement->get_result();

				$bakerObject;
				while($row=$result->fetch_assoc())
				{
					$bakerObject=new Baker($row["companyName"],$row["password"],$row["addressLine1"],$row["addressLine2"],$row["county"],$row["postcode"],$row["pictureCount"],$row["isApproved"],$row["servedArea"],$row["logo"],$row["website"],$row["shopPhoneNumber"],$row["minNoticeTime"],$row["adminName"],$row["adminEmail"],$row["contactName"],$row["contactEmail"],$row["facebookPage"]);
					return $bakerObject;
				}
				return $result;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//endGetBakerObject

		
		function setLogo($userId,$logoDirectory)
		{
			$connection=$this->getConnection();
			$query="UPDATE baker SET logo=? WHERE bakerID=?";
			$prepStatement=$connection->prepare($query);
			$prepStatement->bind_param("ss",$logoDirectory,$userId);
			$prepStatement->execute();
			
			if($prepStatement->affected_rows>0)
			{
				return true;
			}//if the logo location was successfully added
			else
			{
				return false;
			}//if the update failed
		}
		function getLogoLocation($userId)
		{
			$connection=$this->getConnection();
			$query="SELECT * FROM baker WHERE bakerID=?";
			$prepStatement=$connection->prepare($query);
			$prepStatement->bind_param("s",$userId);
			if($prepStatement->execute())
			{
				$result=$prepStatement->get_result();
				while($row=$result->fetch_assoc())
				{
					return $row["logo"];
				}
			}//if query executed successfully
			
			return false;
		}//end getLogoLocation
		
		//function I created for display shop on map.
		function getBakerLocation($bakerID) //returning full address of the baker.
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("SELECT * FROM baker WHERE bakerID = ?");
			$prepStatement->bind_param("s",$bakerID);

			$result;//=$prepStatement->execute();
			if($prepStatement->execute())
			{
				$result = $prepStatement->get_result();

				$bakerObject;
				while($row=$result->fetch_assoc())
				{
					$bakerObject=new Baker($row["companyName"],$row["password"],$row["addressLine1"],$row["addressLine2"],$row["county"],$row["postcode"],$row["pictureCount"],$row["isApproved"],$row["servedArea"],$row["logo"],$row["website"],$row["shopPhoneNumber"],$row["minNoticeTime"],$row["adminName"],$row["adminEmail"],$row["contactName"],$row["contactEmail"],$row["facebookPage"]);
					return $bakerObject;
				}
				return $result;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end getBakerLocation
		
		function changeServiceOptions($serviceArea,$minNoticeTime,$bakerId)
		{
			if(is_numeric($serviceArea) && is_numeric($minNoticeTime))
			{
				$connection=$this->getConnection();
				//echo $connection->error;
				$query="UPDATE baker SET servedArea=?, minNoticeTime=? WHERE bakerID=?";
				if($prepStatement=$connection->prepare($query))
				{
				$prepStatement->bind_param("sss",$serviceArea,$minNoticeTime,$bakerId);
				$prepStatement->execute();
				if($prepStatement->affected_rows>0)
				{
					return true;
				}//if the logo location was successfully added
				else
				{
					return false;
				}//if the update failed
				}//if the statement was prepared sucessfully
				
			}//if both the inputs are numeric
			else
			{
				return false;
			}
		return false;//if nothing has been returned, something went wrong, return false
			
		}//changeServiceOptions method
		function updateDetails($bakerObject)
		{
			$connection=$this->getConnection();
			$query="UPDATE baker SET companyName=?, addressLine1=?,addressLine2=?,postcode=?,county=?,shopPhoneNumber=?,website=?,facebookPage=? WHERE bakerId=?";
			$prepStatement=$connection->prepare($query);
			
			$companyName=$bakerObject->getName();
			$addressLine1=$bakerObject->getAddressLine1();
			$addressLine2=$bakerObject->getAddressLine2();
			$postcode=$bakerObject->getPostCode();
			$county=$bakerObject->getCounty();
			$phoneNumber=$bakerObject->getShopPhoneNumber();
			$website=$bakerObject->getWebsite();
			$facebookPage=$bakerObject->getFacebookPage();
			$prepStatement->bind_param("sssssssss",$companyName,$addressLine1,$addressLine2,$postcode,$county,$phoneNumber,$website,$facebookPage,$_SESSION["userId"]);
			if($prepStatement->execute())
			{
				return true;
			
			return false;
		}//updateDetails, this method is for use for the changeDetails.php page only
	
	}//end bakerDAO
?>

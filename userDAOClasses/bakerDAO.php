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
				servedArea,logo,website,shopPhoneNumber,businessType,minNoticeTime,adminName,adminEmail,contactName,contactEmail,facebookPage)
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

			$companyName=$newBaker->getName();
			$password=$newBaker->getPassword();
			$email=$newBaker->getEmail();
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
			$businessType=$newBaker->getBusinessType();
			$minNoticeTime=$newBaker->getMinNoticeTime();
			$adminName=$newBaker->getAdminName();
			$adminEmail=$newBaker->getAdminEmail();
			$contactName=$newBaker->getContactName();
			$contactEmail=$newBaker->getContactEmail();
			$facebookPage=$newBaker->getFacebookPage();

			$prepStatement->bind_param("sssssssssssssssssss",$companyName,$password,$addressLine1,$addressLine2,$county,$postcode,$pictureCount,$isApproved,
				$servedArea,$logo,$website,$shopPhoneNumber,$businessType,$minNoticeTime,$adminName,$adminEmail,$contactName,$contactEmail,$facebookPage);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end createCustomer

		function updateBaker($newBakerObject)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("UPDATE bakers SET companyName=?,password=?, email=?,addressLine1=?,addressLine2=?,county=?, postCode=?,pictureCount=?,isApproved=?,
				servedArea=?, logo=?, website=?, shopPhoneNumber=?, businessType=?, minNoticeTime=?, adminName=?, adminEmail=?, contactName=?, contactEmail=?, facebookPage=?
				WHERE bakerID=?;");

			$id=$_SESSION["bakerID"];
			$companyName=$newBakerObject->getName();
			$passwordUser=$newBakerObject->getPassword();
			$email=$newBakerObject->getEmail();
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
			$businessType=$newBakerObject->getBusinessType();
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
			$prepStatement=$connection->prepare("DELETE FROM bakers WHERE bakerID = ?;");

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
			$prepStatement=$connection->prepare("SELECT * FROM bakers WHERE ? = ?");
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

	}//end customerDAO
?>

<?php
	session_start();
	$_SESSION["bakerId"]=1;//this is only testing will need to change it later
	require('../MaryAndAmy/databaseDetails.php');
	require("../MaryAndAmy/userClasses/newBaker.php");//go up a level, then find the file
	class bakerDAO
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

		function createBaker($newBakerObject)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("INSERT INTO bakers (companyName,password,email,addressLine1,addressLine2,postCode,county,pictureCount,isApproved,servedArea) VALUES(?,?,?,?,?,?,?,?,?,?)");

			$companyName=$newBakerObject->getName();
			$passwordUser=$newBakerObject->getPassword();
			$email=$newBakerObject->getEmail();
			$addressLine1=$newBakerObject->getAddressLine1();
			$addressLine2=$newBakerObject->getAddressLine2();
			$postCode=$newBakerObject->getPostCode();
			$county=$newBakerObject->getCounty();
			$pictureCount=$newBakerObject->getPictureCount();
			$isApproved=$newBakerObject->getIsApproved();
			$servedArea=$newBakerObject->getServedArea();
			$prepStatement->bind_param("sssssssss",$companyName,$passwordUser,$email,$addressLine1,$addressLine2,$postCode,$county,$pictureCount,$isApproved,$servedArea);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		
		function updateBaker($newBakerObject)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("UPDATE bakers SET companyName=?,password=?,email=?,addressLine1=?,addressLine2=?,postCode=?,county=?,pictureCount=?,isApproved=?,servedArea=? WHERE bakerId=?;");
			
			$id=$_SESSION["bakerId"];
			$companyName=$newBakerObject->getName();
			$passwordUser=$newBakerObject->getPassword();
			$email=$newBakerObject->getEmail();
			$addressLine1=$newBakerObject->getAddressLine1();
			$addressLine2=$newBakerObject->getAddressLine2();
			$postCode=$newBakerObject->getPostCode();
			$county=$newBakerObject->getCounty();
			$pictureCount=$newBakerObject->getPictureCount();
			$isApproved=$newBakerObject->getIsApproved();
			$servedArea=$newBakerObject->getServedArea();
			
			$prepStatement->bind_param("sssssssssss",$companyName,$passwordUser,$email,$addressLine1,$addressLine2,$postCode,$county,$pictureCount,$isApproved,$servedArea,$id);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
			
		}//end createCustomer
		}//end createCustomer
	}//end customerDAO
?>

<?php
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
			$prepStatement=$connection->prepare("INSERT INTO bakers (companyName,password,email,addressLine1,addressLine2,postCode,county,pictureCount,isApproved) VALUES(?,?,?,?,?,?,?,?,?)");

			$companyName=$newBakerObject->getName();
			$passwordUser=$newBakerObject->getPassword();
			$email=$newBakerObject->getEmail();
			$addressLine1=$newBakerObject->getAddressLine1();
			$addressLine2=$newBakerObject->getAddressLine2();
			$postCode=$newBakerObject->getPostCode();
			$county=$newBakerObject->getCounty();
			$pictureCount=$newBakerObject->getPictureCount();
			$isApproved=$newBakerObject->getIsApproved();
			$prepStatement->bind_param("sssssssss",$companyName,$passwordUser,$email,$addressLine1,$addressLine2,$postCode,$county,$pictureCount,$isApproved);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
				//die("Something went wrong when creating your account, please try again later");
			}//if query was a failure

		}//end createCustomer
	}//end customerDAO
?>

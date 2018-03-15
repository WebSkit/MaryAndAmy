<?php
	require(realpath(dirname(__FILE__).'\..\databaseDetails.php'));
	require(realpath(dirname(__FILE__).'\..\classes/enquireBaker.php'));

	class enquireBakerDAO
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
		
		function createEnquireBaker($newEnquireBakerObject)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("INSERT INTO enquireBaker (bakerId, enquiryID, customerAccept, bakerAccept) VALUES(?,?,?,?)");
			
			$bakerId=$newEnquiryObject->getBakerId();
			$enquiryID=$newEnquiryObject->getEnquiryID();
			$customerAccept=$newEnquiryObject->getCustomerAccept();
			$bakerAccept=$newEnquiryObject->getBakerAccept();
			$prepStatement->bind_param("ssss",$bakerId,$enquiryID,$customerAccept,$bakerAccept);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end createEnquiry
	}//end of class
?>
<?php
	require('../MaryAndAmy/databaseDetails.php');
	require("../MaryAndAmy/userClasses/newCustomer.php");//go up a level, then find the file
	class customerDAO
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

		function createCustomer($newCustomerObject)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("INSERT INTO customer (name,password,surname,email,addressLine1,AddressLine2,postCode,county) VALUES(?,?,?,?,?,?,?,?)");

			$name=$newCustomerObject->getName();
			$passwordUser=$newCustomerObject->getPassword();
			$surname=$newCustomerObject->getSurname();
			$email=$newCustomerObject->getEmail();
			$addressLine1=$newCustomerObject->getAddressLine1();
			$addressLine2=$newCustomerObject->getAddressLine2();
			$postCode=$newCustomerObject->getPostCode();
			$county=$newCustomerObject->getCounty();

			$prepStatement->bind_param("ssssssss",$name,$passwordUser,$surname,$email,$addressLine1,$addressLine2,$postCode,$county);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end createCustomer
		
		function updateCustomer($newCustomerObject)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("UPDATE customer SET name=?,surname=?,password=?,email=?,addressLine1=?,addressLine2=?,postCode=?,county=? WHERE customerId=?;");
			
			$id=$_SESSION["customerId"];
			$name=$newCustomerObject->getName();
			$passwordUser=$newCustomerObject->getPassword();
			$surname=$newCustomerObject->getSurname();
			$email=$newCustomerObject->getEmail();
			$addressLine1=$newCustomerObject->getAddressLine1();
			$addressLine2=$newCustomerObject->getAddressLine2();
			$postCode=$newCustomerObject->getPostCode();
			$county=$newCustomerObject->getCounty();
			$prepStatement->bind_param("sssssssss",$name,$surname,$passwordUser,$email,$addressLine1,$addressLine2,$postCode,$county,$id);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
	}//end customerDAO
?>

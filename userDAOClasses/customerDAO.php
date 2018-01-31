<?php
	session_start();
	$_SESSION["customer_id"]=1;//this is only testing will need to change it later
	require('../MaryAndAmy/databaseDetails.php');
	require("../MaryAndAmy/userClasses/Customer.php");//go up a level, then find the file
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

		function createCustomer($newCustomer)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("INSERT INTO customer (firstName,surname,password,email,addressLine1,addressLine2,county,postcode) VALUES(?,?,?,?,?,?,?,?)");

			$firstName=$newCustomer->getName();
			$password=$newCustomer->getPassword();
			$surname=$newCustomer->getSurname();
			$email=$newCustomer->getEmail();
			$addressLine1=$newCustomer->getAddressLine1();
			$addressLine2=$newCustomer->getAddressLine2();
			$county=$newCustomer->getCounty();
			$postcode=$newCustomer->getPostCode();

			$prepStatement->bind_param("ssssssss",$firstName,$surname,$password,$email,$addressLine1,$addressLine2,$county,$postcode);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end createCustomer

		function updateCustomer($newCustomer)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("UPDATE customer SET firstName=?,surname=?,password=?,email=?,addressLine1=?,addressLine2=?,county=?,postcode=? WHERE customerID=?;");

			$id=$_SESSION["customerID"];
			$firstName=$newCustomer->getName();
			$password=$newCustomer->getPassword();
			$surname=$newCustomer->getSurname();
			$email=$newCustomer->getEmail();
			$addressLine1=$newCustomer->getAddressLine1();
			$addressLine2=$newCustomer->getAddressLine2();
			$county=$newCustomer->getCounty();
			$postcode=$newCustomer->getPostCode();
			$prepStatement->bind_param("sssssssss",$firstName,$surname,$password,$email,$addressLine1,$addressLine2,$county,$postcode,$id);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}
	}//end customerDAO
?>

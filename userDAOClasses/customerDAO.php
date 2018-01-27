<?php
	session_start();
	$_SESSION["customer_id"]=1;//this is only testing will need to change it later
	require('../MaryAndAmy/databaseDetails.php');
	require("../MaryAndAmy/userClasses/Customer.php");//go up a level, then find the file
	class customerDAO
	{
		var $server_name;
		var $username;
		var $password;
		var $database;
		function __construct()
		{
			$this->server_name=$GLOBALS["server"];
			$this->username=$GLOBALS["usernameS"];
			$this->password=$GLOBALS["passwordS"];
			$this->database=$GLOBALS["database"];
		}//end constructor

		function getConnection()
		{
			$connection = new mysqli($this->server_name, $this->username, $this->password, $this->database);
			if($connection->connect_error)
			{
				die("Failed to establish a connection, please try again later");
			}//if there was a connection error
			return $connection;
		}//end getConnection

		function createCustomer($new_customer)
		{
			$connection=$this->getConnection();
			$prep_statement=$connection->prepare("INSERT INTO customer (name,password,surname,email,address_line1,address_line2,postcode,county) VALUES(?,?,?,?,?,?,?,?)");

			$name=$new_customer->getName();
			$password=$new_customer->getPassword();
			$surname=$new_customer->getSurname();
			$email=$new_customer->getEmail();
			$address_line1=$new_customer->getAddressLine1();
			$address_line2=$new_customer->getAddressLine2();
			$postcode=$new_customer->getPostCode();
			$county=$new_customer->getCounty();

			$prep_statement->bind_param("ssssssss",$name,$password,$surname,$email,$address_line1,$address_line2,$postcode,$county);
			if($prep_statement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end createCustomer

		function updateCustomer($new_customer)
		{
			$connection=$this->getConnection();
			$prep_statement=$connection->prepare("UPDATE customer SET name=?,surname=?,password=?,email=?,address_line1=?,address_line2=?,postcode=?,county=? WHERE customerId=?;");

			$id=$_SESSION["customer_id"];
			$name=$new_customer->getName();
			$password=$new_customer->getPassword();
			$surname=$new_customer->getSurname();
			$email=$new_customer->getEmail();
			$address_line1=$new_customer->getAddressLine1();
			$address_line2=$new_customer->getAddressLine2();
			$postcode=$new_customer->getPostCode();
			$county=$new_customer->getCounty();
			$prep_statement->bind_param("sssssssss",$name,$surname,$password,$email,$address_line1,$address_line2,$postcode,$county,$id);
			if($prep_statement->execute())
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

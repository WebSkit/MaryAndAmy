<?php
	session_start();
	$_SESSION["baker_id"]=1;//this is only testing will need to change it later
	require('../MaryAndAmy/databaseDetails.php');
	require("../MaryAndAmy/userClasses/Baker.php");//go up a level, then find the file
	class BakerDAO
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

		function createBaker($new_baker)
		{
			$connection=$this->getConnection();
			$prep_statement=$connection->prepare("INSERT INTO bakers (company_name,password,email,address_line1,address_line2,postcode,county,picture_count,is_approved,served_area) VALUES(?,?,?,?,?,?,?,?,?,?)");

			$company_name=$new_baker->getName();
			$password=$new_baker->getPassword();
			$email=$new_baker->getEmail();
			$address_line1=$new_baker->getAddressLine1();
			$address_line2=$new_baker->getAddressLine2();
			$county=$new_baker->getCounty();
			$postcode=$new_baker->getPostCode();
			$picture_count=$new_baker->getPictureCount();
			$is_approved=$new_baker->getIsApproved();
			$served_area=$new_baker->getServedArea();
			$prep_statement->bind_param("sssssssss",$company_name,$password,$email,$address_line1,$address_line2,$postcode,$county,$picture_count,$is_approved,$served_area);
			if($prep_statement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure

		function updateBaker($new_baker)
		{
			$connection=$this->getConnection();
			$prep_statement=$connection->prepare("UPDATE bakers SET company_name=?,password=?,email=?,address_line1=?,address_line2=?,postcode=?,county=?,picture_count=?,is_approved=?,served_area=? WHERE baker_id=?;");

			$id=$_SESSION["baker_id"];
			$company_name=$new_baker->getName();
			$password=$new_baker->getPassword();
			$email=$new_baker->getEmail();
			$address_line1=$new_baker->getAddressLine1();
			$address_line2=$new_baker->getAddressLine2();
			$postcode=$new_baker->getPostCode();
			$county=$new_baker->getCounty();
			$picture_count=$new_baker->getPictureCount();
			$is_approved=$new_baker->getIsApproved();
			$served_area=$new_baker->getServedArea();

			$prep_statement->bind_param("sssssssssss",$company_name,$password,$email,$address_line1,$address_line2,$postcode,$county,$picture_count,$is_approved,$served_area,$id);
			if($prep_statement->execute())
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

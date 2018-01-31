<?php
	session_start();
	$_SESSION["adminId"]=1;//this is only testing will need to change it later

	require("../MaryAndAmy/userDAOClasses/bakerDAO.php");
	require('../MaryAndAmy/databaseDetails.php');
	require("../MaryAndAmy/userClasses/Admin.php");//go up a level, then find the file
	class adminDAO
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

		function createAdmin($newAdminObject)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("INSERT INTO admin (username,password,email,phoneNumber) VALUES(?,?,?,?,)");

			$username=$newAdminObject->getName();
			$passwordUser=$newAdminObject->getPassword();
			$email=$newAdminObject->getEmail();
			$phoneNumber=$newAdminObject->getPhoneNumber();
			$prepStatement->bind_param("ssss",$userName,$passwordUser,$email,$phoneNumber);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
				//die("Something went wrong when creating your account, please try again later");
			}//if query was a failure

		}//end createAdmin

		function updateAdmin($newAdminObject)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("UPDATE admin SET username=?,password=?,email=?,phoneNumber=? WHERE adminID=?;");

			$id=$_SESSION["adminID"];
			$username=$newAdminObject->getName();
			$passwordUser=$newAdminObject->getPassword();
			$email=$newAdminObject->getEmail();
			$phoneNumber=$newAdminObject->getPhoneNumber();

			$prepStatement->bind_param("sssss",$userName,$passwordUser,$email,$phoneNumber,$id);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
				//die("Something went wrong when creating your account, please try again later");
			}//if query was a failure

		}//end updateAdmin
	}//end of adminDAO
?>

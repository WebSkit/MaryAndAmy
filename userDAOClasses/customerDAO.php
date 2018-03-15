<?php
	session_start();
	$_SESSION["customer_id"]=1;//this is only testing will need to change it later

	require(realpath(dirname(__FILE__).'\..\databaseDetails.php'));
	require(realpath(dirname(__FILE__).'\..\userClasses/Customer.php'));//go up a level, then find the file
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
		function deleteCustomer($customerNumber)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("DELETE FROM customer WHERE customerId = ?;");

			$prepStatement->bind_param("s", $customerNumber);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end deleteBaker
	}//end customerDAO

	function selectCustomer($type,$condition)
	{
		$connection=$this->getConnection();
		$prepStatement=$connection->prepare("SELECT * FROM customer WHERE ? = ?");
		$prepStatement->bind_param("ss", $type,$condition);
		$result=$prepStatement->execute();
		if($prepStatement->execute())
		{
			$result = $prepStatement->get_result();
			$customerObject;
			while($row=$result->fetch_assoc())
			{
				$customerObject=new customer($row["name"],$row["password"],$row["surname"],$row["email"],$row["addressLine1"],$row["addressLine2"],$row["postcode"],$row["county"]);
				return $customerObject;
			}
		}//if query was a success
		else
		{
			return false;
		}//if query was a failure
	}//end of approveBakerFind

	function getPassword()//still changing
	{
		$connection=$this->getConnection();
		$prepStatement=$connection->prepare("SELECT Password from customer WHERE customerId = ?");
		$prepStatement->bind_param("s", $_SESSION["userId"]);
		$result=$prepStatement->execute();
		if($prepStatement->execute())
		{
			$result = $prepStatement->get_result();
			$customerObject;
			while($row=$result->fetch_assoc())
			{
				$customerObject=new customer($row["password"]);
				return $customerObject;
			}
		}//if query was a success
		else
		{
			return false;
		}//if query was a failure
	}//end of getPassword

	function updatePassword($condition)
	{
		$connection=$this->getConnection();
		$prepStatement=$connection->prepare("UPDATE customer SET password= ? WHERE customerId = ?");
		$prepStatement->bind_param("ss", $condition,$_SESSION["userId"]);
		$result=$prepStatement->execute();
		if($prepStatement->execute())
		{
			$result = $prepStatement->get_result();
			$customerObject;
			while($row=$result->fetch_assoc())
			{
				$customerObject=new customer($row["password"]);
				return $customerObject;
			}
		}//if query was a success
		else
		{
			return false;
		}//if query was a failure
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
	}

	function getCustomerObject($id)
	{
		echo "the function is entered";
		$connection=$this->getConnection();
		$prepStatement=$connection->prepare("SELECT * FROM customer WHERE customerID = ?");
		$prepStatement->bind_param("s",$id);
		$result=$prepStatement->execute();
		if($prepStatement->execute())
		{
			echo "the if statement passed";
			$result = $prepStatement->get_result();
			$customerObject;
			while($row=$result->fetch_assoc())
			{
				echo "there is a result";
				$customerObject=new customer($row["firstName"],$row["password"],$row["surname"],$row["email"],$row["addressLine1"],$row["addressLine2"],$row["postcode"],$row["postcode"],$row["county"]);
				return $customerObject;
			}
		}//if query was a success
		else
		{
			echo "it failed to get a result";
			return false;
		}//if query was a failure
	}//end of getCustomerObject
	}//end customerDAO
?>

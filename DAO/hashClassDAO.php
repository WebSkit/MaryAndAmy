<?php
	require('../MaryAndAmy/databaseDetails.php');
	
	class CredentialHashDAO
	{
		
		
			function __construct()//attributes value from databaseDetails.php
			{
				$this ->server_name = $GLOBALS["server"];
				$this ->username = $GLOBALS["usernameS"];
				$this -> password = $GLOBALS["passwordS"];
				$this -> database = $GLOBALS["database"];
			}
			
			function getConnection()//making the connection.
			{
				$connection=new mysqli($GLOBALS["server"],$GLOBALS["usernameS"],$GLOBALS["passwordS"],$GLOBALS["database"]);
			if($connection->connect_error)
			{
				die("Failed to establish a connection, please try again later");
			}//if there was a connection error
			return $connection;
			}
			
			function hashPassword($userPassword)
			{
				//creating random salt.
				$hash = password_hash($userPassword,PASSWORD_DEFAULT);
				$salt = substr($hash,7,22);
				
				//storing the variable as array 
				$credential = array($hash,$salt);
				
				return $credential;	//returns an array(the hashed password, the salt used)
				
			}
			
			//inserting the salt value.
			function insertSaltDB($tableName,$hash,$userId)
			{
				$conn = $this->getConnection();
				
				if($conn->query("INSERT INTO ".$tableName."(SValue,userId)"."VALUES('".$hash[1]."',".$userId.")"))
				{
					echo "success";
				}
				else
				{
					echo $conn->error;
				}
				
			}
			
			//inserting the hash password
			function insertPasswordDB($tableName,$hash,$userId)
			{
				$conn = $this->getConnection();
				$query;
				if($tableName=="customer")
				{
					$query="UPDATE ".$tableName." SET password='".$hash[0]."' WHERE customerID=".$userId;
					echo "<br>the query is <br>: ".$query."<br>";
				}
				if($tableName=="admin")
				{
					$query="UPDATE ".$tableName." SET password=".$hash[0]." WHERE adminID=".$userId;
				}
				if($tableName=="baker")
				{
					$query="UPDATE ".$tableName." SET password=".$hash[0]." WHERE bakerID=".$userId;
				}
				if($conn->query($query))
				{
					echo "success";
				}
				else
				{
					echo $conn->error;
				}
				
				
			}
			
			//this can be used for the three salt table.
			//parameters:
				//$IDValue = the session value.
				//$password = password string input
				//$saltvalue = inserted salt value in the database
				//$IDcolumn = the column we want to get.
			function credCheckBaker($IDValue,$password,/*$saltValue,*/$tableName,$IDcolumn)
			{
				
				//password_verify(the password string, stored salt from sql) 
				
				$conn = getConnection();
				
				//$salt = $conn->query("SELECT". $saltValue." FROM".$tableName." WHERE ".$IDcolumn."==".$IDValue.";"); //get from salt database
				$hash = $conn->query("SELECT password FROM".$tableName." WHERE ".$IDcolumn."==".$IDValue.";"); //get from password column in customer/baker/admin table
				//this is the hash value.
				
				
				
				if(password_verify($password, $hash))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			
			
			
			
			
	}
?>

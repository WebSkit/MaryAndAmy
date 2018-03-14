<?php
	require('../MaryAndAmy/databaseDetails.php');
	
	class CredentialHashDAO
	{
		//need to make two methods.
		
		//first will create a hash password. 
			//this method will use salt and cyrpt() to encrypt password. 
			//will return an array with two items/elements.
			//the hashed password and the salt.
			
		//second will check if hashed password is correct for the given user.
			//will return boolean
			//true if match false otherwise.
			//maybe can use a map array or something or str methods.
		
			function __construct()//attributes value from databaseDetails.php
			{
				$this ->server_name = $GLOBALS["server"];
				$this ->username = $GLOBALS["usernameS"];
				$this -> password = $GLOBALS["passwordS"];
				$this -> database = $GLOBALS["database"];
			}
			
			function getConnection()//making the connection.
			{
				$conn = new mysqli($server_name,$username,$password,$database);
				
				if($conn ->connect_error)
				{
					die("Connection Error, try again");
				}
				return $conn;
			}
			
			function hashPassword($userPassword)
			{
				//creating random salt.
				$salt = uniqid(mt_rand(),true);
				
				//hashing the salt.
				$hashSalt = hash('sha2',$salt);
				
				//hashing the password.
				$hashpassword = crypt($userPassword,$hashSalt);
				
				//storing the variable in 
				$credential = array($hashpassword,$hashSalt);
				
				return $credential;	//this is the array that will have the hash and the original salt.
				
			}
			
			function insertPasswordDB($userPassword,$tableName,$tableID,$saltColumn)
			{
				$conn = getConnection();
				$hash = hashPassword($userPassword);
				
				$conn->query("INSERT INTO ".$tableName."(".$saltColumn.")"."VALUES('".$hash[0]."');")
				
				
			}
			
			
			//username here from the database. either sessionID or tableID(3rd column).
			function credCheckBaker($IDValue,$password,$saltValue,$tableName,$IDcolumn)
			{
				
				//password_verify(the password string, stored salt from sql) 
				
				$conn = getConnection();
				$tableHash = $conn->query("SELECT". $saltValue." FROM".$tableName." WHERE ".$IDcolumn."==".$IDValue.";");
				
				
				if(password_verify($password, $tableHash)
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
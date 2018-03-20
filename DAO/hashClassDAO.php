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
			
			//inserting the salt value.
			function insertSaltDB($userPassword,$tableName,$tableID,$saltColumn)
			{
				$conn = getConnection();
				$hash = hashPassword($userPassword);
				
				$conn->query("INSERT INTO ".$tableName."(".$saltColumn.")"."VALUES('".$hash[1]."');");
				
			}
			
			//inserting the hash password
			function insertPasswordDB($userPassword,$tableName,$passwordColumn)
			{
				$conn = getConnection();
				$hash = hashPassword($userPassword);
				
				$conn->query("INSERT INTO ".$tableName."(".$passwordColumn.")"."VALUES('".$hash[0]."');");
				
			}
			
			//this can be used with three salt table.
			//username here from the database. either sessionID or tableID(3rd column).
			function credCheckBaker($IDValue,$password,$saltValue,$tableName,$IDcolumn)
			{
				//$IDValue is the actual of session ID.
				//$IDcolumn is the auto increment. 
				//password_verify(the password string, stored salt from sql) 
				
				$conn = getConnection();
				
				$salt = $conn->query("SELECT". $saltValue." FROM".$tableName." WHERE ".$IDcolumn."==".$IDValue.";"); //get from salt database
				$hash = $conn->query("SELECT password FROM".$tableName." WHERE ".$IDcolumn."==".$IDValue.";"); //get from password column.
				
				
				
				if(password_verify($hash, $salt)
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

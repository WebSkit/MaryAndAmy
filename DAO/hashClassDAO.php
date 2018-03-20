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
				$hash = password_hash($userPassword,PASSWORD_DEFAULT);
				$salt = substr($hash,7,22);
				
				//storing the variable as array 
				$credential = array($hash,$salt);
				
				return $credential;	//returns an array(the hashed password, the salt used)
				
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
				
				
				
				if(password_verify($password, $hash)
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

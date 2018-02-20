<?php

	require('../MaryAndAmy/databaseDetails.php');
	
	
	class MapDAO
	{
		//attributes
		var $server_name;
		var $username;
		var $password;
		var $database;
		
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
			
			
	}

?>
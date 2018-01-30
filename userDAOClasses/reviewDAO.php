<?php
	
	session_start();
	$_SESSION["review_id"] = 1;//auto increment
	require('../MaryAndAmy/databaseDetails.php');
	
	class reviewDAO
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
			
			
			//method to populate review table.
			function insertComment($comment, $rating)
			{
				if(ifOrderComplete($jobID)==true)
				{
					$conn = getConnection();
					$query = $conn->prepare("INSERT INTO review(job_id,description, rating,date)
					VALUES(?,?,?,?)");
					
					$IDjob = getJobID($jobID);
					$currentDate = date("Y-m-d H:i:s");
					
					$prep_statement->bind_param("ssss",$IDjob,$comment,$rating,$currentDate);
					
					if($prep_statement->execute())
					{
						return true;
					}
				}
				
			return false;
			
			}
			
			//to check if order is completed,
			
			
			//getting jobID from job table
			function getJobID($jobID)
			{
				$conn = getConnection();
				$result = $conn->query("SELECT * FROM job WHERE job_id ==" .$jobID);
				return $result;
			}
			
			//false if < 0; true otherwise.
			//method to use for if statement.
			function ifOrderComplete($jobid)
			{
				$conn = getConnection();
				$jobID = getJobID($jobid);
				
				$result = $conn->query("SELECT is_complete FROM job WHERE job_id ==" .$jobID);
				
				if($result > 0)
				{
					return true;
				}
				
				return false;
				
			}
			
			
	}
?>
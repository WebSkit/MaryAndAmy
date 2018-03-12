<?php

	session_start();
	$_SESSION["review_id"] = 1;//auto increment
	require('../MaryAndAmy/databaseDetails.php');

	class reviewDAO
	{
		//attributes
		var $serverName;
		var $username;
		var $password;
		var $database;

			function __construct()//attributes value from databaseDetails.php
			{
				$this ->serverName = $GLOBALS["server"];
				$this ->username = $GLOBALS["usernameS"];
				$this ->password = $GLOBALS["passwordS"];
				$this ->database = $GLOBALS["database"];
			}

			function getConnection()//making the connection.
			{
				$conn = new mysqli($serverName,$username,$password,$database);

				if($conn ->connect_error)
				{
					die("Connection Error, try again");
				}
				return $conn;
			}


			//method to populate review table.
			function insertComment($comment, $rating)
			{
				while(ifOrderComplete($jobID) != false)
				{
					$conn = getConnection();
					$query = $conn->prepare("INSERT INTO review(jobID,description, rating, date)
					VALUES(?,?,?,?)");

					$jobID = getJobID($jobID);
					$currentDate = date("d-m-Y H:i:s");

					$prepStatement->bind_param("ssss",$jobID,$comment,$rating,$currentDate);

					if($prepStatement->execute())
					{
						return true;
					}
				}

			return false;

			}

			//to check if order is completed,

			//false if < 0; true otherwise.
			//method to use for if statement.
			function ifOrderComplete()
			{
				$conn = getConnection();
				$jobID = $conn->query("SELECT * FROM job WHERE jobID ==" .$jobID);

				$result = $conn->query("SELECT isComplete FROM job WHERE jobID ==" .$jobID);

				if($result > 0)
				{
					return true;
				}

				return false;

			}


	}
?>

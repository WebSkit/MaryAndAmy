<?php
	require("../MaryAndAmy/googleMapsAPIKey.php");//go up a level, then find the file
	require('../MaryAndAmy/databaseDetails.php');

	class shopFinder{
		var $apiKey;
		function __construct()
		{
			$this->apiKey=$GLOBALS["mapsAPIKey"];
		}//constructor
		function getConnection()
		{
			$connection=new mysqli($GLOBALS["server"],$GLOBALS["usernameS"],$GLOBALS["passwordS"],$GLOBALS["database"]);
			if($connection->connect_error)
			{
				die("Failed to establish a connection, please try again later");
			}//if there was a connection error
			return $connection;
		}
		function findValidShops($userPostCode,$userAcceptedDistance)
		{
			if(is_numeric($userAcceptedDistance)==false)
			{
				return false;
			}
			$validCompaniesArray=array();
			$tempCount=0;//used to place items into the associative array without overwriting each other
			$query="SELECT * FROM bakers";
			$connection=$this->getConnection();
			$result=$connection->query($query);
			while($row=$result->fetch_assoc())
			{
			
				$url="https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($userPostCode)."&destinations=".urlencode($row["postCode"])."&key=".urlencode($this->apiKey);
				$JSONDistance=file_get_contents($url);//the data is sent to this google page
				$arrayDistance=json_decode($JSONDistance,true);//true=is associative array
				
				$distance=substr($arrayDistance["rows"][0]["elements"][0]["distance"]["text"],0,-3);//NOTE:gets the string, minus the last 3 characters(the space and the letters "mi"
				//"[row][0][elements][0][distance][text]"=the location of the distance(miles) in the array
			
				if($distance<=$userAcceptedDistance && $distance<=$row["servedArea"])
				{
					$validCompaniesArray[$tempCount]=array("id"=>$row["bakerId"],"companyName"=>$row["companyName"],"addressLine1"=>$row["addressLine1"],"addressLine2"=>$row["addressLine2"],"postCode"=>$row["postCode"]);
					$tempCount=$tempCount+1;
				}//if the distance between the baker and customer is acceptable for both
				//var_dump($JSONDistance);
			}//while there is an item in the returned results
			
			return $validCompaniesArray;
		}//end findValidShops
	}//shopFinder class




?>
<?php
	require("../MaryAndAmy/googleMapsAPIKey.php");//go up a level, then find the file
	require('../MaryAndAmy/databaseDetails.php');

	class ShopFinder{
		var $api_key;
		function __construct()
		{
			$this->api_key=$GLOBALS["mapsAPIKey"];
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
		function findValidShops($user_postcode,$user_accepted_distance)
		{
			if(is_numeric($user_accepted_distance)==false)
			{
				return false;
			}
			$valid_companies=array();
			$temp_count=0;//used to place items into the associative array without overwriting each other
			$query="SELECT * FROM bakers";
			$connection=$this->getConnection();
			$result=$connection->query($query);
			while($row=$result->fetch_assoc())
			{

				$url="https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($user_postcode)."&destinations=".urlencode($row["postcode"])."&key=".urlencode($this->api_key);
				$json_distance=file_get_contents($url);//the data is sent to this google page
				$array_distance=json_decode($json_distance,true);//true=is associative array

				$distance=substr($array_distance["rows"][0]["elements"][0]["distance"]["text"],0,-3);//NOTE:gets the string, minus the last 3 characters(the space and the letters "mi"
				//"[row][0][elements][0][distance][text]"=the location of the distance(miles) in the array
				//distance between the customer and the baker
				if($distance<=$user_accepted_distance && $distance<=$row["served_area"])
				{
					$query="SELECT AVG(rating) AS average FROM product INNER JOIN review ON product.product_id WHERE baker_id=".$row["baker_id"];

					$result_review=$connection->query($query);//finding the average review score
					$review_average="No Reviews";//default value if a baker has no reviews
					echo $result_review->num_rows;

					$row_review=$result_review->fetch_assoc();

					echo "the review score =".$row_review["average"]."<br>";
					if($row_review["average"]==null)
					{
						echo "null entered";
						$review_average="No Reviews";
						echo "review_average value=".$review_average;
					}
					else
					{
						echo "its not null entered";
						$review_average=$row_review["average"];
					}
					$valid_companies[$temp_count]=array("id"=>$row["baker_id"],"company_name"=>$row["company_name"],"address_line1"=>$row["address_line1"],"address_line2"=>$row["address_line2"],"postcode"=>$row["postcode"], "distance"=>$distance,"review_score"=>$review_average);
					$temp_count=$temp_count+1;
				}//if the distance between the baker and customer is acceptable for both
			}//while there is an item in the returned results

			return $valid_companies;
		}//end findValidShops
	}//shopFinder class
//ratings, distance from the shopper's postcode, and the services done by the shop



?>

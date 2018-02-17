<?php
	
	$requiredAddress=realpath(dirname(__FILE__).'\..\databaseDetails.php');
	require($requiredAddress);
	class reviewsDAO{
		function __construct()
		{
		}//constructor
		function getConnection()
		{
			$connection=new mysqli($GLOBALS["server"],$GLOBALS["usernameS"],$GLOBALS["passwordS"],$GLOBALS["database"]);
			if($connection->connect_error)
			{
				die("Failed to establish a connection, please try again later");
			}//if there was a connection error
			return $connection;
		}//end getConnection
		
		function getReviews($bakerId)
		{
			//not using prepared statement as the bakerId is never chosen by the user, please tell me if there is anything I may have missed
			$connection=$this->getConnection();
			$query="SELECT * FROM review AS r JOIN job AS j JOIN product AS p JOIN customer c WHERE j.bakerId=".$bakerId." AND j.customerId=c.customerId AND r.jobId=j.jobId AND p.bakerID=j.bakerId AND j.productId=p.productId";
						//$query="SELECT * FROM review AS r JOIN job AS j JOIN product AS p JOIN customer c WHERE j.bakerId=".$bakerId." AND j.customerId=c.customerId AND r.jobId=j.jobId AND p.bakerID=j.bakerId";
						//if I(or anyone else) can make this query more efficient, then feel free to try and change it(as of 3/2/18)
			/*the three WHERE conditions
				1.Only to allow bakers to see there own reviews
				2.to make sure customers who have made jobs will have review results returned
				3.to make sure that those with jobs, will only be attributed with there own reviews/jobs and not everyone elses
				4.if there are reviews for more than one baker, then prevent repeats of the same review
				5.If the baker has multiple cakes each having at least one review, this stops the review being attributed to every customer
			*/
			if($result=$connection->query($query))
			{
				echo "success";
			}
			else
			{
				echo $connection->error;
			}
			$reviewsArray=array();
			$tempCount=0;
			if($result->num_rows>0)
			{
				echo "row num= ".$result->num_rows;
				while($row=$result->fetch_assoc())
				{
					//var_dump($row);
					echo "<br>";
					$reviewsArray[$tempCount]=array("reviewId"=>$row["reviewID"],"jobId"=>$row["jobID"],"review"=>$row["review"],"rating"=>$row["rating"],"date"=>$row["date"],"productDescription"=>$row["description"],"customerName"=>$row["firstName"], "flagged"=>$row["flagged"]);
					$tempCount++;
				}//while item in result object
				return $reviewsArray;
			}//if there is data about reviews
			else
			{
				return null;
			}//if no data, return null
		}//end getReviews
		
		function flagReview($reviewId,$bakerId)
		{
			if(is_numeric($reviewId) && is_numeric($bakerId))
			{
				$connection=$this->getConnection();
				$query="SELECT r.reviewId,j.bakerId FROM review AS r JOIN job AS j WHERE r.reviewId=? AND j.bakerId=? AND r.jobId=j.jobId";//search for the given review with the given bakerId
				$prepStatement=$connection->prepare($query);
				$prepStatement->bind_param("ss",$reviewId,$bakerId);
				if($prepStatement->execute())
				{
					$tempVariable;
					$result=$prepStatement->get_result();
					$numRows=$result->num_rows;
					
					
					if($numRows>0)
					{
						$queryInsert="UPDATE review SET flagged=true WHERE reviewId=?";
						$prepStatement=$connection->prepare($queryInsert);
						$prepStatement->bind_param("s",$reviewId);
						if($prepStatement->execute())
						{
							return true;
						}//if the update statement executed/if the review was flagged
						else
						{
							return false;
						}
					}//if the review is about the baker
					else
					{
						return false; //"count: ".$result->num_rows;
					}//if no rows, return false
				}
			}//if both of these values are numbers(just in case someone tried to mess with the html)
			else
			{
				return false;
			}//if they are not both numbers
		}//end flagReview
	}//end reviewsDAO class


?>
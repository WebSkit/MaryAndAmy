<?php
//$requiredAddress="../databaseDetails.php";
$requiredAddress=realpath(dirname(__FILE__).'\..\databaseDetails.php');
	require($requiredAddress);
	class chatDAO{
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
		function getRecieverId($senderId,$accountType,$conversationId)
		{
			$query;
			$connection=$this->getConnection();
			if($accountType=="baker")
			{
				$prepStatement=$connection->prepare("SELECT * FROM chat WHERE conversationId=? AND bakerId=?");
				$prepStatement->bind_param("ss",$conversationId,$senderId);
				$prepStatement->execute();
				$result=$prepStatement->get_result();

				$num_rows=$result->num_rows;
				
				if($num_rows==0)
				{
					return false;
				}//if the conversation does not belong to this baker, then stop the request
				else
				{
					while($row=$result->fetch_assoc())
					{
						return $row["customerID"];
						break;
					}
				}//if data was found
				
				
			}
			elseif($accountType=="customer")
			{
				$prepStatement=$connection->prepare("SELECT * FROM chat WHERE conversationId=? AND customerId=?");
				$prepStatement->bind_param("ss",$conversationId,$senderId);
				$prepStatement->execute();
				$result=$prepStatement->get_result();

				$num_rows=$result->num_rows;
				
				if($num_rows==0)
				{
					return false;
				}//if the conversation does not belong to this customer, then stop the request
				else
				{
					while($row=$result->fetch_assoc())
					{
						return $row["bakerID"];
						break;
					}
				}//if data was found
				
			}
			else
			{
				return false;
			}//else if some other error occurs
		}//getRecieverId
		function sendMessage($senderId,$receiverId,$message,$conversationId)
		{
			$messageType=null;//determines who the sender and receiver are
			
			if($_SESSION["accountType"]=="baker")
			{
				$messageType="BTC";//Baker To Customer
			}//if sender is baker
			elseif($_SESSION["accountType"]=="customer")
			{
				$messageType="CTB";//Customer To Baker
			}//if sender is customer
			else
			{
				$messageType=null;
			}//if neither is the sender(if some error occurs)
			
			if($_SESSION["accountType"]=="baker")
			{
				$connection=$this->getConnection();
				$prepStatement=$connection->prepare("SELECT * FROM chat WHERE conversationId=? AND bakerId=?");
				$prepStatement->bind_param("ss",$conversationId,$senderId);
				$prepStatement->execute();
				$result=$prepStatement->get_result();
				$num_rows=$result->num_rows;
				
				if($num_rows==0)
				{
					return false;
				}//if the conversation does not belong to this baker, then stop the message being sent
			}//if you are a baker, check that you are in the correct conversation
			
			if($_SESSION["accountType"]=="customer")
			{
				$connection=$this->getConnection();
				$prepStatement=$connection->prepare("SELECT * FROM chat WHERE conversationId=? AND customerId=?");
				$prepStatement->bind_param("ss",$conversationId,$senderId);
				$prepStatement->execute();
				$result=$prepStatement->get_result();

				$num_rows=$result->num_rows;
				
				if($num_rows==0)
				{
					return false;
				}//if the conversation does not belong to this customer, then stop the message being sent
			}//if you are a baker, check that you are in the correct conversation
			
			/*-----------------------------above, prevents sending messages in conversations you are not in-------------*/
			
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("INSERT INTO chat(chatType,bakerId,customerId,chatlog,conversationId) VALUES(?,?,?,?,?)");
			if($messageType=="BTC")
			{
				$prepStatement->bind_param("sssss",$messageType,$senderId,$receiverId,$message,$conversationId);
			}//if sender is baker
			elseif($messageType=="CTB")
			{
				$prepStatement->bind_param("sssss",$messageType,$receiverId,$senderId,$message,$conversationId);
			}//if sender is customer
			else
			{
				return false;
			}//if some error occurs
			
			$result=$prepStatement->execute();
			
			if($result)
			{
				return true;
			}//if message was successfully sent
			else
			{
				return false;
			}//if it failed to be sent
		}//sendMessage
		
		function refreshMessageBoard($conversationId,$userId,$accountType)
		{
			$query;
			if($accountType=="baker")
			{
				$query="SELECT * FROM chat c JOIN baker b JOIN customer cu WHERE c.conversationId=? AND c.bakerId=? AND c.bakerId=b.bakerId AND c.customerId=cu.customerId AND IF(c.chatType='CTB',c.customerId=cu.customerId,c.bakerId=b.bakerId)";
				//get data with a given conversation and bakerId
				//and get data on customer if the message was sent by the customer, and get data from the baker if data was sent from the baker
			}//if a baker is the current user
			elseif($accountType=="customer")
			{
				$query="SELECT * FROM chat c JOIN baker b JOIN customer cu WHERE c.conversationId=? AND c.customerId=? AND c.bakerId=b.bakerId AND c.customerId=cu.customerId AND IF(c.chatType='CTB',c.customerId=cu.customerId,c.bakerId=b.bakerId)";
				//get data with a given conversation and bakerId
				//and get data on customer if the message was sent by the customer, and get data from the baker if data was sent from the baker
			
			}//if the customer is the current user
			else
			{
				return false;
			}//if the account type is malformed
			$connection=$this->getConnection();
			if($connection->error)
			{
				return false;
				//die($connection->error);
			}//if a connection fails to be established
			$prepStatement=$connection->prepare($query);
			$prepStatement->bind_param("ss",$conversationId,$userId);
			if($prepStatement->execute())
			{
				
				
				$result=$prepStatement->get_result();//getting the result of a prepared statement
				
				$chatLogArray=array();//store relevant data
				$tempCount=0;//the entry count
				while($row=$result->fetch_assoc())
				{
					//var_dump($row);
					if($row["chatType"]=="CTB")
					{
						$chatlogArray[$tempCount]=array("chatType"=>$row["chatType"], "firstName"=>$row["firstName"],"surname"=>$row["surname"],"message"=>$row["chatLog"]);
						//echo $row["firstName"]." ".$row["surname"].":".$row["chatLog"];
					}//if customer sent the message
					else
					{
						$chatlogArray[$tempCount]=array("chatType"=>$row["chatType"], "contactName"=>$row["contactName"],"companyName"=>$row["companyName"],"message"=>$row["chatLog"]);

						//echo $row["contactName"]." (".$row["companyName"]."):".$row["chatLog"];

					}//if the baker sent the message
					$tempCount++;
				}//while results from the query remain
				return $chatlogArray;
			
			}//if query successfully executes
			else
			{
				return false;
			}//if the query failed to execute
		}//refreshMessageBoard
		
		function createConversation($bakerId,$customerId)
		{
			$conversationCount;
			$conversationCountQuery="SELECT COUNT( DISTINCT conversationId) AS conversationCount FROM chat";
			$connection=$this->getConnection();
			$result=$connection->query($conversationCountQuery);
			while($row=$result->fetch_assoc())
			{
				$conversationCount=$row["conversationCount"];
			}//gettting the query results
			
			$conversationId=$conversationCount+1;//next conversationId is one higher than the number of conversations
			$query="INSERT INTO chat(chatType,bakerId,customerId,chatLog,conversationId) VALUES(?,?,?,?,?)";
			
			$prepStatement=$connection->prepare($query);
			$chatType="BTC";
			$chatLog="Welcome to the message board, please feel free to send a message";
			$prepStatement->bind_param("sssss",$chatType,$bakerId,$customerId,$chatLog,$conversationId);
			if($prepStatement->execute())
			{
				return true;//if query executed successfully
			}//if it successfully executed
				
			return false;//returns false by default, only gets here if the query failed
			
		}//end createConversation method


	}//end chatDAO
?>
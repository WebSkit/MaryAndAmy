<?php
session_start();

require("chat.php");

$conversationId=$_POST["conversationId"];
$chatDAO=new chatDAO();
//function sendMessage($senderId,$receiverId,$message,$conversationId)
//		function getRecieverId($senderId,$accountType,$conversationId)

$receiverId=$chatDAO->getRecieverId($_SESSION["userId"],$_SESSION["accountType"],$conversationId);
if($receiverId==false)
{
	echo false;//"no recieaver id".$conversationId."(convId and ".$_SESSION["userId"]."(userId) AND  ".$_SESSION["accountType"];
}
else
{
	$sendMessageResult=$chatDAO->sendMessage($_SESSION["userId"],$receiverId,$_POST["message"],$conversationId);
	if($sendMessageResult==true)
	{
		echo true;
	}
	else
	{
		echo false;
	}
	//echo $sendMessageResult;//returns true or false depending on if the message was sent
}


?>
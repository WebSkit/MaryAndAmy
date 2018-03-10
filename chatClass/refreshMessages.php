<?php
		//function refreshMessageBoard($conversationId,$userId,$accountType)

session_start();

require("chat.php");

$conversationId=$_POST["conversationId"];
$chatDAO=new chatDAO();

$chatResults=$chatDAO->refreshMessageBoard($conversationId,$_SESSION["userId"],$_SESSION["accountType"]);

if($chatResults!=false)
{
	$chatSize=sizeOf($chatResults);
	$htmlCode="";
			for($i=0;$i<$chatSize;$i++)
			{
				if($chatResults[$i]["chatType"]=="CTB")
				{
					$htmlCode.="<div class=customerMessage>".$chatResults[$i]["firstName"]." ".$chatResults[$i]["surname"]." : ".$chatResults[$i]["message"]."</div><br>";
				}//if customer sent message
				elseif($chatResults[$i]["chatType"]=="BTC")
				{
					$htmlCode.="<div class=bakerMessage>".$chatResults[$i]["contactName"]."(".$chatResults[$i]["companyName"].") : ".$chatResults[$i]["message"]."</div><br>";

				}//if baker sent message
				
			}//for each chat messaeg in array
			
	echo $htmlCode;//return the html formatted chat messages
}
else
{
	echo false;
}


?>
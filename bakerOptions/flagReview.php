<?php
session_start();
	//$requiredAddress=realpath(dirname(__FILE__).'\..\databaseDetails.php');

//$requiredAddress=realpath(dirname(__FILE__)."..\DAO\shopFinder.php");//."\DAO\reviewsDAO.php");
$requiredAddress="..\DAO\reviewsDAO.php";//."\DAO\reviewsDAO.php");


require("../DAO/reviewsDAO.php");

$reviewDAO=new reviewsDAO();

$result=$reviewDAO->flagReview($_POST["reviewId"],$_SESSION["userId"]);
echo $result;
//echo "hello world ".$result ;



?>
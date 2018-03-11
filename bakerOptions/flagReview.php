<?php
session_start();

require("../DAO/reviewsDAO.php");

$reviewDAO=new reviewsDAO();

$result=$reviewDAO->flagReview($_POST["reviewId"],$_SESSION["userId"]);
echo $result;

?>

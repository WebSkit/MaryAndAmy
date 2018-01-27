<?php
	session_start();
	$_SESSION["baker_id"]=1;//this is only testing will need to change it later
	require('../MaryAndAmy/databaseDetails.php');
	require("../MaryAndAmy/userClasses/Baker.php");//go up a level, then find the file
	class BakerDAO
	{
		var $server_name;
		var $username;
		var $password;
		var $database;
		function __construct()
		{
			$this->server_name=$GLOBALS["server"];
			$this->username=$GLOBALS["usernameS"];
			$this->password=$GLOBALS["passwordS"];
			$this->database=$GLOBALS["database"];
		}//end constructor

		function getConnection()
		{
			$connection = new mysqli($this->server_name, $this->username, $this->password, $this->database);
			if($connection->connect_error)
			{
				die("Failed to establish a connection, please try again later");
			}//if there was a connection error
			return $connection;
		}//end getConnection

		function createBaker($new_baker)
		{
			$connection=$this->getConnection();
			$prep_statement=$connection->prepare("INSERT INTO baker (company_name,password,address_line1,address_line2,county,postcode,picture_count,is_approved,
				served_area,logo,website,shop_phone_number,business_type,min_notice_time,admin_name,admin_email,contact_name,contact_email,facebook_page)
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

			$company_name=$new_baker->getName();
			$password=$new_baker->getPassword();
			$email=$new_baker->getEmail();
			$address_line1=$new_baker->getAddressLine1();
			$address_line2=$new_baker->getAddressLine2();
			$county=$new_baker->getCounty();
			$postcode=$new_baker->getPostCode();
			$picture_count=$new_baker->getPictureCount();
			$is_approved=$new_baker->getIsApproved();
			$served_area=$new_baker->getServedArea();
			$logo="hhh";
			$website="ddd";
			$shop_phone_number="0161";
			$business_type="birthday cakes";
			$min_notice_time="5";
			$admin_name="MAry";
			$admin_email="hello@gmail.com";
			$contact_name="Amy";
			$contact_email="amy@mary.com";
			$facebook_page="facebook.com";

			$prep_statement->bind_param("sssssssssssssssssss",$company_name,$password,$address_line1,$address_line2,$county,$postcode,$picture_count,$is_approved,
				$served_area,$logo,$website,$shop_phone_number,$business_type,$min_notice_time,$admin_name,$admin_email,$contact_name,$contact_email,$facebook_page);
			if($prep_statement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure

		function updateBaker($new_baker)
		{
			$connection=$this->getConnection();
			$prep_statement=$connection->prepare("UPDATE bakers SET company_name=?,password=?,email=?,address_line1=?,address_line2=?,postcode=?,county=?,picture_count=?,is_approved=?,served_area=? WHERE baker_id=?;");

			$id=$_SESSION["baker_id"];
			$company_name=$new_baker->getName();
			$password=$new_baker->getPassword();
			$email=$new_baker->getEmail();
			$address_line1=$new_baker->getAddressLine1();
			$address_line2=$new_baker->getAddressLine2();
			$postcode=$new_baker->getPostCode();
			$county=$new_baker->getCounty();
			$picture_count=$new_baker->getPictureCount();
			$is_approved=$new_baker->getIsApproved();
			$served_area=$new_baker->getServedArea();

			$prep_statement->bind_param("sssssssssss",$company_name,$password,$email,$address_line1,$address_line2,$postcode,$county,$picture_count,$is_approved,$served_area,$id);
			if($prep_statement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure

		}//end createCustomer
		}//end createCustomer
	}//end customerDAO
?>

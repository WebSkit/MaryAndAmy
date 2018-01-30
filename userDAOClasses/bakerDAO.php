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
		}//end createCustomer
		
		function updateBaker($newBakerObject)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("UPDATE bakers SET companyName=?,password=?, email=?,addressLine1=?,addressLine2=?,postCode=?,county=?,	pictureCount=?,isApproved=?,servedArea=?, logo=?, website=?, shopPhoneNumber=?, buisnessType=?, minNoticeTime=?, adminName=?, adminEmail=?, contactName=?, contactEmail=?, facebookPage=? WHERE bakerId=?;");
			
			$id=$_SESSION["bakerId"];
			$companyName=$newBakerObject->getName();
			$passwordUser=$newBakerObject->getPassword();
			$email=$newBakerObject->getEmail();
			$addressLine1=$newBakerObject->getAddressLine1();
			$addressLine2=$newBakerObject->getAddressLine2();
			$postCode=$newBakerObject->getPostCode();
			$county=$newBakerObject->getCounty();
			$pictureCount=$newBakerObject->getPictureCount();
			$isApproved=$newBakerObject->getIsApproved();
			$servedArea=$newBakerObject->getServedArea();
			
			$logo=$newBakerObject->getLogo();
			$website==$newBakerObject->getWebsite();
			$shopPhoneNumber=$newBakerObject->getShopePhoneNumber();
			$buisnessType=$newBakerObject->getBuisnessType();
			$minNoticeTime=$newBakerObject->getMinNoticeTime();
			$adminName=$newBakerObject->getAdminName();
			$adminEmail=$newBakerObject->getAdminEmail();
			$contactName=$newBakerObject->getContactName();
			$contactEmail=$newBakerObject->getContactEmail();
			$facebookPage==$newBakerObject->getFacebookPage();
			
			$prepStatement->bind_param("sssssssssssssssssssss",$companyName,$passwordUser,$email,$addressLine1,$addressLine2,$postCode,$county,$pictureCount,$isApproved,$servedArea,$logo,$website,$shopPhoneNumber,$buisnessType,$minNoticeTime,$adminName,$adminEmail,$contactName,$contactEmail,$facebookPage,$id);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure	
		}//end updateCustomer
		
		function deleteBaker($bakerNumber)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("DELETE FROM bakers WHERE bakerId = ?;");
			
			$prepStatement->bind_param("s", $bakerNumber);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end deleteBaker
		
		function selectBaker($type,$condition)
		{
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("SELECT * FROM bakers WHERE ? = ?");
			$prepStatement->bind_param("ss", $type,$condition);
			$result=$prepStatement->execute();
			if($prepStatement->execute())
			{
				return $result;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end of selectBaker
		
	}//end customerDAO
?>

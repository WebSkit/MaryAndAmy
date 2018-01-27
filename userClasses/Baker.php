<?php
require("userClasses/User.php");//newBakers parent class

	class Baker extends User{
		var $surname;
		var $email;
		var $address_line1;
		var $address_line2;
		var $postcode;
		var $country;
		var $pictureCount;
		var $isApproved;
		var $served_area;

		function __construct($company_name,$password,$email,$address_line1,$address_line2,$postcode,$county,$pictureCount,$isApproved,$served_area)
		{
			parent::__construct($company_name,$password);//calls parent constructor
			$this->setEmail($email);
			$this->setAddressLine1($address_line1);
			$this->setAddressLine2($address_line2);
			$this->setPostCode($postcode);
			$this->setCounty($county);
			$this->setPictureCount($pictureCount);
			$this->setIsApproved($isApproved);
			$this->setServedArea($served_area);
		}//end constructor



		function setEmail($email)
		{
			$this->email=$email;
		}//setEmail
		function getEmail()
		{
			return $this->email;
		}//getEmail

		function setAddressLine1($address_line1)
		{
			$this->address_line1=$address_line1;
		}//setAddressLine1
		function getAddressLine1()
		{
			return $this->address_line1;
		}//setAddressLine1

		function setAddressLine2($address_line2)
		{
			$this->address_line2=$address_line2;
		}//setAddressLine2
		function getAddressLine2()
		{
			return $this->address_line2;
		}//getAddressLine2

		function setPostCode($postcode)
		{
			$this->postcode=$postcode;
		}//setPostCode
		function getPostCode()
		{
			return $this->postcode;
		}//getPostCode

		function setCounty($county)
		{
			$this->county=$county;
		}//setCountry
		function getCounty()
		{
			return $this->county;
		}//getCountry

		function setPictureCount($pictureCount)
		{
			$this->pictureCount=$pictureCount;
		}//setPictureCount
		function getPictureCount()
		{
			return $this->pictureCount;
		}//getPictureCount

		function setIsApproved($isApproved)
		{
			$this->isApproved=$isApproved;
		}//setIsApproved
		function getIsApproved()
		{
			return $this->isApproved;
		}//getIsApproved

		function setServedArea($served_area)
		{
			$this->served_area=$served_area;
		}//setServedArea
		function getServedArea()
		{
			return $this->served_area;
		}//getServedArea

	}//end newBaker

?>

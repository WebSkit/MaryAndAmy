<?php
require("userClasses/newUser.php");//newBakers parent class

	class newBaker extends newUser{
		var $surname;
		var $email;
		var $addressLine1;
		var $addressLine2;
		var $postCode;
		var $country;
		var $pictureCount;
		var $isApproved;
		var $servedArea;

		function __construct($companyName,$password,$email,$addressLine1,$addressLine2,$postCode,$county,$pictureCount,$isApproved,$servedArea)
		{
			parent::__construct($companyName,$password);//calls parent constructor
			$this->setEmail($email);
			$this->setAddressLine1($addressLine1);
			$this->setAddressLine2($addressLine2);
			$this->setPostCode($postCode);
			$this->setCounty($county);
			$this->setPictureCount($pictureCount);
			$this->setIsApproved($isApproved);
			$this->setServedArea($servedArea);
		}//end constructor



		function setEmail($email)
		{
			$this->email=$email;
		}//setEmail
		function getEmail()
		{
			return $this->email;
		}//getEmail

		function setAddressLine1($addressLine1)
		{
			$this->addressLine1=$addressLine1;
		}//setAddressLine1
		function getAddressLine1()
		{
			return $this->addressLine1;
		}//setAddressLine1

		function setAddressLine2($addressLine2)
		{
			$this->addressLine2=$addressLine2;
		}//setAddressLine2
		function getAddressLine2()
		{
			return $this->addressLine2;
		}//getAddressLine2

		function setPostCode($postCode)
		{
			$this->postCode=$postCode;
		}//setPostCode
		function getPostCode()
		{
			return $this->postCode;
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

		function setServedArea($servedArea)
		{
			$this->servedArea=$servedArea;
		}//setServedArea
		function getServedArea()
		{
			return $this->servedArea;
		}//getServedArea

	}//end newBaker

?>

<?php
	require("userClasses/newUser.php");//newCustomers parent class

	class newCustomer extends newUser{
		var $surname;
		var $email;
		var $addressLine1;
		var $addressLine2;
		var $postCode;
		var $county;
		
		function __construct($name,$password,$surname,$email,$addressLine1,$addressLine2,$postCode,$county)
		{
			parent::__construct($name,$password);//calls parent constructor
			$this->setSurname($surname);
			$this->setEmail($email);
			$this->setAddressLine1($addressLine1);
			$this->setAddressLine2($addressLine2);
			$this->setPostCode($postCode);
			$this->setCounty($county);
		}//end constructor
		
		function setSurname($surname)
		{
			$this->surname=$surname;
		}//setSurname
		function getSurname()
		{
			return $this->surname;
		}//getSurname
	
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
	
	}//end newCustomer

?>
<?php
	require("userClasses/User.php");//newCustomers parent class

	class Customer extends User{
		var $surname;
		var $email;
		var $addressLine1;
		var $addressLine2;
		var $county;
		var $postcode;

		function __construct($firstName,$password,$surname,$email,$addressLine1,$addressLine2,$county,$postcode)
		{
			parent::__construct($firstName,$password);//calls parent constructor
			$this->setSurname($surname);
			$this->setEmail($email);
			$this->setAddressLine1($addressLine1);
			$this->setAddressLine2($addressLine2);
			$this->setCounty($county);
			$this->setPostCode($postcode);
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

		function setCounty($county)
		{
			$this->county=$county;
		}//setCountry
		function getCounty()
		{
			return $this->county;
		}//getCounty

		function setPostcode($postcode)
		{
			$this->postcode=$postcode;
		}//setPostCode
		function getPostcode()
		{
			return $this->postcode;
		}//getPostcode

	}//end Customer class

?>

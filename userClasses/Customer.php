<?php
	require("userClasses/User.php");//newCustomers parent class

	class Customer extends User{
		var $surname;
		var $email;
		var $address_line1;
		var $address_line2;
		var $postcode;
		var $county;

		function __construct($name,$password,$surname,$email,$address_line1,$address_line2,$county,$postcode)
		{
			parent::__construct($name,$password);//calls parent constructor
			$this->setSurname($surname);
			$this->setEmail($email);
			$this->setAddressLine1($address_line1);
			$this->setAddressLine2($address_line2);
			$this->setPostCode($postcode);
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

	}//end newCustomer

?>

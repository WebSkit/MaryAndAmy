<?php
require("userClasses/newUser.php");//newBakers parent class

	class newAdmin extends newUser{
		var $email;
		var $phoneNumber;
		
		function __construct($userName,$password,$email,$phoneNumber)
		{
			parent::__construct($userName,$password);//calls parent constructor
			$this->setEmail($email);
			$this->setPhoneNumber($phone);
		}//end of constructor
		
		function setEmail(£email)
		{
			$this->email=$email;
		}//end of setEmail
		
		function getEmail()
		{
			return $this->email;
		}//end of getEmail
		
		function setPhoneNumber(£phone)
		{
			$this->phone=$phone;
		}//end of setPhoneNumber
		
		function getPhoneNumber()
		{
			return $this->phone;
		}//end of end of getPhoneNumber
	}//end of newAdmin
<?php
	class newUser{
		var $name;//both username and actual name(the former for admins)
		var $password;
		function __construct($name,$password)
		{
			$this->setName($name);
			$this->setPassword($password);
		}//end constructor
		
		function setName($name)
		{
			$this->name=$name;
		}//setName
		function getName()
		{
			return $this->name;
		}//getName
		
		function setPassword($password)
		{
			$this->password=$password;
		}//setPassword
		function getPassword()
		{
			return $this->password;
		}
	}//end newUserClass

?>
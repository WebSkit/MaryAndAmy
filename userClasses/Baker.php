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
		var $logo;
		var $website;
		var $shopPhoneNumber;
		var $buisnessType;
		var $minNoticeTime;
		var $adminName;
		var $adminEmail;
		var $contactName;
		var $contactEmail;
		var $facebookPage;
		
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
		
		
		function setLogo($logo)
		{
			$this->logo=$logo;
		}//getLogo
		
		function getLogo()
		{
			return $this->logo;
		}//getLogo
		
		
		function setWebsite($website)
		{
			$this->website=$website;
		}//getWebsite
		
		function getWebsite()
		{
			return $this->website;
		}//getWebsite
		
		function setShopPhoneNumber($shop_phone_number)
		{
			$this->shopPhoneNumber=$shop_phone_number;
		}//getShopPhoneNumber
		
		function getShopPhoneNumber()
		{
			return $this->shopPhoneNumber;
		}//getShopPhoneNumber
		
		function setBuisnessType($buisness_type)
		{
			$this->buisnessType=$buisness_type;
		}//getBuisnessType
		
		function getBuisnessType()
		{
			return $this->buisnessType;
		}//getBuisnessType
		
		function setMinNoticeTime($min_notice_time)
		{
			$this->minNoticeTime=$min_notice_time;
		}//getMinNoticeTime
		
		function getMinNoticeTime()
		{
			return $this->minNoticeTime;
		}//getMinNoticeTime
		
		function setAdminName($admin_name)
		{
			$this->adminName=$admin_name;
		}//getAdminName
		
		function getAdminName()
		{
			return $this->adminName;
		}//getAdminName
		
		function setAdminEmail($admin_email)
		{
			$this->adminEmail=$admin_email;
		}//getAdminEmail
		
		function getAdminEmail()
		{
			return $this->adminEmail;
		}//getAdminEmail
		
		function setContactName($contact_name)
		{
			$this->contactName=$contact_name;
		}//getContactName
		
		function getContactName()
		{
			return $this->contactName;
		}//getContactName
		
		function setContactEmail($contact_email)
		{
			$this->contactName=$contact_email;
		}//getContactEmail
		
		function getContactEmail()
		{
			return $this->contactEmail;
		}//getContactEmail
		
		
		function setFacebookPage($facebook_page)
		{
			$this->facebookPage=$facebook_page;
		}//getFacebookPage
		
		function getFacebookPage()
		{
			return $this->facebookPage;
		}//getFacebookPage
	}//end newBaker
?>

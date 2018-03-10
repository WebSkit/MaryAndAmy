<?php
require(realpath(dirname(__FILE__).'\..\userClasses/User.php'));//newBakers parent class
	class Baker extends User{
		var $addressLine1;
		var $addressLine2;
		var $county;
		var $postcode;
		var $pictureCount;
		var $isApproved;
		var $servedArea;
		var $logo;
		var $website;
		var $shopPhoneNumber;
		var $minNoticeTime;
		var $adminName;
		var $adminEmail;
		var $contactName;
		var $contactEmail;
		var $facebookPage;
		function __construct($companyName,$password,$addressLine1,$addressLine2,$county,$postcode,$pictureCount,$isApproved,$servedArea,$logo,$website,$shopPhoneNumber,$minNoticeTime,$adminName,$adminEmail,$contactName,$contactEmail,$facebookPage)
		{
			parent::__construct($companyName,$password);//calls parent constructor
			$this->setAddressLine1($addressLine1);
			$this->setAddressLine2($addressLine2);
			$this->setCounty($county);
			$this->setPostCode($postcode);
			$this->setPictureCount($pictureCount);
			$this->setIsApproved($isApproved);
			$this->setServedArea($servedArea);
			$this->setLogo($logo);
			$this->setWebsite($website);
			$this->setShopPhoneNumber($shopPhoneNumber);
			$this->setMinNoticeTime($minNoticeTime);
			$this->setAdminName($adminName);
			$this->setAdminEmail($adminEmail);
			$this->setContactName($contactName);
			$this->setContactEmail($contactEmail);
			$this->setFacebookPage($facebookPage);
		}//end constructor
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
		function setPostCode($postcode)
		{
			$this->postcode=$postcode;
		}//setPostCode
		function getPostCode()
		{
			return $this->postcode;
		}//getPostCode
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
		function setShopPhoneNumber($shopPhoneNumber)
		{
			$this->shopPhoneNumber=$shopPhoneNumber;
		}//getShopPhoneNumber
		function getShopPhoneNumber()
		{
			return $this->shopPhoneNumber;
		}//getShopPhoneNumber
		function setBusinessType($businessType)
		{
			$this->businessType=$businessType;
		}//getBusinessType
		function getBusinessType()
		{
			return $this->businessType;
		}//getBusinessType
		function setMinNoticeTime($minNoticeTime)
		{
			$this->minNoticeTime=$minNoticeTime;
		}//getMinNoticeTime
		function getMinNoticeTime()
		{
			return $this->minNoticeTime;
		}//getMinNoticeTime
		function setAdminName($adminName)
		{
			$this->adminName=$adminName;
		}//getAdminName
		function getAdminName()
		{
			return $this->adminName;
		}//getAdminName
		function setAdminEmail($adminEmail)
		{
			$this->adminEmail=$adminEmail;
		}//getAdminEmail
		function getAdminEmail()
		{
			return $this->adminEmail;
		}//getAdminEmail
		function setContactName($contactName)
		{
			$this->contactName=$contactName;
		}//getContactName
		function getContactName()
		{
			return $this->contactName;
		}//getContactName
		function setContactEmail($contactEmail)
		{
			$this->contactEmail=$contactEmail;
		}//getContactEmail
		function getContactEmail()
		{
			return $this->contactEmail;
		}//getContactEmail
		function setFacebookPage($facebookPage)
		{
			$this->facebookPage=$facebookPage;
		}//getFacebookPage
		function getFacebookPage()
		{
			return $this->facebookPage;
		}//getFacebookPage
	}//end Baker class
?>

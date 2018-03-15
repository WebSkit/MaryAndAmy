<?php
	class enquiry{
		var $customerId;
		var $enquiryDescription;
		var $priceRange;
		var $dueBy;
		
		function __construct($customerId, $enquiryDescription, $priceRange, $dueBy)
		{
			$this->setCustomerId($customerId);
			$this->setEnquiryDescription($enquiryDescription);
			$this->setPriceRange($priceRange);
			$this->setDueBy($dueBy);
		}//end of constructor

		function setCustomerId($customerId)
		{
			$this->customerId=$customerId;
		}//end of setCustomerId
		
		function getCustomerId()
		{
			return $this->customerId;
		}//end of getCustomerId
		
		function setEnquiryDescription($enquiryDescription)
		{
			$this->enquiryDescription=$enquiryDescription;
		}//end of setEnquiryDescription
		
		function getEnquiryDescription()
		{
			return $this->enquiryDescription;
		}//end of getEnquiryDescription
		
		function setPriceRange($priceRange)
		{
			$this->priceRange=$priceRange;
		}//end of setPriceRange
		
		function getPriceRange()
		{
			return $this->priceRange;
		}//end of getPriceRange
		
		function setDueBy($dueBy)
		{
			$this->dueBy=$dueBy;
		}//end of setDueBy
		
		function getDueBy()
		{
			return $this->dueBy;
		}//end of setDueBy
		
	}//end of enquiry
?>

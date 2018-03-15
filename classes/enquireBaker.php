<?php
	class enquireBaker{
		var $bakerId;
		var $enquiryID;
		var $customerAccept;
		var $bakerAccept;
		
		function __construct($bakerId, $enquiryID, $customerAccept, $bakerAccept)
		{
			$this->setBakerId($customerId);
			$this->setEnquiryID($enquiryID);
			$this->setCustomerAccept($customerAccept);
			$this->setBakerAccept($bakerAccept);
		}

		function setBakerId($bakerId)
		{
			$this->bakerId=$bakerId;
		}
		
		function getBakerId()
		{
			return $this->bakerId;
		}
		
		function setEnquiryID($enquiryID)
		{
			$this->enquiryID=$enquiryID;
		}
		
		function getEnquiryID()
		{
			return $this->enquiryID;
		}
		
		function setCustomerAccept($customerAccept)
		{
			$this->customerAccept=$customerAccept;
		}
		
		function getCustomerId()
		{
			return $this->customerAccept;
		}
		
		function setBakerAccept($bakerAccept)
		{
			$this->bakerAccept=$bakerAccept;
		}
		
		function getBakerId()
		{
			return $this->bakerAccept;
		}
		
	}//end of enquiry
?>
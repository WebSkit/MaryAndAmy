<?php
	class product{
		var $bakerId;
		var $price;
		var $productDescription;
		
		function __construct($bakerId, $price, $priceRange)
		{
			$this->setBakerId($bakerId);
			$this->setPrice($price);
			$this->setPriceRange($priceRange);
		}//end of constructor

		function setBakerId($bakerId)
		{
			$this->bakerId=$bakerId;
		}
		
		function getBakerId()
		{
			return $this->bakerId;
		}
		
		function setPrice($price)
		{
			$this->price=$price;
		}
		
		function getPrice()
		{
			return $this->price;
		}
		
		function setPriceRange($priceRange)
		{
			$this->priceRange=$priceRange;
		}
		
		function getPriceRange()
		{
			return $this->priceRange;
		}
	}//end of product
?>

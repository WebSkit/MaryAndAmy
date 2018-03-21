<?php

	$requiredAddress=realpath(dirname(__FILE__).'\..\databaseDetails.php');

	require($requiredAddress);

	class productDAO
    {
        
		function __construct()
		{
            
		}//constructor
        
		function getConnection()
		{
			$connection=new mysqli($GLOBALS["server"],$GLOBALS["usernameS"],$GLOBALS["passwordS"],$GLOBALS["database"]);
            
			if($connection->connect_error)
			{
				die("Failed to establish a connection, please try again later");
			}//if there was a connection error
            
			return $connection;
		}//end getConnection
		
        //##############################################################################
		
		function createProduct($newProductObject)
		{
			$connection=$this->getConnection();
            
			$prepStatement=$connection->prepare("INSERT INTO product (productID, bakerID, price, productDescription) VALUES(?,?,?,?)");
			
			$productID=$newProductObject->setProductID();
			$bakerID=$_SESSION["bakerID"];
			$price=$newProductObject->setPrice();
			$productDescription=$newProductObject->setProductDescription();
			
            
            $prepStatement->bind_param("ssss",$productID,$bakerID,$price,$productDescription);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;
			}//if query was a failure
		}//end createProduct
		
        //##############################################################################
		
        //Displays all products of x baker - used for baker page
        
        //##############################################################################
        function getProduct($bakerID)
		{

			$connection=$this->getConnection();
            
            
            
			//query gets all fields from product table from x baker
            
             $query="SELECT * FROM product WHERE bakerID=".$bakerID." ORDER BY productID ASC";
            
            
			if($result=$connection->query($query))
			{
				echo "successful query";
			}
			else
			{
				echo $connection->error;
			}
            
            //Array stores all produdcuts a baker has
			$productArray = array();
			$tempCount = 0;
            
			if($result->num_rows > 0)
			{
                echo "row num= ".$result->num_rows;
                
				while($row=$result->fetch_assoc())
				{
					echo "<br>";
                    $productArray[$tempCount]=array("productID"=>$row["productID"],"bakerID"=>$row["bakerID"],"price"=>$row["price"],"productDescription"=>$row["productDescription"]);
                
    				$tempCount++;
                    }
				}//while item in result object
				return $enquiriesArray;
			}//if there is data about products
			else
			{
				return null;
			}//if no data, return null
		}//end getProduct

	}//end productDAO class

    function updateProduct($newProductObject)
        {
			$connection=$this->getConnection();
			$prepStatement=$connection->prepare("UPDATE product SET price=?,productDescription=? WHERE productID=?;");

			$bakerID=$_SESSION["bakerID"];
			$price=$newProductObject->getPrice();
			$productDescription=$newProductObject->getProductDescription();
			

			$prepStatement->bind_param("sss",$price,$productDescription,$bakerID);
			if($prepStatement->execute())
			{
				return true;
			}//if query was a success
			else
			{
				return false;

			}//if query was a failure

		}//end updateProduct
        
    }
    function deleteProduct($productID)
    {
        
        connection=$this->getConnection();
			$prepStatement=$connection->prepare("DELETE FROM product WHERE productID = ?;");
			
			$prepStatement->bind_param("s", $productID);
			if($prepStatement->execute())
			{
				return true;
			}//if query succeeds
			else
			{
				return false;
			}//if query fails
		}//end deleteProduct
    }
?>

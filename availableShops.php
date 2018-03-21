<?php 

    include("DAO/shopFinder.php");


    function testInput($data) 
    {

	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	} 


    function displayShops()
    {
        $postCode = testInput($_POST["Postcode"]);
        $y = new shopFinder();
        $shops = $y->findValidShops($postCode);  
     

        $start = 0;
        
        if(sizeof($shops) == 0)
        {
            echo "There a no shops available in your area";
        }
        else
        {
            echo "<input type='submit' value='Query all selected shops'><br><br>";
            while( $start < sizeof($shops) )
            {
                $company = $shops[$start]['companyName'];
                $review =$shops[$start]['reviewScore'];  
    
                // echo "<input type="submit" value="Find available shops" name="twar">";
                echo $company;
                echo "<br>";
                echo $review;
                
                echo "<input type='checkbox'>";
                echo "<br>";
                echo "<a href";              
                
                echo "<br><br>";
                $start++;
            }
        }
    }
    //echo '<pre>';  print_r($shops); echo '</pre>';
    if(isset($_POST["findMyShops"]))
    {   
        displayShops();

    }
    else if(empty($_POST["findMyShops"]))
    {
        echo "Please enter a postcode";
    }
    else
    {
        echo "Please enter a correct postcode";
    }
?>


<head>

</head>

<body>
    
    <form method="post" id="avalaibleShopsForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
    <div>
        <h2>Postcode</h2>
        <input type="text" name="Postcode" value="" required>*
    </div>   
        
        
    <br><br>

    <div>
        <input type="submit" name="findMyShops" value="Find shops nearby">    
    </div>
 
    </form> <!-- end avalaibleShopsForm -->

    
    
    
</body>
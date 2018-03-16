<?php 

    include(realpath(dirname(__FILE__).'\DAO\shopFinder.php'));
    // Report all errors except E_NOTICE   
    // error_reporting(E_ALL ^ E_NOTICE);  


    function testInput($data) 
    {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	} 


    $postCode = testInput($_POST["Postcode"]);

    $y = new shopFinder();
    $shops = $y->findValidShops($postCode);  

 //echo '<pre>';  print_r($shops); echo '</pre>';

    

    $start = 0;
    while( $start < sizeof($shops) )
    {
        $company = $shops[$start]['companyName'];
        $review =$shops[$start]['reviewScore'];  
    
        // echo "<input type="submit" value="Find available shops" name="twar">";
        echo $company;
        echo "<br>";
        echo $review;
    
        echo "<br>";
    
        echo "<form action='bakerPage(customersView).php' method='post'>";
        echo "<input type='submit' value='Send enquiry'>";
        echo "</form>";
    
        echo "<br><br>";
    $start++;
}
 

    ?>


<head>

</head>

<body>
    
    <form method="post" id="avalaibleShopsForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
    <div>
        <h2>Postcode</h2>
        <input type="text" name="Postcode" value="<?php echo $postCode;?>" required>*
    </div>   
        
        
    <br><br>

    <div>
        <input type="submit" value="Find available shops" name="findShops">    
    </div>
 
    </form> <!-- end avalaibleShopsForm -->

    
    
    
</body>
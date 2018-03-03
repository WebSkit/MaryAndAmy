<?php
    $requiredAddress=realpath(dirname(__FILE__).'\..\databaseDetails.php');
    require($requiredAddress);

    function getConnection()
    {
        $connection=new mysqli($GLOBALS["server"],$GLOBALS["usernameS"],$GLOBALS["passwordS"],$GLOBALS["database"]);
        if($connection->connect_error)
        {
            die("Failed to establish a connection, please try again later");
        }//if there was a connection error
        return $connection;
    }

    function parseToXML($htmlStr)
    {
        $xmlStr=str_replace('<','&lt;',$htmlStr);
        $xmlStr=str_replace('>','&gt;',$xmlStr);
        $xmlStr=str_replace('"','&quot;',$xmlStr);
        $xmlStr=str_replace("'",'&#39;',$xmlStr);
        $xmlStr=str_replace("&",'&amp;',$xmlStr);
        return $xmlStr;
    }

    function geocodeAddress($addressLine1, $addressLine2)
    {
        $address = urlencode($addressLine1." ".$addressLine2);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyDUnq_6S9h0s8RQ6bFlffK2KMnjegHoipM";

        // get the json response
        $resp_json = file_get_contents($url);

        // decode the json
        $resp = json_decode($resp_json, true);

        // response status will be 'OK', if able to geocode given address
        if($resp['status']=='OK'){

            // get the important data
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";

            // verify if data is complete
            if($lati && $longi){

                // put the data in the array
                $data_arr = array();

                array_push(
                    $data_arr,
                        $lati,
                        $longi
                );

                return $data_arr;

            }else{
                return false;
            }

        }

        else{
            echo "<strong>ERROR: {$resp['status']}</strong>";
            return false;
        }
    }

    $connection = getConnection();
    $prepStatement=$connection->prepare("SELECT * FROM baker WHERE bakerId = ?");
    //NOTE: Need to Replace with id of bakerPage
    $id=1;
    $prepStatement->bind_param("s", $id);
    $result;//=$prepStatement->execute();
    if($prepStatement->execute())
    {
        $result = $prepStatement->get_result();

        header("Content-type: text/xml");

        // Start XML file, echo parent node
        echo '<markers>';
        while($row=$result->fetch_assoc())
        {
            $location_arr = geocodeAddress($row['addressLine1'], $row['addressLine2']);
            // Add to XML document node
            echo '<marker ';
            echo 'id="' . $row['bakerID'] . '" ';
            echo 'name="' . parseToXML($row['companyName']) . '" ';
            echo 'addressLine1="' . parseToXML($row['addressLine1']) . '" ';
            echo 'addressLine2="' . parseToXML($row['addressLine2']) . '" ';
            echo 'postcode="' . parseToXML($row['postcode']) . '" ';
            echo 'lat="' . $location_arr[0] . '" ';
            echo 'lng="' . $location_arr[1] . '" ';
            echo '/>';
        }
        echo '</markers>';
    }//if query was a success
?>

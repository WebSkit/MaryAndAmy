<html>
	<head>
	<title> Baker GEOCODE </title>
		<?php
			require('../MaryAndAmy/bakerDAO.php');
			
			$temp_bakerDAO = new bakerDAO();
			$fullAddress = $temp_bakerDAO->getBakerLocation();
			//just need to use this variable for geocode.
		?>
	
	<style>
		
	</style>
	
	</head>

	<body>
	
		<div id="map"></div>
		
		<script>
      function initMap() 
	  {
	  //the map.
        var map = new google.maps.Map(document.getElementById('map'), 
		{
          zoom: 5,
          center: {lat: -34.397, lng: 150.644}
        }
		);
		
		//the geocoder.
        var geocoder = new google.maps.Geocoder();
		
		geocodeAddress(geocoder,map);
		
      }
		
	   //making the function geocodeAddress that will geocode the adress.
	   //takes in two parameter. the geocoder and the map.
      function geocodeAddress(geocoder, resultsMap) 
	  {
	  //getting the value from html textbox ID as address.
	  //for live project, this can be change to the shop address.
        var address = <?php print $fullAddress ?>
	
		//geocoder from the parameter
        geocoder.geocode({'address': address}, function(results, status) 
		{
          if (status === 'OK') 
		  {
		  //for live project, instead of setCenter, we can set the marker instead.
            resultsMap.setCenter(results[0].geometry.location);
			
            var marker = new google.maps.Marker({map: resultsMap, position: results[0].geometry.location});
          } 
		  else 
		  {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        }
		);
      }
    </script>
	
	<!--here where we call the map-->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBexz-OSZGcX63ZBZNRE7nRnvpqw7klvh4&callback=initMap">
    </script>
		
	
	</body>

</html>

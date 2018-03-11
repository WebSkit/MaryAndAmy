<?php
require("userDAOClasses/bakerDAO.php");
require("DAO/reviewsDAO.php");
$bakerID = 1;
$_SESSION["accountType"] = "customer";
if($_SESSION["accountType"] == "baker") {
	header("Location: bakerPage(bakersView).php");
	exit;
}
else{
	$bakerDAO = new BakerDAO();
	$baker = $bakerDAO -> getBakerObject($bakerID);

	$shopName = $baker -> getName();
	$logoSource = $baker -> getLogo();
	//$shopDescription = $baker -> getDescription();
?>
<!DOCTYPE HTML>
<head>
	<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
        width: 50%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
</head>
<body>
	<header></header>
	<nav></nav>
	<section id="bakerDetails">
		<?php echo $shopName; ?>
		<img src=<?php echo '"'.$logoSource.'"'?> alt="Baker Logo" title="Baker Logo">
		<!--description-->
		<a href="enquiryForm.php"><button type="button" name="enquiryForm" value="Enquiry Form">Enquiry Form</button></a>
	</section>
	<section id="photoGallery">

	</section><!--end photoGallery section-->
	<section id="reviews">
		<?php
			$reviewDAO=new reviewsDAO();
			$reviewsArray=$reviewDAO->getReviews($bakerID);
			if($reviewsArray==null)
			{
				echo "<p>No reviews have been made about any of <b>".$shopName."</b>'s "."products</p>";
			}
			else
			{
				?>
				<ul id="reviewList">
					<?php
						$reviewCount=sizeof($reviewsArray);
						$tempCount=0;
						while($tempCount<$reviewCount)
						{
							?>
								<li>
									<ul id="review "<?php echo $tempCount+1;?>>
										<li>Product:<?php echo $reviewsArray[$tempCount]["productDescription"];?></li>
										<li>Rating: <?php echo $reviewsArray[$tempCount]["rating"];?></li>
										<li>Review: <?php echo $reviewsArray[$tempCount]["review"];?></li>
										<li>By<?php echo " ".$reviewsArray[$tempCount]["customerName"];?></li>
										<li><button class="<?php if($reviewsArray[$tempCount]["flagged"]==false){ echo "flagReview";}else{ echo "flagPending";}?>" type="button" data-reviewid="<?php echo $reviewsArray[$tempCount]["reviewId"]; ?>"><?php if($reviewsArray[$tempCount]["flagged"]==false){echo "Flag Review";}else{echo "Flag waiting Approval";}?></button></li>
									</ul>
								</li>
							<?php
							$tempCount++;
						}//while there are reviews in the list

					?>
				</ul>
				<?php
			}//else if there are reviews about the baker
		?>
	</section><!--end reviews section-->
	<section id="shopLocationMap">
		<div id = "map"></div>
		<script src="js/shop_location_map.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYp0pm10ndJw4ReV_pmi9Q0b62N3ohIZY&callback=initMap"
			async defer></script>
	</section>
</body>
</html>
<?php
} //end else
?>

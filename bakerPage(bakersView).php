<?php
session_start();
$requiredAddress="DAO/reviewsDAO.php";
require($requiredAddress);
$_SESSION["userId"]=1;
$_SESSION["accountType"]="baker";//remove both of these tester session variables after you have completed this page

if($_SESSION["accountType"]!="baker")
{
	die("You must be logged in as a baker to access this page");
}//if not a baker, kill the page
else//else allow the rest of the page to be loaded
{
?>
<!doctype html>
	<head>

	</head>

	<body>
		<script type="text/javascript" src="bakerOptions/flagReview.js"></script>

		<header></header>
		<nav></nav>
		<section id="bakerOptions">
			<article id="editDetails">
				<a href="bakerOptions/changeDetails.php"><button type="button" name="editAccountDetails" value="Edit Account Details">Edit Account</button></a>
				<a href="bakerOptions/changeServiceOptions.php"><button type="button"  name="serviceOptions" value="Change Serving Area or Delivery options">Change Service Options</button></a>
				<a href="bakerOptions/uploadToGallery.php"><button type="button" name="uploadImages">Upload Images</button></a>
			</article><!--end editDetails-->
			<article id="orderControl">
				<a href="bakerOptions/addProduct.php"><button type="button" name="addProduct">Create New Product</button></a>
				<a href="bakerOptions/reviewOrders.php"><button type="button" name="viewOrders" value="View Orders">View Orders</button></a>
				<a href="bakerOptions/viewEnquiryRequests.php"><button type="button" name="viewEnquiries" value="Enquiry Requests">View Enquiries</button></a>
			</article>
			<article id="reviews">
				<?php
					$reviewDAO=new reviewsDAO();
					$reviewsArray=$reviewDAO->getReviews($_SESSION["userId"]);
					if($reviewsArray==null)
					{
						echo "<p>No reviews have been made about any of your products</p>";
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
			</article>
			<article id="adminShop">
			<a href="bakerOptions/buyImageSpace.php"><button type="button" name="buyImageSpace">Buy Image Space</button></a>
			</article>
		</section>
	</body>



</html>
<?php
}//else if the user is a baker
?>

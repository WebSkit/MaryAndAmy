<?php
	
	//http://www.peachpit.com/articles/article.aspx?p=1677579&seqNum=3
	//https://tutorialzine.com/2010/06/simple-ajax-commenting-system
	
	//need method for validating text area. >1000 char.
	require("userDAOClasses/reviewDAO.php");
	
	
	if(isset($_POST["review_submit"]) //if post == review submit
	{
		//to get radio button value, 
		$temp_dao = new reviewDAO();
		$comment = $_POST["commentArea"];
		$rating = $_POST["rating"];
		
		$temp_dao->insertComment($comment,$rating)
		
	}
	
?>

<body> 

	<form method ="post" id="reviewForm">
		
		<h2>Reviews and Comments</h2>
		Name: <input type="text" name="name">
		<br><br>
		
		Comment: <br>
		<textarea name="commentArea" rows="5" cols="40"> </textarea>
		<br> <br>
		
		Rating: <br>
	<input type="radio" name="rating"value="5" /> 5 
	<input type="radio" name="rating" value="4" /> 4
    <input type="radio" name="rating" value="3" /> 3 
	<input type="radio" name="rating" value="2" /> 2 
	<input type="radio" name="rating" value="1" /> 1
		
		
		
	<input type="submit" value="Submit" name="review_submit">
		
	
	
	</form>

</body>
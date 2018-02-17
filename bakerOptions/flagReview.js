document.addEventListener("DOMContentLoaded", getFlagButtons);
		var result;
		var activeObject;

function getFlagButtons()
{
	
	var flagReviewButton = document.getElementsByClassName("flagReview");//an array of all elements with the "flagReview" class
	for (var i = 0; i < flagReviewButton.length; i++) {
		flagReviewButton[i].addEventListener('click', sendFlagRequest);
	}//for each item in the flagReviewButton list
}

function sendFlagRequest()
{
		xmlhttp=new XMLHttpRequest();
		activeObject=this;
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			
			//alert(this.responseText);
			result=this.responseText;//for some reasion, with reviewId 1(and no other id) this does not seem to trigger(or at least result is kept undefined), yet with the other reviews it works fine
			
			
			if(this.responseText==true)
			{
				activeObject.class="flagPending";
				activeObject.innerHTML="Flag waiting Approval";
				activeObject.removeEventListener("click",sendFlagRequest);
			}
			else
			{
				alert("unsuccessful review flag");
			}
		}//if the request completed and was successful
	};//onreadystatechange
		xmlhttp.open("POST", "bakerOptions/flagReview.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("reviewId="+this.dataset.reviewid);
		
		
		
		
}
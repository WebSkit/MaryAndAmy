//1. ADD CODE TO REMOVE ANY "<" OR ">" FROM BEING PLACED IN THE CODE(TO PREVENT JAVASCRIPT INJECTION)(completed)
//2.CONVERT THIS TO MAKE IT COMPATIBLE WITH FACEBOOK STYLED CHATS(AKA MAKE GREATER USE OF CLASSES)(DONE)
//3.when you have made the cht facebook-styled(rather than the current chat room styled) implement a second refresh so that it goes through all the open conversations and refreshes there messages
//(DONE task 3)
document.addEventListener("DOMContentLoaded", initialisePage);
window.setInterval(refreshAllChats,2000);
function initialisePage()
{
	var sendMessageButton=document.getElementsByClassName("sendMessage");
	for (var i = 0; i < sendMessageButton.length; i++) {
		sendMessageButton[i].addEventListener('click', sendMessage);
	}//for each item in the sendMessageButton list#
	
	
	
}

function sendMessage()
{
	var messageButton=this;//used to access the conversation id
	
	var messageTextBoxList=document.getElementsByClassName("message");
	var messageTextBox;

	for (var i = 0; i < messageTextBoxList.length; i++) {
		
		if(messageTextBoxList[i].dataset.conversationid==messageButton.dataset.conversationid)
		{
			messageTextBox=messageTextBoxList[i];
			break;
		}//if the message has the same conversationId as the 
	}//for each item in the messageTextBoxList list
	var conversationId=messageButton.dataset.conversationid;

	xmlhttp=new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if(this.responseText==false)
			{
				alert("something went wrong");
			}
			else
			{
				refreshChat(conversationId);
			}
		}//if the request completed and was successful
	};//onreadystatechange
		var message=messageTextBox.value;
		message = message.replace(/</g, "&lt;").replace(/>/g, "&gt;");//for all instances(g) of < and >, replace with the safe versions(stops javascript injection)
		xmlhttp.open("POST", "chatClass/sendMessage.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("conversationId="+conversationId+"&message="+message);

	
}
function refreshChat(conversationId)
{
	var chatAreaList=document.getElementsByClassName("chatArea");
	var chatArea;

	
	for (var i = 0; i < chatAreaList.length; i++) {
		
		if(chatAreaList[i].dataset.conversationid==conversationId)
		{
			chatArea=chatAreaList[i];
			break;
		}//if the chatArea has the same conversationId as the parameter
	}//for each item in the chatAreaList
	
	xmlhttp=new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if(this.responseText==false)
			{
			}
			else
			{
				console.log("response successful");
				var messageArea=chatArea;
				messageArea.innerHTML=this.responseText;
			}
		}//if the request completed and was successful
	};//onreadystatechange
		xmlhttp.open("POST", "chatClass/refreshMessages.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("conversationId="+conversationId);
}//end refreshMessage

function refreshAllChats()
{
	console.log("refreshAllChats entered");
	var chatAreaList=document.getElementsByClassName("chatArea");
	var activeChatArea;

	for (var i = 0; i < chatAreaList.length; i++) {
		
		activeChatArea=chatAreaList[i];
		var conversationId=activeChatArea.dataset.conversationid;
		refreshSingle(activeChatArea,conversationId);//makes the ajax request and modifies the html
	}//for each item in the chatAreaList

}//end refreshAllChats

function refreshSingle(areaToEdit,conversationId)
{
	xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if(this.responseText==false)
			{

			}
			else
			{
				
				var messageArea=areaToEdit;
				messageArea.innerHTML=this.responseText;
				messageArea.innerHTML;

			}
		}//if the request completed and was successful
	};//onreadystatechange
		xmlhttp.open("POST", "chatClass/refreshMessages.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("conversationId="+conversationId);
}//performs ajax request for the refreshAllChat method
<?php
require("../userDAOClasses/bakerDAO.php");//session started in this method already
$bakerDAO=new bakerDAO();
if(isset($_POST["submit"]))
{
	$dataUpdated=$bakerDAO->changeServiceOptions($_POST["serviceArea"],$_POST["minNoticeTime"],$_SESSION["userId"]);
	
}
$bakerObject=$bakerDAO->getBakerObject($_SESSION["userId"]);


?>

<form action="changeServiceOptions.php" method="post">
			<br>
			<input type="text" name="serviceArea" id="serviceArea" value="<?php echo $bakerObject->getServedArea();?>">Service Area<br>
			<input type="text" name="minNoticeTime" id="minNoticeTime" value="<?php echo $bakerObject->getMinNoticeTime();?>">Minimum Notice Time<br>
			<input type="submit" value="Change Services" name="submit">
			<?php if(isset($dataUpdated)){ if($dataUpdated==true){ echo "<p>Your Information has been updated</p>";}else{ echo "<p>Something went Wrong, please ensure that both values are numbers</p>";} }?>
</form>
<?php
	require("..\userDAOClasses/adminDAO.php");
	if(isset($_POST["updateDetails"])){
		$tempAdmin = new Admin($_POST["N_username"],$_POST["N_password"],$_POST["N_email"],$_POST["N_phone"]);
		$tempAdminDAO = new adminDAO();
		$updateAdmin = $tempAdminDAO->updateAdmin($tempAdmin);
		if($updateAdmin==true)
		{
			echo "Details has been updated successfully";
		}
		else
		{
			echo "something happened try again";
		}
	}
?>

<body>
	<form method="post" id="addAdmin">

		<h1>Add Administration</h1>


		<h3>Username</h3>
		<input type="text" name="N_username">
		<br>
		<h3>Password</h3>
		<input type="text" name="N_password">
		<br>
		<h3>E-mail<h3>
		<input type="text" name="N_email">
		<br>
		<h3>Contact number<h3>
		<input type="text" name ="N_phone">
		<br><br>
		<input type="submit" name="updateDetails">


	</form>

</body>

<?php
	require("db_connect.php");
	
	$userName = $_POST['txtUserName'];
	$password = $_POST['txtPassword'];
	$name = $_POST['txtName'];
	$cPhone = $_POST['cPhone'];
	$email = $_POST['txtEmail'];
	$contactP = $_POST['contactPreference'];
	$carrier = $_POST['carrier'];
	$type = $_POST['userType'];

	$query="INSERT INTO User (UserID, Password,
		Name, CellPhone,
		Email, ContactPreference, Carrier, Type)
		VALUES('$userName','".md5($password)."','$name','$cPhone',
		'$email','$contactP','$carrier','$type');";
	
	$result=mysql_query($query);

	header("Location: signin.php");

	mysql_close($conn);
?>

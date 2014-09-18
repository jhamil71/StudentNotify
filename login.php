<?php

ob_start();
session_unset();
session_set_cookie_params("60");
session_start( );	
$txtID = $_POST['txtUserName'];    //was txtID
$txtPassword = md5($_POST['txtPassword']);

require("db_connect.php");

$query = "SELECT Password, Type FROM  `User` WHERE UserID = '$txtID';";

$result = mysql_query($query);

if ($result and mysql_num_rows($result) == 1){
	// User was found, check password
	$result_array = mysql_fetch_assoc($result);
	if ($txtPassword == $result_array['Password']){ //TODO: Put md5() around txtPassword after updating signup page
		// Login success!
		$type = $result_array['Type'];
		
		$_SESSION['logged_in'] = 'Y';
		$_SESSION['txtUserName'] = $txtID;
		$_SESSION['type'] = $type;
		if ($type == "Student"){
			header("Location: studentIndex.php");
		} else {
			header("Location: instructorIndex.php");
		}
		
		exit(0);
	} else {
		// Incorrect password
		//echo "Incorrect password!";
		header("Location: signin.php?error=1");
	}
} else {
	// Should only occur if username is wrong
	header("Location: signin.php?error=1");
}

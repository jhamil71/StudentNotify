<?php
	ob_start();	
	session_set_cookie_params("60");
	session_start();

	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$loginPassWord = $_SESSION["txtPassword"];

	require("db_connect.php");	
	require("mail_connect.php");
	
	//Query the database
	$query='SELECT Name, ContactPreference, CellPhone, Email, Carrier, Type FROM `User` WHERE UserID = \''.$iD.'\';';
	$result=mysql_query($query);
	
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	
	$row=mysql_fetch_array($result);
	$name=$row['Name'];
	$to=$row['Email'];
	$cellPH=$row['CellPhone'];
	$cellCarrier=$row['Carrier'];
	$contactPref=$row['ContactPreference'];

	if ($contactPref == 'Email'){
		$subject = "StudentNotify Email from $name";
		$message = " Congratulations, you got a fancy email!";
		send_email("studentnotifysystem@gmail.com", $to, $subject, $message);						
	} else if ($contactPref == 'Text'){
		$carrier_address = array(
			"AT&T" => "txt.att.net",
			"Sprint" => "messaging.sprintpcs.com",
			"T-Mobile" => "tmomail.net",
			"Verizon" => "vtext.com"
		);
		
		$to = "$cellPH@" . $carrier_address[$cellCarrier];
		$message = " Congratulations, you got a fancy text!";
		$subject = "StudentNotify text from $name";

		send_email("studentnotifysystem@gmail.com", $to, $subject, $message);
	}
	
	if($row['Type'] == "Student"){
		header("Location: studentIndex.php");
	} else {
		header("Location: instructorIndex.php");
	}
	ob_end_flush( );
?>

<?php
	ob_start();	
	session_set_cookie_params("60");
	session_start();

	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$loginPassWord = $_SESSION["txtPassword"];
	$message = $_POST['txtMessage'];	
	$sendToID = $_SESSION['SendToID'];

	require("db_connect.php");	
	require("mail_connect.php");
	
	//Query the database
	$query='SELECT Name, ContactPreference, CellPhone, Email, Carrier FROM `User` WHERE UserID = \''.$sendToID.'\';';
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
		send_email("studentnotifysystem@gmail.com", $to, $subject, $message);						
	} else if ($contactPref == 'Text'){
		$carrier_address = array(
			"AT&T" => "txt.att.net",
			"Sprint" => "messaging.sprintpcs.com",
			"T-Mobile" => "tmomail.net",
			"Verizon" => "vtext.com"
		);
		
		$to = "$cellPH@" . $carrier_address[$cellCarrier];
		$subject = "StudentNotify text from $name";

		send_email("studentnotifysystem@gmail.com", $to, $subject, $message);
	}

	header("Location: studentIndex.php");
	ob_end_flush( );
?>

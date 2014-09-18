<?php
	ob_start();
	session_set_cookie_params("60");
	session_start();	
	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$message = $_POST['txtMessage'];

	require("db_connect.php");
	require("mail_connect.php");

	$query='SELECT * FROM `User` WHERE UserID = \''.$iD.'\';';
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	$dBName = $row['Name'];
	
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	//load each individual email into an array
	if (empty($_POST['checked_all'])) {
		echo "<p>Thinks POST is empty</p>\n";
	} else{
		foreach($_POST['checked_all'] as $check){
			//echo "<p>".$check."</p>\n";
			$query='SELECT ContactPreference, CellPhone, Email, Carrier FROM `User` WHERE UserID = \''.$check.'\';';
			$result=mysql_query($query);
			
			if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
			}
			
			$row=mysql_fetch_array($result);
			
			$to=$row['Email'];
			$cellPH=$row['CellPhone'];
			$cellCarrier=$row['Carrier'];
			$contactPref=$row['ContactPreference'];
			
			if ($contactPref == 'Email'){											
				$subject = "StudentNotify Email from $dBName";
				send_email("studentnotifysystem@gmail.com", $to, $subject, $message);			
			} else if ($contactPref == 'Text'){
				$subject = "StudentNotify text from $dBName";
				$carrier_address = array(
					"AT&T" => "txt.att.net",
					"Sprint" => "messaging.sprintpcs.com",
					"T-Mobile" => "tmomail.net",
					"Verizon" => "vtext.com"
				);
				$to = "$cellPH@" . $carrier_address[$cellCarrier];
				send_email("studentnotifysystem@gmail.com", $to, $subject, $message);
			}
		}
	}
	header("Location: instructorIndex.php");
	ob_end_flush( );
?>

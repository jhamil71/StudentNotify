<?php
	ob_start();	
	session_set_cookie_params("60");
	session_start();	
	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$txtMessage = $_POST['txtMessage'];

	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";	
	$password = "Teacher1!";
	$conn = mysql_connect($hostname, $username, $password) OR DIE
	("Unable to connect to database! Please try again later.");	
	mysql_select_db($dbname);

	$query678='SELECT * FROM `Teacher` WHERE TeacherID = \''.$iD.'\';';
	$result2=mysql_query($query678);
	$row = mysql_fetch_array($result2);
	$instructorEmail=$row['Email'];
	$dBFirstName = $row['FirstName'];
	$dBLastName = $row['LastName'];
	$dBCombined = ''.$dBFirstName.' '.$dBLastName.'';
	
	if (!$result2) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	
	//load each individual email into an array
	if (empty($_POST['checked_all']))
	echo "<p>Thinks POST is empty</p>\n";
	else{
		foreach($_POST['checked_all'] as $check){
			//echo "<p>".$check."</p>\n";
			$query='SELECT ContactPreference, CellPhone, Email, Carrier FROM `Student` WHERE StudentID = \''.$check.'\';';
			$result=mysql_query($query);
			
			if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
			}
				
			$row=mysql_fetch_array($result);
			$contactPref=$row['ContactPreference'];
			$eMail=$row['Email'];
			$cellPH=$row['CellPhone'];
			$cellCarrier=$row['Carrier'];
			
			if ($contactPref == 'Email'){									
				if (!$result) {
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $query;
					die($message);
					}
					
					$subject = "WhiteBoard Email from $dBCombined";
					$message = $txtMessage;
					$from = $instructorEmail;
					
					$headers = "From: $dBCombined <$from>";
					mail($eMail,$subject,$message,$headers);								
			}
			else if ($contactPref == 'Text'){
				if ($cellCarrier == 'AT&T'){					
					$to = "$cellPH@txt.att.net";
					$subject = "WhiteBoard text from $dBCombined";
					$message = $txtMessage;
					$from = $instructorEmail;
					//$headers = "From:" . $from;
					
					$headers = "From: $dBCombined <$from>";
					mail($to,$subject,$message,$headers);
				}	
				else if($cellCarrier == 'Sprint'){
					$to = "$cellPH@messaging.sprintpcs.com";
					$subject = "WhiteBoard text from $dBCombined";
					$message = $txtMessage;
					$from = $instructorEmail;
					
					$headers = "From: $dBCombined <$from>";
					mail($to,$subject,$message,$headers);
				}	
				else if($cellCarrier == 'T-Mobile'){
						$to = "$cellPH@tmomail.net";
						$subject = "WhiteBoard text from $dBCombined";
						$message = $txtMessage;
						$from = $instructorEmail;
					
					$headers = "From: $dBCombined <$from>";
						mail($to,$subject,$message,$headers);
				}
				else if($cellCarrier == 'Verizon'){
							$to = "$cellPH@vtext.com";
							$subject = "WhiteBoard text from $dBCombined";
							$message = $txtMessage;
							$from = $instructorEmail;
					
					$headers = "From: $dBCombined <$from>";
							mail($to,$subject,$message,$headers);
				}	
			}
		}
	}
	
header("Location: http://teacherstudent.jeffersonccit.com/instructorIndex.php");
ob_end_flush( );
?>
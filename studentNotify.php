<?php
	ob_start();	
	session_set_cookie_params("60");
	session_start();

	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$loginPassWord = $_SESSION["txtPassword"];
	$iD5 = $_POST['txtMessage'];	
	$sendToID = $_SESSION['SendToID'];

	require("db_connect.php");	

	$query='SELECT Email FROM `Teacher` WHERE TeacherID = \''.$sendToID.'\';';

	$result=mysql_query($query);
	
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	
	while($row = mysql_fetch_array($result)){
		$teacherEmail = $row['Email'];
	}

	$query='SELECT * FROM `Student` WHERE StudentID = \''.$iD.'\';';
	$result=mysql_query($query);				

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}		
	else{
		while($row = mysql_fetch_array($result)) {
			$dBFirstName = $row['FirstName'];
			$dBLastName = $row['LastName'];
			$dBCombined = ''.$dBFirstName.' '.$dBLastName.'';
		}
	}

	//send email
	$subject = "A WhiteBoard message from $dBCombined";
	//MAIL SYNTAX: mail(to,subject,message,headers,parameters) 
	mail($teacherEmail, $subject, $iD5);
		
	header("Location: http://teacherstudent.jeffersonccit.com/studentIndex.php");
	ob_end_flush( );
?>

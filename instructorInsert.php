<?php
	ob_start();
	session_start();
	if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == "N") {
		header("Location: signin.php");
		session_destroy();
		exit();
	}
	session_set_cookie_params("60");
	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$loginPassWord = $_SESSION["txtPassword"];	
	require("db_connect.php");
	
	$oldPassword=$_POST['oldPassword'];
	$newPassword=$_POST['newPassword'];
	$newPassword2=$_POST['newPassword2'];
	$cPhone=$_POST['cPhone'];
	$email=$_POST['email'];
	$addCourseNumber=$_POST['ADDCOURSE'];
	$deleteCourseNumber=$_POST['deleteCourse'];
	
	
	if($newPassword != ""){
		$query='SELECT Password FROM `Teacher` WHERE TeacherID=\''.$iD.'\';';
		$result=mysql_query($query);
		
		if(!$result){
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		else{
			while($row = mysql_fetch_array($result)) {
				$dBPassword = $row['Password'];
			}			
		}
	
		//the old password is right    AND newPW is the same as the retyped one
		if($oldPassword == $dBPassword && $newPassword == $newPassword2){			
			$query='UPDATE `Teacher` SET Password=\''.$newPassword.'\' WHERE TeacherID =\''.$iD.'\';';
			$result=mysql_query($query);
			if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
			}
		}
	}
	
	if($email != ""){
		$query='UPDATE `Teacher` SET Email=\''.$email.'\' WHERE TeacherID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	
	if($cPhone != ""){
		$query='UPDATE `Teacher` SET CellPhone=\''.$cPhone.'\' WHERE TeacherID =\''.$iD.'\';';
		$result=mysql_query($query);	
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($addCourseNumber != ""){		
		$query="INSERT INTO `Course` (CourseID, TeacherID) VALUES ('$addCourseNumber', '$iD');";
		$result=mysql_query($query);
		if (!$result) {			
			$message  = 'Invalid query: ' . mysql_error() . "\n";			
			$message .= 'Whole query: ' . $query;			die($message);		
		}	
	}

	if($deleteCourseNumber != ""){
	$query = "DELETE FROM Course WHERE CourseID = '$deleteCourseNumber'";
	$result = mysql_query($query);		
		if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
		}		
	}
	  	  
	header("Location: viewEdit.php");
	mysql_close($conn);ob_end_flush( );
?>

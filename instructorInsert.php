<?php
	ob_start();
	session_start();
	if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == "N") {
		header("Location: http://teacherstudent.jeffersonccit.com/signin.html");
		session_destroy();
		exit();
	}
	session_set_cookie_params("60");
	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$loginPassWord = $_SESSION["txtPassword"];	
	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";
	$password = "Teacher1!";
					
	$conn = mysql_connect($hostname, $username, $password) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);  
	
	$oldPassword=$_POST['oldPassword'];
	$newPassword=$_POST['newPassword'];
	$newPassword2=$_POST['newPassword2'];
	$firstName=$_POST['firstName'];
	$lastName=$_POST['lastName'];
	$cPhone=$_POST['cPhone'];
	$email=$_POST['email'];
	$oLocation=$_POST['oLocation'];
	$oPhone=$_POST['oPhone'];
	$addCourseNumber=$_POST['ADDCOURSE'];
	$deleteCourseNumber=$_POST['deleteCourse'];
	$mofficeHours = $_POST['mOfficeHour'];
	$tofficeHours = $_POST['tOfficeHour'];
	$wofficeHours = $_POST['wOfficeHour'];
	$thofficeHours = $_POST['thOfficeHour'];
	$fofficeHours = $_POST['fOfficeHour'];
	
	
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
	
	if($firstName != ""){
		$query='UPDATE `Teacher` SET FirstName=\''.$firstName.'\' WHERE TeacherID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($lastName != ""){
		$query='UPDATE `Teacher` SET LastName=\''.$lastName.'\' WHERE TeacherID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
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
	
	if($oPhone != ""){
		$query='UPDATE `Teacher` SET OfficePhone=\''.$oPhone.'\' WHERE TeacherID =\''.$iD.'\';';
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
	
	if($oLocation != ""){
		$query='UPDATE `Teacher` SET OfficeLocation=\''.$oLocation.'\' WHERE TeacherID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}	
	
	if($mofficeHours != ""){
		$query='UPDATE `Teacher` SET MondayOfficeHours =\''.$mofficeHours.'\' WHERE TeacherID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	if($tofficeHours != ""){
			$query='UPDATE `Teacher` SET TuesdayOfficeHours =\''.$tofficeHours.'\' WHERE TeacherID =\''.$iD.'\';';
			$result=mysql_query($query);		
			if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
			}
		}
	if($wofficeHours != ""){
			$query='UPDATE `Teacher` SET WednesdayOfficeHours =\''.$wofficeHours.'\' WHERE TeacherID =\''.$iD.'\';';
			$result=mysql_query($query);		
			if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
			}
		}
	if($thofficeHours != ""){
			$query='UPDATE `Teacher` SET ThursdayOfficeHours =\''.$thofficeHours.'\' WHERE TeacherID =\''.$iD.'\';';
			$result=mysql_query($query);		
			if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
			}
		}
	if($fofficeHours != ""){
			$query='UPDATE `Teacher` SET FridayOfficeHours =\''.$fofficeHours.'\' WHERE TeacherID =\''.$iD.'\';';
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
	  	  
	header("Location: http://teacherstudent.jeffersonccit.com/instructorView_Edit.php");
	mysql_close($conn);ob_end_flush( );
?>
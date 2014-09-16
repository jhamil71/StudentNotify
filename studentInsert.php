<?php
	ob_start();	
	session_set_cookie_params("60");
	session_start();	
	$_SESSION['logged_in'] = 'Y';
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
	
	$oldPassword=$_POST['password'];
	$newPassword=$_POST['newPassword'];
	$newPassword2=$_POST['newPassword2'];
	$firstName=$_POST['firstName'];
	$lastName=$_POST['lastName'];
	$email=$_POST['txtEmail'];
	$homeAddress=$_POST['homeAddress'];
	$hPhone=$_POST['hPhone'];
	$cPhone=$_POST['cPhone'];
	$carrier=$_POST['carrier'];
	$contactPreference=$_POST['contactPreference'];
	$major=$_POST['major'];
	$employmentStatus=$_POST['employment'];
	$educationalGoals=$_POST['educationalGoals'];	
	$hobbies=$_POST['hobbies'];
	$addCourseNumber=$_POST['addCourse'];
	$deleteCourseNumber=$_POST['deleteCourse'];	
	
	if($newPassword != ""){
		$query='SELECT Password FROM `Student` WHERE StudentID=\''.$iD.'\';';
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
	
		//the old password is right  AND newPW is the same as the retyped one
		if($oldPassword == $dBPassword && $newPassword == $newPassword2){			
			$query='UPDATE `Student` SET Password=\''.$newPassword.'\' WHERE StudentID =\''.$iD.'\';';
			$result=mysql_query($query);
			if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
			}
		}
	}
	
	/*//Password Change
	$query1='SELECT Password FROM `Student` WHERE Password = \''.$oldPassword.'\';';
	$result=mysql_query($query1);
	echo "<p>" .$result. "</p>";
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	if($result == $oldPassword){	
		if($newPassword == $newPassword2 || $newPassword != $oldPassword){
			$query='UPDATE `Student` SET Password=\''.$newPassword.'\' WHERE StudentID =\''.$iD.'\';';
			$result=mysql_query($query);
			if (!$result) {
				$message  = 'Invalid query: ' . mysql_error() . "\n";
				$message .= 'Whole query: ' . $query;
				die($message);
			}
		}
	}
		else if($result != $oldPassword){
		?>
		<script type="text/JavaScript">
		alert("Your Password you typed in the Old Password field did not match what is on file. Please try again!");
		</script>
		<?php
		}
	*/	
		
	
	
	if($firstName != ""){
		$query='UPDATE `Student` SET FirstName=\''.$firstName.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($lastName != ""){
		$query='UPDATE `Student` SET LastName=\''.$lastName.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($email != ""){
		$query='UPDATE `Student` SET Email=\''.$email.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($homeAddress != ""){
		$query='UPDATE `Student` SET Address=\''.$homeAddress.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}	
	
	if($hPhone != ""){
		$query='UPDATE `Student` SET HomePhone=\''.$hPhone.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($cPhone != ""){
		$query='UPDATE `Student` SET CellPhone=\''.$cPhone.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($carrier != ""){
		$query='UPDATE `Student` SET Carrier=\''.$carrier.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($contactPreference != ""){
		$query='UPDATE `Student` SET ContactPreference=\''.$contactPreference.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}

	if($major != ""){
		$query='UPDATE `Student` SET Major=\''.$major.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}

	if($employmentStatus != ""){
		$query='UPDATE `Student` SET EmploymentStatus=\''.$employmentStatus.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($educationalGoals != ""){
		$query='UPDATE `Student` SET EducationalGoals=\''.$educationalGoals.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($hobbies != ""){
		$query='UPDATE `Student` SET HobbiesInterests=\''.$hobbies.'\' WHERE StudentID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($addCourseNumber != ""){
		$query="INSERT INTO `Course-Student` (CourseID, StudentID) VALUES ('$addCourseNumber', '$iD');";
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($deleteCourseNumber != ""){
		$query="DELETE FROM `Course-Student` WHERE CourseID='$deleteCourseNumber' && StudentID='$iD';";
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	  	  
	header("Location: http://teacherstudent.jeffersonccit.com/StudentView_Edit.php");
	
	mysql_close($conn);
	ob_end_flush( );
?>


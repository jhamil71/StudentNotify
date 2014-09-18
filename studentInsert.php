<?php
	ob_start();	
	session_set_cookie_params("60");
	session_start();	
	$_SESSION['logged_in'] = 'Y';
	session_set_cookie_params("60");
	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$loginPassWord = $_SESSION["txtPassword"];
	
	require("db_connect.php");
	
	$oldPassword=$_POST['password'];
	$newPassword=$_POST['newPassword'];
	$newPassword2=$_POST['newPassword2'];
	$firstName=$_POST['firstName'];
	$email=$_POST['txtEmail'];
	$cPhone=$_POST['cPhone'];
	$carrier=$_POST['carrier'];
	$contactPreference=$_POST['contactPreference'];
	$addCourseNumber=$_POST['addCourse'];
	$deleteCourseNumber=$_POST['deleteCourse'];	
	
	if($newPassword != ""){
		$query='SELECT Password FROM `User` WHERE UserID=\''.$iD.'\';';
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
			$query='UPDATE `User` SET Password=\''.$newPassword.'\' WHERE UserID =\''.$iD.'\';';
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
		$query='UPDATE `User` SET FirstName=\''.$firstName.'\' WHERE UserID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($lastName != ""){
		$query='UPDATE `User` SET LastName=\''.$lastName.'\' WHERE UserID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($email != ""){
		$query='UPDATE `User` SET Email=\''.$email.'\' WHERE UserID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($homeAddress != ""){
		$query='UPDATE `User` SET Address=\''.$homeAddress.'\' WHERE UserID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}	
	
	if($hPhone != ""){
		$query='UPDATE `User` SET HomePhone=\''.$hPhone.'\' WHERE UserID =\''.$iD.'\';';
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($cPhone != ""){
		$query='UPDATE `User` SET CellPhone=\''.$cPhone.'\' WHERE UserID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($carrier != ""){
		$query='UPDATE `User` SET Carrier=\''.$carrier.'\' WHERE UserID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($contactPreference != ""){
		$query='UPDATE `User` SET ContactPreference=\''.$contactPreference.'\' WHERE UserID =\''.$iD.'\';';
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($addCourseNumber != ""){
		$query="INSERT INTO `Course-Student` (CourseID, UserID) VALUES ('$addCourseNumber', '$iD');";
		$result=mysql_query($query);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	
	if($deleteCourseNumber != ""){
		$query="DELETE FROM `Course-Student` WHERE CourseID='$deleteCourseNumber' && UserID='$iD';";
		$result=mysql_query($query);		
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}
	  	  
	header("Location: viewEdit.php");
	
	mysql_close($conn);
	ob_end_flush( );
?>


<?php
	ob_start();
	
	session_set_cookie_params("60");
	session_start();
		
	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$loginPassWord = $_SESSION["txtPassword"];
	$course = $_POST['course_select'];
		
	ob_end_flush( );
	require("db_connect.php");
?>

<!DOCTYPE html> 
<html>
<head>
	<title>Notify an Instructor</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<div id="textFields">
		<img src="images/Top.png" />
		<div id="navTop">
			<a href="studentIndex.php"> Home </a>
		</div>
		<div id="navTop">
			<a href="index.html"> Sign Out </a>
		</div>

		<fieldset>
			<table border="1" cellpadding="5">
				<tr>
					<th> Instructor </th>
					<th> Course </th>
				</tr>

<?php
	//select TeacherID and CourseID from Database
	$query='SELECT UserID FROM `Course` WHERE CourseID = \''.$course.'\';';
	$result=mysql_query($query);							
	
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	else{
		while($row = mysql_fetch_array($result)) {
			$dBTeacherID = $row['UserID'];
			$_SESSION['SendToID'] = $dBTeacherID;
		}
	}
	
	$query='SELECT * FROM `User` WHERE UserID = \''.$dBTeacherID.'\';';
	$result=mysql_query($query);				
	
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}			
	else{
		while($row = mysql_fetch_array($result)) {
			$dBName = $row['Name'];
		}
	}
	
	//Diplay values
	echo "<tr>";
	echo "<td>".$dBName."</a></td>";
	echo "<td>".$course."</td>";
	echo "</tr>";
	
?>				
		</table>
		<hr />
		<p>
		<label> <span id="maroon">Message:</span>
		<br />

		<form name="frmRegister" method="post" action="studentSend.php"  onsubmit="return validate(this);">		

		<label for="txtMessage"><textarea name="txtMessage" id="txtMessage" cols="40" rows="6"></textarea></label>
						
		</p>
		<hr />
		<input  class="red" type="submit" value="Notify Instructor">
	</form>

</fieldset>

</div>
<script type="text/JavaScript">
function validate(form) {
	var returnValue = true;
	var message = form.txtMessage.value;
	if(message > 0) {
		returnValue = false;
		alert("The message you are attemping to send is blank. Please fill in the message box, and try again.");
		frmRegister.txtMessage.focus();
	} else {
		alert("Your message was sent successfully.");
	}
	return returnValue;
}

</script>
</body>
</html>

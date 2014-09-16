<?php
	ob_start();
	
	session_set_cookie_params("60");
	session_start();
		
	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$loginPassWord = $_SESSION["txtPassword"];
	$iD2 = $_POST['course_select'];
		
	ob_end_flush( );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml">



<head>
      <title>
				Notify an Instructor
	  </title>

<link rel="stylesheet" type="text/css" href="FMSstyles.css" />

<script type="text/JavaScript">



function validate(form) {
  var returnValue = true;
  var message = form.txtMessage.value;

		if(message > 0) {
		  returnValue = false;
		  alert("The message you are attemping to send is blank. Please fill in the message box, and try again.");
		  frmRegister.txtMessage.focus();
		}
		else {
			alert("Your message was sent successfully.");
			}
			return returnValue;
}

</script>
</head>
<body>

	<div id="textFields">
		<img src="images/Top.png" />
		<div id="navTop">
			<a href="studentIndex.php"> Home </a>
		</div>
		<div id="navTop">
			<a href="studentIndex.php"> Back </a>
		</div>
		<div id="navTop">
			<a href="index.html"> Sign Out </a>
		</div>

		<fieldset>
			<table border="2" cellpadding="5">
				<tr>
					<th> Instructor </th>
					<th> Course </th>
				</tr>

<?php
	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";
	$password = "Teacher1!";

	$conn = mysql_connect($hostname, $username, $password) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);
	
	//select TeacherID and CourseID from Database
	$query='SELECT TeacherID FROM `Course` WHERE CourseID = \''.$iD2.'\';';
	$result=mysql_query($query);							
	
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	else{
		while($row = mysql_fetch_array($result)) {
			$dBTeacherID = $row['TeacherID'];
			$_SESSION['SendToID'] = $dBTeacherID;
		}
	}
	
	$query='SELECT * FROM `Teacher` WHERE TeacherID = \''.$dBTeacherID.'\';';
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
	
	//Diplay values
	echo "<tr>";
	echo "<td><a href='http://teacherstudent.jeffersonccit.com/studentViewInstructor.php'>".$dBCombined."</a></td>";
	echo "<td>".$iD2."</td>";
	echo "</tr>";
	
?>
				<form method="post" name="okaythen">
				
				</form>
					
			</table>

					<hr />

		<p>

					<label> <span id="maroon">Message:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>

					<br />

					<br />

					<span id="note">Enter your message below

			<br /> and hit send when you're finished.</span>

			<br />

			<form name="frmRegister" method="post" action="studentNotify.php"  onsubmit="return validate(this);">

				<script type="text/javascript" src="nicEdit.js"></script>

				<script type="text/javascript">

					bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

				</script>

				

				<label for="txtMessage"><textarea name="txtMessage" id="txtMessage" cols="40" rows="6"></textarea></label>
			
						
		</p>

						<hr />

						<input  class="red" type="submit" value="Notify Instructor">

			</form>

		</fieldset>

		</div>

	</body>

	

</html>
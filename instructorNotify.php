<?php

	ob_start();	
	session_set_cookie_params("60");
	session_start();	
	$_SESSION['logged_in'] = 'Y';
	$iDs = $_POST['course_select'];
	$_SESSION['course_select'] = $iDs;
	ob_end_flush( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <title>
			Notifications	  </title>
<link rel="stylesheet" type="text/css" href="FMSstyles.css" /><script type="text/JavaScript">
function validate(form) {
  var returnValue = true;
  var message = form.txtMessage.value;

	if(message > 0) {
	  returnValue = false;
	  alert("The message you are attemping to send is blank. Please fill in the message box, and try again.");
	  frmRegister.txtMessage.focus();
	}
		else 
			alert("Your message was sent successfully.");
			return returnValue;
		}
</script>

<script language="javascript">
function checkAll(){
	for (var i=0;i<document.forms[0].elements.length;i++){
		var e=document.forms[0].elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox')){
			e.checked=document.forms[0].allbox.checked;
		}
	}
}
</script>
</head>
<link rel="stylesheet" type="text/css" href="FMSstyles.css" />
<body>	<div id="textFields">
		<img src="images/Top.png" />
		<div id="navTop">
			<a href="instructorIndex.php"> Home </a>
		</div>
		<div id="navTop">
			<a href="index.html"> Sign Out </a>
		</div>	
		<fieldset>
		
		
			
			<p>
				To notify one or multiple students, please check the box for each
				student you would like to send a message to, and click "Notify Student(s)"
				at the bottome of the page.
			</p>
		
			<hr />
			<form method="post" action="http://teacherstudent.jeffersonccit.com/instructorNotifyStudent.php"  onsubmit="return validate(this);">
				<input type="checkbox" value="on" name="allbox" onclick="checkAll()"/> Check all<br />
				<hr />
				<table border="2" cellpadding="5">
					<tr><th> Notify Student(s) </th></tr>
						
<?php
	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";	
	$password = "Teacher1!";
	$conn = mysql_connect($hostname, $username, $password) OR DIE
	("Unable to connect to database! Please try again later.");	
	mysql_select_db($dbname);
								
	

	$query = 'SELECT * FROM `Course-Student` WHERE CourseID = \''.$iDs.'\';';
	$result=mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	while($row = mysql_fetch_array($result)){
		$dBStudentID = $row['StudentID'];
		echo "<!---".$row['StudentID']." ".$dBStudentID."-->\n";
		$query='SELECT * FROM `Student` WHERE StudentID = \''.$dBStudentID.'\';';
		$result2=mysql_query($query);
		if (!$result2) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		else{			
			//echo "<p>TEST:   ".$dBStudentID."</p>\n";
			while($row = mysql_fetch_array($result2)){
				$dBFirstName = $row['FirstName'];
				$dBLastName = $row['LastName'];
				$namesCombined ="$dBFirstName $dBLastName";
				$cbValue = $row[$dBStudentID];
				echo "<!---".$dBStudentID." ".$cbValue."-->\n";	
				echo "<tr><td><input type='checkbox' value='".$dBStudentID."' name='checked_all[]' onclick='checked'/>".$namesCombined."</td></tr>\n";
			}			
		}
	}								
?>

</table>
			<hr />
			<p>
				<label> <span id="maroon">Message:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span></label>
			</p>
			<span id="note">Enter your message below <br /> and hit send when you're finished.</span>
			<br />
			<form name="frmRegister" >
				<script type="text/javascript" src="nicEdit.js"></script>
				<script type="text/javascript">
					bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
				</script>
				<label for="txtMessage"><textarea name="txtMessage" id="txtMessage" cols="40" rows="6"></textarea></label>
				<hr />
				<input  class="red" type="submit" value="Notify Student(s)"/>
			</form>
		</form>	
		</fieldset>
	</div>
</body>
	
</html>
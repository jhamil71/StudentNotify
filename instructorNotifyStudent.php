<?php

	ob_start();	
	session_set_cookie_params("60");
	session_start();	
	$_SESSION['logged_in'] = 'Y';
	$iDs = $_POST['course_select'];
	$_SESSION['course_select'] = $iDs;
	ob_end_flush( );
	require("db_connect.php");
?>
<!DOCTYPE html> 
<html>
<head>
	<title>Notifications</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>	
<div id="textFields">
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
		<form method="post" action="instructorSend.php"  onsubmit="return validate(this);">
			<input type="checkbox" value="on" name="allbox" onclick="checkAll()"/> Check all<br />
			<hr />
			<table border="2" cellpadding="5">
				<tr><th> Notify Student(s) </th></tr>
						
<?php
	$query = 'SELECT UserID FROM `Course-Student` WHERE CourseID = \''.$iDs.'\';';
	
	$result=mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	while($row = mysql_fetch_array($result)){
		$dBStudentID = $row['UserID'];
		$query='SELECT Name FROM `User` WHERE UserID = \''.$dBStudentID.'\';';
		$result2=mysql_query($query);
		if (!$result2) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		else{
			while($row = mysql_fetch_array($result2)){
				$dBName = $row['Name'];
				echo "<tr><td><input type='checkbox' value='".$dBStudentID."' name='checked_all[]' onclick='checked'/>".$dBName."</td></tr>\n";
			}			
		}
	}								
?>
</table>
			<hr />
			<p>
				<label> <span id="maroon">Message:</span></label>
			</p>
			<label for="txtMessage"><textarea name="txtMessage" id="txtMessage" cols="40" rows="6"></textarea></label>
			<hr />
			<input class="red" type="submit" value="Notify Student(s)"/>
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
	}
	else {
		alert("Your message was sent successfully.");
		return returnValue;
	}
}

function checkAll(){
	for (var i=0;i<document.forms[0].elements.length;i++){
		var e=document.forms[0].elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox')){
			e.checked=document.forms[0].allbox.checked;
		}
	}
}
</script>
</body>
</html>

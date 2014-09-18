<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == "N") {
		header("Location: signin.html");
		session_destroy();
		exit();
	}

	session_set_cookie_params("60");
	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$loginPassWord = $_SESSION["txtPassword"];
	ob_end_flush( );
	require("db_connect.php");
?>



<!DOCTYPE html> 
<html>
<head>
	<title>View/Edit</title>
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
		<br />
		<br />
		<br />
			<div id="banners">Current Account Information</div>

			<fieldset>		
			<br />
			<br />
			<table>
<?php			
	//echo "<p>".$iD."</p>\n";	

	//select table from a databse

	$query='SELECT * FROM `User` WHERE UserID = \''.$iD.'\';';
	//select table from a databse
	$result=mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	else {
		while($row = mysql_fetch_array($result)) {
			$dBName = $row['Name'];
			$dBPhone = $row['CellPhone'];
			$dBCarrier = $row['Carrier'];
			$dBEmail = $row['Email'];
			$dBContactPreference = $row['ContactPreference'];
		
			echo "<tr><td>Name:</td><td>$dBName</td></tr>";
			echo "<tr><td>Email:</td><td>$dBEmail</td></tr>";
			echo "<tr><td>Cell Phone:</td><td>$dBPhone</td></tr>";
			echo "<tr><td>Carrier:</td><td>$dBCarrier</td></tr>";
			echo "<tr><td>Contact Preference:</td><td>$dBContactPreference</td></tr>";			
		}
	}
?>
</table><br /><br />
<form name="frmRegister" method="post" action="studentInsert.php"  onsubmit="return validate(this);">
		<table border="1">
				<tr><th> Courses </th>
				</tr>

<?php
	$query='SELECT CourseID FROM `Course-Student` WHERE UserID = \''.$iD.'\';';
	$result=mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	else {
		while($row = mysql_fetch_array($result)) {
			$dBCourse = $row['CourseID'];
			echo "<tr><td>".$dBCourse. "</td></tr>";				
		}			
	}

?>			
		</table>

			</fieldset>
			<div id="banners">Edit Account Information</div>			
		<fieldset>
			<h3><em><center>The above information is what is on file.<br />	
			If any of this information is incorrect or needs to be updated,<br />	
			 make the necessary changes below.</center></em></h3>
					<hr />

					<div id="textFields">
						<p>							<label> <span id="maroon">Old Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>							
						<input type="text" name="password" /> </label>						</p>
						<p>								<label> <span id="maroon">New Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>							
						<input type="text" name="newPassword" /> </label>
						</p>
						<p>
							<label> <span id="maroon">Retype New Password: </span> <input type="text" name="newPassword2" /> </label>
						</p>
					</div>
					<hr />
					<p>
					<label for="txtEmail"> <span id="maroon">Email:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span></label>
					<input type="email" name="txtEmail" id="txtEmail" size="12" />
					</p>

					<hr />
					<center><p><span id="note-red">Please enter the cell phone number without symbols (like 5558761234). 555-876-1234 or (555)876-1234 are invalid entries.
					</span></p></center>
						<label> <span id="maroon">Cell Phone Number: </span><input type="text" name="cPhone" /> </label>
					</p>
					<p>
						<label> <span id="maroon">
					Cell Phone Carrier: </span> <select type="dropCarrier"
					name="carrier" id="carrier">
						<option value=""></option>
						<option value="AT&T"> AT&T </option>
						<option value="Verizon"> Verizon </option>
						<option value="Sprint"> Sprint </option>
						<option value="T-Mobile"> T-Mobile </option>
						
					</select> </label>
					</p>
					<label> <span id="maroon">
					Contact Preference: </span> <select type="dropContact"
					name="contactPreference" id="contactPreference">
						<option value=""></option>
						<option value="Email"> Email </option>
						<option value="Text"> Text </option>
						
					</select> </label>
					</p>
					<hr />
			<table border="2" cellpadding="5">
					<tr>
						<th> Add Courses </th>
					</tr>
					
<?php			
	//echo "<p>".$iD."</p>\n";

	//select table from a databse
	$query='SELECT CourseID FROM `Course`;';
	$result=mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
		}
		else {
			echo "<tr><td>\n<select name = 'addCourse' id='course_select' size = '5'>\n";
			while($row = mysql_fetch_array($result)) {
				$dBCourseID = $row['CourseID'];
				echo "<option>".$dBCourseID."</option>\n";
			}
			echo "</select>\n</td>\n";
		}						
?>									
	<table border="2">				
	<tr>
	<th> Delete Courses </th>
	</tr>
<?php
	$query='SELECT CourseID FROM `Course-Student` WHERE UserID = \''.$iD.'\';';	
	$result=mysql_query($query);			
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";		
			$message .= 'Whole query: ' . $query;	die($message);		
		}
		else {
			echo "<div id = 'courseChoices'><tr><td>\n<select name = 'deleteCourse' id='course_select' size = '5'>\n";
			while($row = mysql_fetch_array($result)) {
				$dBCourseID = $row['CourseID'];
				echo "<option>".$dBCourseID."</option>\n";
			}
			echo "</select>\n</td></div>\n";	
		}
?>
					</table>					
		
			<hr />
			
				<input  class="red" type="submit" value="Apply">
			</form>
		</fieldset>
	</div>
<script type="text/JavaScript">
function validate(form) {
	return alert("Any account changes have been Applied.\n\nNOTE:\nIf a field was not filled the information was not changed.");
}
</script>
</body>
</html>

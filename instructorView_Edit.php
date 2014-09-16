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
	ob_end_flush( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

      <title>
	  Instructor View/Edit
	  </title>
	   <link rel="stylesheet" type="text/css" href="FMSstyles.css" />
 <script type="text/JavaScript">

		function validate(form) {
		  return alert("Any account changes have been Applied.\n\nNOTE:\nIf a field was not filled the information was not changed.");
		}

</script>
	</head>

	<body>
	
	<div id="textFields">
		<img src="images/Top.png" />
		<br />
		
		<div id="navTop">
			<a href="instructorIndex.php"> Home </a>
		</div>
		<div id="navTop">
			<a href="index.html"> Sign Out </a>
		</div>
		
		<br />
			<br />
			<div id="banners">Current Account Information</div>
			
			<fieldset>	
			<br />
			<br />			
<?php					
	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";
	$password = "Teacher1!";

	$conn = mysql_connect($hostname, $username, $password) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);			
	//echo "<p>".$iD."</p>\n";

	//select table from a database
	$query='SELECT * FROM `Teacher` WHERE TeacherID = \''.$iD.'\';';
	//select table from a database

	$result=mysql_query($query);
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	else {
		while($row = mysql_fetch_array($result)) {
			$dBFirstName = $row['FirstName'];
			//$dBPassword = $row['Password'];
			$dBLastName = $row['LastName'];
			$dBcPhone = $row['CellPhone'];
			$dBEmail = $row['Email'];
			$dBOfficeLocation = $row['OfficeLocation'];
			$dBMONOfficeHours = $row['MondayOfficeHours'];
			$dBTUESOfficeHours = $row['TuesdayOfficeHours'];
			$dBWENSOfficeHours = $row['WednesdayOfficeHours'];
			$dBTHURSOfficeHours = $row['ThursdayOfficeHours'];
			$dBFRIOfficeHours = $row['FridayOfficeHours'];
			$dBOfficePhone = $row['OfficePhone'];
?>				
		<table>
<?php
			echo "<tr><td>First Name:</td><td>$dBFirstName</td></tr>";
			echo "<tr><td>Last Name:</td><td>$dBLastName</td></tr>";
			echo "<tr><td>Cell Phone:</td><td>$dBcPhone</td></tr>";							
			echo "<tr><td>Office Location: </td><td>$dBOfficeLocation</td></tr>";
			echo "<tr><td>Office Hours: </td><td>Monday:</td><td>$dBMONOfficeHours</td></tr>";
			echo "<tr><td> </td><td>Tuesday:</td><td>$dBTUESOfficeHours</td></tr>";
			echo "<tr><td> </td><td>Wednesday:</td><td>$dBWENSOfficeHours</td></tr>";
			echo "<tr><td> </td><td>Thursday:</td><td>$dBTHURSOfficeHours</td></tr>";
			echo "<tr><td> </td><td>Friday:</td><td>$dBFRIOfficeHours</td></tr>";							
			echo "<tr><td>Office Phone: </td><td>$dBOfficePhone</td></tr>";	
?>
		</table>
		<table>
<?php
			echo "<tr><td>Email:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td>$dBEmail</td></tr>";							
?>
		</table>
<?php				
		}
	}
?>		
					<br />
					<br />
			
<table border="2">
				<tr><th> Courses </th>
				</tr>

<?php
	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";
	$password = "Teacher1!";

	$conn = mysql_connect($hostname, $username, $password) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);		

	$query='SELECT CourseID FROM `Course` WHERE TeacherID = \''.$iD.'\';';
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
	</div>
			</fieldset>
			<br />
			<br />
<form name="frmRegister" method="post" action="instructorInsert.php"  onsubmit="return validate(this);">	
					<br />
					<div id="banners">Edit Account Information</div>
			<fieldset>
					
					<div id="textFields">
					
						<h3><em><center>The information above is the information that we currently on file.
						<br />If any of this information is incorrect, or needs to be updated,<br />
						please make the necessary changes below.</center></em></h3>
						
						<hr />
						<hr />
						
						<div id="nav-buttons">
							<div id="textFields">
								<p>
								<label> <span id="maroon">Old Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>
								<input type="text" name="oldPassword" /> </label>
								</p>
								<p>
								<label> <span id="maroon">New Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>
								<input type="text" name="newPassword" /> </label>
								</p>
								<p>
								<label> <span id="maroon">Retype New Password: </span> 
								<input type="text" name="newPassword2" /> </label>
								</p>
							</div>
							<hr />
							<p>
							<label> <span id="maroon">First Name:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>
							<input type="text" name="firstName" /> </label>
							<label> <span id="maroon">Last Name: </span>
							<input type="text" name="lastName" /> </label>
							</p>
							<hr />
							<center><p><span id="note-red">
					<span id = "red">*</span>Office and Cell phone format does not have symbols e.g 5558761234!! Not like 555-876-1234 or not like (555)876-1234!!<span id = "red">*</span>
					</span></p></center>
							<p>
							<label> <span id="maroon">Cell Phone: </span>
							<input type="text" name="cPhone" /> </label>
							</p>
							<p>
							<label> <span id="maroon">Office Phone Number:&nbsp&nbsp&nbsp&nbsp&nbsp </span>
							<input type="text" name="oPhone" /> </label>
							</p>
							<p>
							<label> <span id="maroon">Email:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>
							<input type="text" name="email" /> </label>
							</p>
							<p>
							<label> <span id="maroon">Office Location:&nbsp&nbsp&nbsp&nbsp&nbsp </span>
							<input type="text" name="oLocation" /> </label>
							</p>
							<p>
							<label> <span id="maroon">Monday Office Hours:&nbsp&nbsp&nbsp&nbsp&nbsp </span>
							<input type="text" name="mOfficeHour" /> </label>
							</p>
							<p>
							<label> <span id="maroon">Tuesday Office Hours:&nbsp&nbsp&nbsp&nbsp&nbsp </span>
							<input type="text" name="tOfficeHour" /> </label>
							</p>
							<p>
							<label> <span id="maroon">Wednesday Office Hours:&nbsp&nbsp&nbsp&nbsp&nbsp </span>
							<input type="text" name="wOfficeHour" /> </label>
							</p>
							<p>
							<label> <span id="maroon">Thursday Office Hours:&nbsp&nbsp&nbsp&nbsp&nbsp </span>
							<input type="text" name="thOfficeHour" /> </label>
							</p>
							<p>
							<label> <span id="maroon">Friday Office Hours:&nbsp&nbsp&nbsp&nbsp&nbsp </span>
							<input type="text" name="fOfficeHour" /> </label>
							</p>
							
							
							
								
									<input  class="red" type="submit" value="Apply">
								</form>
										
						</div>
					</div>
					
												
			</fieldset>
</body>
	
</html>	
<?php
ob_start();
	session_start();
	if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == "N") {
		header("Location: http://teacherstudent.jeffersonccit.com/signin.html");
		session_destroy();
		exit();
	}
	session_set_cookie_params("60");
	$_SESSION["logged_in"] = "Y";
	
	$dBTeacherID = $_SESSION['SendToID'];
	ob_end_flush( );
	require("db_connect.php");
?>		
	
<!DOCTYPE html> 
<html>
<head>
	<title>Viewing Instructors Account</title>
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
			<p><center><font size="5" face="verdana" color="green">Instructor's Information</font></center></p>
		
<?php
	//echo "<p>TEST:   ".$dBTeacherID."</p>\n";
	
	
	$query='SELECT * FROM `Teacher` WHERE TeacherID = \''.$dBTeacherID.'\';';
	$result=mysql_query($query);
	
	if (!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message = 'Whole query: ' . $query;
		die($message);
	}
	else {
		while($row = mysql_fetch_array($result)) {
			$dBTeacherID = $row['TeacherID'];
			$dBFirstName = $row['FirstName'];
			$dBLastName = $row['LastName'];
			$dBOfficeLocation = $row['OfficeLocation'];
			$dBOfficePhone = $row['OfficePhone'];
			$dBcPhone = $row['CellPhone'];
			$dBEmail = $row['Email'];
			$dBMONOfficeHours = $row['MondayOfficeHours'];
			$dBTUESOfficeHours = $row['TuesdayOfficeHours'];
			$dBWENSOfficeHours = $row['WednesdayOfficeHours'];
			$dBTHURSOfficeHours = $row['ThursdayOfficeHours'];
			$dBFRIOfficeHours = $row['FridayOfficeHours'];
					
?>
<table >
<?php			
	echo "<tr><td>First Name:</td><td>$dBFirstName</td></tr>";
	echo "<tr><td>Last Name:</td><td>$dBLastName</td></tr>";		
	echo "<tr><td>Office Phone:</td><td>$dBOfficePhone</td></tr>";
	echo "<tr><td>Cell Phone:</td><td>$dBcPhone</td></tr>";
	echo "<tr><td>Office Location:</td><td>$dBOfficeLocation</td></tr>"; 
	echo "<tr><td>Office Hours: </td><td>Monday:</td><td>$dBMONOfficeHours</td></tr>";
	echo "<tr><td> </td><td>Tuesday:</td><td>$dBTUESOfficeHours</td></tr>";
	echo "<tr><td> </td><td>Wednesday:</td><td>$dBWENSOfficeHours</td></tr>";
	echo "<tr><td> </td><td>Thursday:</td><td>$dBTHURSOfficeHours</td></tr>";
	echo "<tr><td> </td><td>Friday:</td><td>$dBFRIOfficeHours</td></tr>";							
			
?>
		</table>
		<table>
<?php
	echo "<tr><td>Email:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td>$dBEmail</td></tr>";										
?>
</table><br />
<?php
				}
			}
?>							
			</fieldset>
		</div>
	</body>	
</html>

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
	//trying this...
	$txtFirstName = $_POST['txtFirstName'];
	$txtLastName = $_POST['txtLastName'];
	ob_end_flush( );
	require("db_connect.php");
?>		
	

<!DOCTYPE html> 
<html>
<head>
	<title>Viewing Student Account</title>
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
			<p><center><font size="5" face="verdana" color="green">Student's Information</font></center></p>
		
<?php
	$query='SELECT * FROM `Student` WHERE FirstName = \''.$txtFirstName.'\' && LastName = \''.$txtLastName.'\';';
	$result=mysql_query($query);
	
	if (!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message = 'Whole query: ' . $query;
		die($message);
	}
	else {
		while($row = mysql_fetch_array($result)) {
			$dBStudentID = $row['StudentID'];
			$dBFirstName = $row['FirstName'];
			$dBLastName = $row['LastName'];
			$dBAddress = $row['Address'];
			$dBhPhone = $row['HomePhone'];
			$dBcPhone = $row['CellPhone'];
			$dBEmail = $row['Email'];
			$dBMajor = $row['Major'];
			$dBEdGoals = $row['EducationalGoals'];				
			$dBEmpStatus = $row['EmploymentStatus'];
			$dBHobbies = $row['HobbiesInterests'];
?>
<table>
<?php			
			echo "<tr><td>First Name:</td><td>$dBFirstName</td></tr>";
			echo "<tr><td>Last Name:</td><td>$dBLastName</td></tr>";
			echo "<tr><td>Home Address:</td><td>$dBAddress</td></tr>"; 
			echo "<tr><td>Home Phone:</td><td>$dBhPhone</td></tr>";
			echo "<tr><td>Cell Phone:</td><td>$dBcPhone</td></tr>";
			echo "<tr><td>Email:</td><td>$dBEmail</td></tr>";
			echo "<tr><td>Major:</td><td>$dBMajor</td></tr>";
			echo "<tr><td>Educational Goals: </td><td>$dBEdGoals</td></tr>";	
			echo "<tr><td>Employment Status: </td><td>$dBEmpStatus</td></tr>";	
			echo "<tr><td>Hobbies: </td><td>$dBHobbies</td></tr>";									
?>
</table><br />
<?php
		}
	}
?>	
						<table border="2">
				<tr>					<th> Courses </th>
				</tr>

<?php
	$query='SELECT CourseID FROM `Course-Student` WHERE StudentID = \''.$dBStudentID.'\';';
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
	</div>
</body>	
</html>

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
	  Instructor Home
	  </title>
	</head>
	<link rel="stylesheet" type="text/css" href="FMSstyles.css" />
	<body>
		<div id="textFields">
			<img src="images/Top.png" />
			<br />
		
			<div id="navTop">
				<a href="index.html"> Sign Out </a>
			</div>
		<fieldset>
			<h2 size="10"><center>White Board Instructor Home</center></h2><br />					
			
			
			<p>			
				Here you can Search for students and view their 
				account information as well as edit your own account 
				and send notifications via text and email. Just click 	
				on one of the navigation buttons below to begin.
			</p>
		</fieldset>
		<br />
        	<br />		<br />
		<fieldset>
			<form action="http://teacherstudent.jeffersonccit.com/instructorNotify.php" method ="post">
			<table border='2' cellpadding='5'>	
				<tr>
					<th> Course </th>
				</tr>
<?php				
	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";
	$password = "Teacher1!";

	$conn = mysql_connect($hostname, $username, $password) OR DIE 
	("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);	

	//select table from a databse
	$query="SELECT CourseID FROM `Course` WHERE TeacherID = '".$iD."';";
	$result=mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	else {
		echo "<tr><td>\n<select name='course_select' size = '3'>\n";
		while($row = mysql_fetch_array($result)) {
			$dBCourseID = $row['CourseID'];
			echo "<option>".$dBCourseID."</option>\n";
		}
		echo "</select>\n</td>\n";
	}
	echo "<td><input type='submit' value='Notify Student(s)'></td></tr>"
?>			
								
			</table>
			</form>
			<p>
				Select one of the choices below:
			</p>
		</fieldset>
			<div id="nav-buttons-across">
			<ul>	
				<li> <a href="instructorSearchForStudents.html"> Search Students </a> </li>
				<li> <a href="instructorView_Edit.php"> View/Edit Account </a> </li>
			</ul>
		
			<br />
			<br />
			</div>
		</div>
	</body>
	
</html>
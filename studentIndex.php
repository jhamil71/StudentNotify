<?php
	ob_start();	
	session_start();
	if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == 'N') {
		header('Location: http://teacherstudent.jeffersonccit.com/signin.html');
		session_destroy();		
		exit();	
	}
	session_set_cookie_params('60');
	$_SESSION['logged_in'] = 'Y';
	$iD = $_SESSION['txtUserName'];
	$loginPassWord = $_SESSION["txtPassword"];
	ob_end_flush( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

      <title>
	  Student Home
	  </title>
	   
	</head>
	<link rel="stylesheet" type="text/css" href="FMSstyles.css" />
	<body>
		<!-- <?php
		echo "<p>TEST:   ".$_SESSION["txtUserName"]."</p>\n";
		?> -->
		<div id="textFields">
		<img src="images/Top.png" />
		
				<div id="navTop">
					<a href="index.html"> Sign Out </a>
				</div>
		
		<fieldset>
		
		<p>
		<br />
		<h2><center>White Board Student Home</center></h2><br />
		Here you can view your account information as 
		well as edit your account. By clicking on a class and then
		"Notify Instructor", you can email your Instructor as well as see a
		link where you can see the Instructor's information. 
		<p/>
		</fieldset>

		
		
		<br />
		<br />
		<fieldset><!----> 
			<form action="http://teacherstudent.jeffersonccit.com/studentNotifyInstructor.php" method ="post">	
				<table border="2" cellpadding="5">
					<tr>
						<th> Course </th>
					</tr>
			
<?php 
	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";
	$password = "Teacher1!";

	$conn = mysql_connect($hostname, $username, $password) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);			

	//select table from a databse
	$query='SELECT CourseID FROM `Course-Student` WHERE StudentID = \''.$iD.'\';';
	$result=mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	else {
		echo "<tr><td>\n<select name='course_select' size = '5'>\n";
		while($row = mysql_fetch_array($result)) {
			$dBCourseID = $row['CourseID'];
			echo "<option value='".$dBCourseID."'>".$dBCourseID."</option>\n";
		}
		echo "</select>\n</td>\n";
	}		
		echo "<td><input type='submit' value='Notify Instructor'></td></tr>"
?>		
						
					
				</table>
			</form>
        <br />
        <br />
		
		</fieldset>
							<div id="nav-buttons-across">
								<ul>
										<li> <a href="StudentView_Edit.php"> View/Edit Account </a> </li>
								</ul>
								<br />
								<br />
							</div>
		</div>
	</body>
	
</html>
<?php
	ob_start();
	session_start();
	if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == "N") {
		header("Location: signin.php");
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
	<title>Instructor Home</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<div id="textFields">
		<img src="images/Top.png" />
		<br />
	
		<div id="navTop">
			<a href="index.html">Sign Out</a>
		</div>
	<br>
	<br>
	<fieldset>
		<form action="instructorNotifyStudent.php" method ="post">
		<table border='2' cellpadding='5'>
			<tr>
				<th> Course </th>
			</tr>
<?php				
//select table from a databse
$query="SELECT CourseID FROM `Course` WHERE UserID = '".$iD."';";
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
		<br>
		<form action="demoSend.php" method ="post">
			<input type='submit' value='Send me a demo message!'>
		</form>
	</fieldset>
		<div id="nav-buttons-across">
		<ul>
			<li> <a id="nav-buttons-across" href="viewEdit.php"> View/Edit Account </a> </li>
		</ul>
		</div>
	</div>
</body>
</html>

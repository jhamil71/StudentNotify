<?php ob_start();
session_unset();
session_set_cookie_params("60");
session_start( );	
$txtID = $_POST['txtUserName'];    //was txtID
$txtPassword = $_POST['txtPassword'];

require("db_connect");

if($txtPassword[0] == 's' || $txtPassword[0] == 'S'){
	//Load the Username
		$query1="SELECT StudentID, Password FROM Student;";
		$result1=mysql_query($query1);
		$numStu=mysql_num_rows($result1);
		$cnt = 0;		
	while($cnt < $numStu){
		$temp = mysql_fetch_assoc($result1);
		if($txtID == $temp['StudentID'] && $txtPassword == $temp['Password']){
			$_SESSION['logged_in'] = 'Y';
			$_SESSION['txtUserName'] = $txtID;
			$_SESSION['txtPassword'] = $txtPassword;
			header("Location: http://teacherstudent.jeffersonccit.com/studentIndex.php");
			exit(0);
		}
		$cnt++;		
	}
				
	if($_SESSION['logged_in'] != 'Y'){
		?>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<div id="textFields">
		<img src="images/Top.png" />

		<fieldset>
		<form name='invalidLogin' method='post' action='signin.html'  onsubmit='return validate(this);'>
		<p>
		Invalid User Name or Password. Please try again.
		</p>
		<input  class='red' type='submit' value='Back to Login'>
		</form>
		<?php
		}
}
else if($txtPassword[0] == 'T' || $txtPassword[0] == 't'){
	//Load the Username
		$query3="SELECT TeacherID, Password FROM Teacher";
		$result3=mysql_query($query3);
		$numTeacher=mysql_num_rows($result3);
	//echo "this is numTeacher = " . $numTeacher . "<p>";
	$cnt = 0;
	while($cnt < $numTeacher){
		$temp = mysql_fetch_assoc($result3);
		if($txtID == $temp['TeacherID'] && $txtPassword == $temp['Password']){
			$_SESSION['logged_in'] = 'Y';
			$_SESSION['txtUserName'] = $txtID;
			$_SESSION['txtPassword'] = $txtPassword;
			header("Location: http://teacherstudent.jeffersonccit.com/instructorIndex.php");
			exit(0);
			
		}
		$cnt++; 
	}
		
	if($_SESSION['logged_in'] != 'Y'){
		?>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<div id="textFields">
		<img src="images/Top.png" />

		<fieldset>
		<form name='invalidLogin' method='post' action='signin.html'  onsubmit='return validate(this);'>
		<p>
		Invalid User Name or Password. Please try again.
		</p>
		<input  class='red' type='submit' value='Back to Login'>
		</form>
		<?php
	}
}
else if($_SESSION['logged_in'] != 'Y'){
	?>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<div id="textFields">
	<img src="images/Top.png" />

	<fieldset>
	<form name='invalidLogin' method='post' action='signin.html'  onsubmit='return validate(this);'>
	<p>
	Invalid User Name or Password. Please Try again.
	</p>
	<input  class='red' type='submit' value='Back to Login'>
	</form>
						
<?php
	}
		
ob_end_flush( );
?>

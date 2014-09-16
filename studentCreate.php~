<?php
	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";
	$password = "Teacher1!";
		  
	$conn = mysql_connect($hostname, $username, $password) OR 
	DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);

	$userName2 = $_POST['txtUserName'];
	$password2 = $_POST['txtPassword'];
	$firstName = $_POST['txtFirstName'];
	$lastName = $_POST['txtLastName'];
	$hPhone = $_POST['hPhone'];
	$cPhone = $_POST['cPhone'];
	$email = $_POST['txtEmail'];
	$contactP = $_POST['contactPreference'];
	$carrier = $_POST['carrier'];

	$query="INSERT INTO Student (StudentID, Password,
		FirstName, LastName, HomePhone, CellPhone,
		Email, ContactPreference, Carrier)
		VALUES('$userName2','$password2','$firstName',
		'$lastName','$hPhone','$cPhone',
		'$email','$contactP',
		'$carrier');";
	$result=mysql_query($query);

	header("Location: http://teacherstudent.jeffersonccit.com/signin.html");

	mysql_close($conn);
?>
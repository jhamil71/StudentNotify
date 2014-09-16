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

			Student View/Edit

		  </title>

		   <link rel="stylesheet" type="text/css" href="FMSstyles.css" />

		   <script type="text/JavaScript">

				function validate(form) {

				  return alert("Any account changes have been Applied.\n\nNOTE:\nIf a field was not filled the information was not changed.");;

			}

			</script>
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
<?php

	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";
	$password = "Teacher1!";	

	$conn = mysql_connect($hostname, $username, $password) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);			

	//echo "<p>".$iD."</p>\n";	

	//select table from a databse

	$query='SELECT * FROM `Student` WHERE StudentID = \''.$iD.'\';';
	//select table from a databse
	$result=mysql_query($query);

	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	else {
		while($row = mysql_fetch_array($result)) {
			$dBFirstName = $row['FirstName'];
			$dBLastName = $row['LastName'];
			$dBAddress = $row['Address'];
			$dBhPhone = $row['HomePhone'];
			$dBcPhone = $row['CellPhone'];
			$dBCarrier = $row['Carrier'];
			$dBEmail = $row['Email'];
			$dBContactPreference = $row['ContactPreference'];
			$dBEdGoals = $row['EducationalGoals'];
			$dBMajor = $row['Major'];
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
			echo "<tr><td>Carrier:</td><td>$dBCarrier</td></tr>";
			echo "<tr><td>Email:</td><td>$dBEmail</td></tr>";
			echo "<tr><td>Contact Preference:</td><td>$dBContactPreference</td></tr>";
			echo "<tr><td>Major:</td><td>$dBMajor</td></tr>";
			echo "<tr><td>Educational Goals: </td><td>$dBEdGoals</td></tr>";
			echo "<tr><td>Employment Status:</td><td>$dBEmpStatus</td></tr>";
			echo "<tr><td>Hobbies:</td><td>$dBHobbies</td></tr>";
					
?>
</table><br /><br />
<?php				
		}
	}
?>
<form name="frmRegister" method="post" action="studentInsert.php"  onsubmit="return validate(this);">
		<table border="2">
				<tr>					<th> Courses </th>
				</tr>

<?php

	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";
	$password = "Teacher1!";

	$conn = mysql_connect($hostname, $username, $password) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);		

	$query='SELECT CourseID FROM `Course-Student` WHERE StudentID = \''.$iD.'\';';
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
			<br />
			<br />
			<br />
			<div id="banners">Edit Account Information</div>			
		<fieldset>
			<h3><em><center>The above information is what is on file.<br />	
			If any of this information is incorrect or needs to be updated,<br />	
			 make the necessary changes below.</center></em></h3>
					<hr />
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
					<p>						<label> <span id="maroon">First Name:&nbsp&nbsp&nbsp&nbsp&nbsp </span> <input type="text" name="firstName" /> </label>
					</p>
					<p>
						<label> <span id="maroon">Last Name:&nbsp&nbsp&nbsp&nbsp&nbsp </span> <input type="text" name="lastName" /> </label>
					</p>
					<hr />
					<p>
					<label for="txtEmail"> <span id="maroon">Email:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span></label>
					<input type="email" name="txtEmail" id="txtEmail" size="12" />
					</p>
					<p>
						<label> <span id="maroon">Home Address:&nbsp&nbsp&nbsp&nbsp&nbsp </span> <input type="text" name="homeAddress" /> </label>
					</p>
					<hr />
					<center><p><span id="note-red">
					<span id = "red">*</span>Home and Cell phone numbers do not have symbols e.g 5558761234. 555-876-1234 or (555)876-1234 are invalid entries.<span id = "red">*</span>
					</span></p></center>
					<p>						<label><span id="maroon">Home Phone:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span><input type="text" name="hPhone" /> </label>
						<label> <span id="maroon">Cell Phone: </span><input type="text" name="cPhone" /> </label>
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
						<option value="email"> Email </option>
						<option value="text"> Text </option>
						
					</select> </label>
					</p>
					<hr />
					<p>
						<label> <span id="maroon">Major:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>
						<input type="text" name="major" /> </label>
					</p>
					<hr />
					<p>
						<label> <span id="maroon">Educational Goals:&nbsp&nbsp&nbsp </span>
						<select type="dropEdGoals" name="educationalGoals" id="educationalGoals">
						<option value=""></option>
						<option value="2 year degree"> 2 year degree </option>
						<option value="4 year degree"> 4 year degree </option>
						<option value="Master's"> Master's </option>
						<option value="Doctorate"> Doctorate </option>
					</select> </label>
					</p>
					<p>
						<label> <span id="maroon">Employment Status:&nbsp </span>
						<select type="dropEmployment" name="employment" id="employment">
						<option value=""></option>
						<option value="Full-time"> Full-time </option>
						<option value="Part-time"> Part-time </option>
						<option value="Unemployed"> Unemployed </option>
					</select> </label>
					</p>
					<hr />
					<p>
					<label> <span id="maroon">Hobbies/Interests:&nbsp </span>
					<br />
					<br />
					<!-- Below is the actual text box. Above is the script for font options -->
						<label for="hobbies"><textarea name="hobbies" id="hobbies" cols="40" rows="6"></textarea></label>
					</p>
					
					
					
					<hr />
			<table border="2" cellpadding="5">
					<tr>
						<th> Add Courses </th>
					</tr>
					
<?php 
	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";
	$password = "Teacher1!";

	$conn = mysql_connect($hostname, $username, $password) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);			
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
	$hostname = "teacherstudent.db.10405859.hostedresource.com";
	$username = "teacherstudent";
	$dbname = "teacherstudent";	
	$password = "Teacher1!";
	$conn = mysql_connect($hostname, $username, $password) OR DIE ("Unable to connect to database! Please try again later.");
	mysql_select_db($dbname);				
	
	$query='SELECT CourseID FROM `Course-Student` WHERE StudentID = \''.$iD.'\';';	
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
</body>
</html>
<?php
	ob_start();
	session_start();
	session_destroy();
?>
<!DOCTYPE html> 
<html>
<head>
	<title>Student Notify Log In</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<div id="textFields">
		<img src="images/Top.png" />
		<div id="navTop">
			<a href="index.html"> Back </a> </li>
		</div>	
			<fieldset>		
					<h2>Log-in Information</h2>
					<form name="frmRegister" method="post" action="login.php"><!--  onsubmit="return validate(this)">-->
						<?php
						if ($_GET['error']){?>
						<p class="error">
							Incorrect username or password.
						</p>
						<?php } ?>
						<p>
							<label for="txtUserName"> <span id="maroon">User Name:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span> </label>
							<input type="username" name="txtUserName" id="txtUserName" size="12" />
						</p>
						<p>
							<label for="txtPassword"> <span id="maroon"> Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span> </label>
							<input type="password" name="txtPassword" id="txtPassword" size="12" />
						</p>
	
						<input  class="red" type="submit" value="Log In">
					</form>	</div>
			</fieldset>
<script type="text/JavaScript">
function validate(form) {
  var returnValue = true;
  var username = form.txtUserName.value;
  var password = form.txtPassword.value;  

	  if(username == 0) {
		  returnValue = false;
		  alert("Please enter your correct User Name.");
		  frmRegister.txtUserName.focus();
	}
	if (password == 0) {
	  returnValue = false;
	  alert("Please enter your correct Password.");
	  frmRegister.txtPassword.focus();
	}
	return returnValue;
}
</script>
</body>
</html>

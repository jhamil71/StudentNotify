<?php
	ob_start();
	session_start();
	session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <title>
			White Board Log In
	  </title>
	   <link rel="stylesheet" type="text/css" href="FMSstyles.css" />
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
</head>
<body>
	<div id="textFields">
		<img src="images/Top.png" />
		<div id="navTop">
			<a href="index.html"> Back </a> </li>
		</div>	
			<fieldset>		
					<h2>Log-in Information</h2>
					<form name="frmRegister" method="post" action="wbLogin.php"><!--  onsubmit="return validate(this)">-->
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
</body>
</html>
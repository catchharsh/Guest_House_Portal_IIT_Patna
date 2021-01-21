<?php
session_start();
if (empty(($_SESSION['username']))) {
	header('Location: index.html');
	exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Password change</title>
		<link href="style.css" rel="stylesheet" type="text/css">
    
    
    <script>
    function validateForm()
    {
        var x=document.forms['password_form']['new_password'].value;
        var y=document.forms['password_form']['rnew_password'].value;
        if(x==y)
            return true;
        else {
            alert("Please confirm by retyping correct new password");
            return false;
            }
        
    }
</script>
</head>

<body>        
        <form name='password_form' method="POST" action='authenticate_password.php' onsubmit="return validateForm()">
        <img src='iitp.png' alt = 'iitp_logo' style="float:left;width:15%;height=15%;">
        
        <a href='home.php' style="float:right;"> <label > Home Page </label> </a>
                <div class="header"><h3>     Guest House Booking Portal IIT Patna </h3></div>
                <!-- <div class='header'><h2>Change Password</h2></div> -->

                <div class ='input-group'>
				<label for="old_password">
                    Old Password
				</label>
                <input type="password" name="old_password" placeholder="Old Password" id="old_password" required>
                </div>

                <div class ='input-group'>
				<label for="New_password">
                    New Password
				</label>
                <input type="password" name="new_password" placeholder="New Password" id="new_password" required>
                </div>

                <div class ='input-group'>
				<label for="New_password">
                    Confirm New Password
				</label>
                <input type="password" name="rnew_password" placeholder="Re-type new Password" id="rnew_password" required>
                </div>

                <input type="submit" name = "submit" class = 'btn' value="Change">
            </form>
	</body>
</html>

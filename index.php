<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
			<form action="authenticate.php" method="post">
                <img src='iitp.png' alt = 'iitp_logo' style="float:left;width:18%;height=18%;">
                <div class='header'><h2>Login</h2></div>

                <div class ='input-group'>
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
                <input type="text" name="username" placeholder="Username (Roll No)" id="username" required>
                </div>

                <div class ='input-group'>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
                <input type="password" name="password" placeholder="Password" id="password" required>
                </div>


                <input type="submit" class = 'btn' value="Login">
            </form>
            <form action="register.html">
                <input type="submit" class = 'btn' value="Sign Up Here">
                </input>
            </form>
           
		</div>
	</body>
</html>
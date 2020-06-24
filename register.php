<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'guests';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	die ('Please complete the registration form!');
}
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	die ('Please complete the registration form');
}

if ($stmt = $con->prepare('SELECT user_id, password FROM students WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		echo "
                <div class='header'> <h2>Username Already Exist</h2> </div> </br>
                <p align='center'> <a href='register.html'>Click here to Register</a></p></br>
                <p align='center'> <a href='index.php'> Click Here to Login  </a> </p>
          ";
	} 
	else {
			
		if ($stmt = $con->prepare('INSERT INTO students (username, password, email) VALUES (?, ?, ?)')) {
			$stmt->bind_param('sss', $_POST['username'], $_POST['password'], $_POST['email']);
			$stmt->execute();
            echo 'You have successfully registered, you can now login!';
            header('Location: index.html');
		} else {
			echo 'Could not prepare statement!';
		}
	}
	$stmt->close();
} else {
	echo 'Could not prepare statement!';
}
$con->close();
?>
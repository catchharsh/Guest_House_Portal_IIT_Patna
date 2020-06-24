<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" href='style.css'>
</head>
<body>
<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'guests';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( !isset($_POST['username'], $_POST['password']) ) {
	die ('Please fill both the username and password field!');
}

if ($stmt = $con->prepare('SELECT user_id, password FROM students WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $password);
        $stmt->fetch();
        if ($_POST['password']==$password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = 1;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['user_id'] = $user_id;
            header('Location: home.php');
        } else {
            echo "
                <div class='header'> <h2>Incorrect Password</h2> </div> </br>
                <p align='center'> <a href='register.html'>Click here to Register</a></p></br>
                <p align='center'> <a href='index.php'> Click Here to Login  </a> </p>
          ";
        }
    } else {
        echo "
                <div class='header'> <h2>Incorrect Username</h2> </div> </br>
                <p align='center'> <a href='register.html'>Click here to Register</a></p></br>
                <p align='center'> <a href='index.php'> Click Here to Login  </a> </p>
          ";
    }

	$stmt->close();
}
$con->close();
?>
</body>
</html>



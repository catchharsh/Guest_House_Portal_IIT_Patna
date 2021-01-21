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

if ( !isset($_POST['old_password'], $_POST['new_password'], $_POST['rnew_password']) ) {
	die ('Please fill all the fields!');
}
$new_pass = $_POST['new_password'];
if ($stmt = $con->prepare("SELECT password FROM students WHERE username = 'Admin'" )) {
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($password);
        $stmt->fetch();
        if ($_POST['old_password']==$password)
            {
                $update_query="UPDATE students SET password='$new_pass' WHERE username='Admin' ";
                $update_result=mysqli_query($con,$update_query);
                echo "
                <div class='header'> <h2>Password Changed successfully</h2> </div> </br>
                <p align='center'> <a href='home.php'>Click here to go back</a></p></br>";
            }
            else{
                echo "<div class='header'> <h2>Incorrect Old Password</h2> </div> </br>
                <p align='center'> <a href='home.php'>Click here to go back</a></p></br>";
            }
        }

	$stmt->close();
}
$con->close();
?>
</body>
</html>



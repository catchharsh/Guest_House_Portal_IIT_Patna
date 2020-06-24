<?php
session_start();
if (empty(($_SESSION['username']))) {
	header('Location: index.html');
	exit();
}
?> 
<?php
$DB_HOST='localhost';
$DB_USER='root';
$DB_PASS='';
$DB_NAME='guests';

$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if(mysqli_connect_errno()){
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
if( !isset($_POST['name'], $_POST['sex'], $_POST['age'], $_POST['rooms'], $_POST['address'], $_POST['chin'], $_POST['chout'], $_POST['user'], $_POST['email'], $_POST['contact'], $_POST['category'], $_POST['purpose'], $_POST['payment'], $_POST['additional'])){
    die('Please complete the Registration Form1');
}
if(empty($_POST['name']) || empty($_POST['sex']) || empty($_POST['age']) || empty($_POST['rooms']) || empty($_POST['address']) || empty($_POST['chin']) || empty($_POST['chout']) || empty($_POST['user']) || empty($_POST['email']) || empty($_POST['contact']) || empty($_POST['category']) || empty($_POST['purpose']) || empty($_POST['payment']) || empty($_POST['additional'])  ){
    die('Please complete the Registartion Form2');
}
$checkin_date = new DateTime($_POST['chin']);
$checkout_date = new DateTime($_POST['chout']);
$checkin_date = mysqli_real_escape_string($con, $checkin_date->format('Y-m-d'));
$checkout_date = mysqli_real_escape_string($con, $checkout_date->format('Y-m-d'));
$name = $_FILES['file']['name'];
$type = $_FILES['file']['type'];
$data = file_get_contents($_FILES['file']['tmp_name']);
$user = $_SESSION['user_id'];
if ($stmt = $con->prepare('INSERT INTO guest_info(`user_id`, `name`, `sex`, `age`, `rooms`, `address`, `check_in`, `check_out`, `username`, `email`, `contact`, `category`, `purpose`, `payment_by`, `additional`, `file_name`, `file_type`, `file_data`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
	$x = $stmt->bind_param('ssssssssssssssssss',$user, $_POST['name'], $_POST['sex'], $_POST['age'], $_POST['rooms'], $_POST['address'], $checkin_date, $checkout_date, $_POST['user'], $_POST['email'], $_POST['contact'], $_POST['category'], $_POST['purpose'], $_POST['payment'], $_POST['additional'], $name, $type, $data);
	$xx = $stmt->execute();
	if(false === $xx) {
		die('execute() failed: ' . htmlspecialchars($stmt->error));
	}
	echo 'You have successfully booked the rooms!';
	header('Location: home.php');
} else {
	echo 'Could not prepare statement!';
}
$con->close();

?>

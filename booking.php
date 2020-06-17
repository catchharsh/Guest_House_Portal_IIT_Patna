<?php
session_start();
$DB_HOST='localhost';
$DB_USER='root';
$DB_PASS='';
$DB_NAME='guests';

$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if(mysqli_connect_errno()){
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
if( !isset($_POST['name'], $_POST['sex'], $_POST['age'], $_POST['rooms'], $_POST['address'], $_POST['check_in'], $_POST['check_out'], $_POST['username'], $_POST['email'], $_POST['contact'], $_POST['category'], $_POST['purpose'], $_POST['payment'], $_POST['additional'])){
    die('Please complete the Registration Form');
}
if(empty($_POST['name']) || empty($_POST['sex']) || empty($_POST['age']) || empty($_POST['rooms']) || empty($_POST['address']) || empty($_POST['check_in']) || empty($_POST['check_out']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['contact']) || empty($_POST['category']) || empty($_POST['purpose']) || empty($_POST['payment']) || empty($_POST['additional'])  ){
    die('Please complete the Registartion Form');
}

$checkin_date = new DateTime($_POST['check_in']);
$checkout_date = new DateTime($_POST['check_out']);
$checkin_date = mysqli_real_escape_string($con, $checkin_date->format('Y-m-d'));
$checkout_date = mysqli_real_escape_string($con, $checkout_date->format('Y-m-d'));
$name = $_FILES['file']['name'];
$type = $_FILES['file']['type'];
$data = file_get_contents($_FILES['file']['tmp_name']);

if ($stmt = $con->prepare('INSERT INTO guest_info(name, sex, age, rooms, address, check_in, check_out, username, email, contact, category, purpose, payment_by, additional, file_name, file_type, file_data) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
	$stmt->bind_param('sssssssssssssssss', $_POST['name'], $_POST['sex'], $_POST['age'], $_POST['rooms'], $_POST['address'], $checkin_date, $checkout_date, $_POST['username'], $_POST['email'], $_POST['contact'], $_POST['category'], $_POST['purpose'], $_POST['payment'], $_POST['additional'], $name, $type, $data);
	$stmt->execute();
	echo 'You have successfully booked the rooms !';
	$_SESSION['check_in']=$checkin_date;
	$_SESSION['check_out']=$checkout_date;
	header('Location: room_status.php');
} else {
	echo 'Could not prepare statement!';
}

$con->close();
?>
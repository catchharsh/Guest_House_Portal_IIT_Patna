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
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
    $con=mysqli_connect("localhost","root","","guests") or die(mysqli_error());
    if(mysqli_connect_errno())
        echo "Failed to connect to Database : ".mysqli_connect_error();
    $query = "SELECT * FROM `guest_info` WHERE payment_status='PENDING' AND booking_status='CONFIRMED' ";
    $result = mysqli_query($con, $query);
    if(isset($_POST['submit'])) 
    {
        $counter="dropdown1";
        while($row = mysqli_fetch_array($result))
        {
            $status=$_POST[$counter];
            $book_id=$row["booking_id"];
            $update_query="UPDATE guest_info SET payment_status='$status' WHERE booking_id='$book_id' ";
            $update_result=mysqli_query($con,$update_query);
            $counter++;
        }
    }
      echo "
          <div class='header'> <h2>Record Updated Successfully</h2> </div> </br>
          <p align='center'> <a href='pending.php'>Click here to go back to previous page</a></p></br>
          <p align='center'> <a href='home.php'>  Home Page  </a> </p>
          ";
?>
</body>
</html>

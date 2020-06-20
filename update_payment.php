<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	session_start();
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
    echo '<h1>Record updated successfully</h1>';
	echo '<a href="pending.php">Click here to go back to previous page</a>';
?>
</body>
</html>
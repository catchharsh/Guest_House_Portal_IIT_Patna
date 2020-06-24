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
    $query = "SELECT * FROM `guest_info` WHERE booking_status='PENDING' ";
    $result = mysqli_query($con, $query);
    $confirm_counter="confirm1";
    $decline_counter="decline1";
    while($row = mysqli_fetch_array($result))
    {
        $book_id=$row["booking_id"];
        if(isset($_POST[$decline_counter]))
        {
            $update_query="UPDATE guest_info SET booking_status='DECLINED' WHERE booking_id='$book_id' ";
            $update_result=mysqli_query($con,$update_query);
            break;
        }
        if(isset($_POST[$confirm_counter]))
        {
            $_SESSION['booking_id']=$book_id;
            $update_query="UPDATE guest_info SET booking_status='CONFIRMED' WHERE booking_id='$book_id' ";
            $update_result=mysqli_query($con,$update_query);
            $_SESSION['booking_id']=$book_id;
            $_SESSION['check_in']=$row['check_in'];
            $_SESSION['check_out']=$row['check_out'];
            $_SESSION['number_of_rooms']=$row['rooms'];
            header("Location: room_status.php");
        }
        $confirm_counter++;
        $decline_counter++;
    }
    echo "
    
          <div class='header'> <h2>Request action successful</h2> </div> </br>
          <p align='center'> <a href='admin_booking_request.php'>Click here to go back to previous page</a></p></br>
          <p align='center'> <a href='home.php'>  Home Page  </a> </p>
       
          ";
    ?>
</body>
</html>

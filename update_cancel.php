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
    $con=mysqli_connect("localhost:3307","root","","guests") or die(mysqli_error());
    if(mysqli_connect_errno())
        echo "Failed to connect to Database : ".mysqli_connect_error();
    $id=$_SESSION['user_id'];
    $data="SELECT * FROM `guest_info` WHERE user_id=$id ";
    $result=mysqli_query($con,$data);
    $cancel_counter="cancel1";
    while($row = mysqli_fetch_array($result))
    {
        $book_id=$row["booking_id"];
        if(isset($_POST[$cancel_counter]))
        {
            // echo $cancel_counter;
            $delete_query="DELETE from `guest_info` WHERE booking_id='$book_id' ";
            $delete_result=mysqli_query($con,$delete_query);
            break;
        }
        $cancel_counter++;
    }
    echo "
    
          <div class='header'> <h2>Request action successful</h2> </div> </br>
          <p align='center'> <a href='history.php'>Click here to go back to previous page</a></p></br>
          <p align='center'> <a href='home.php'>  Home Page  </a> </p>
       
          ";
    ?>
</body>
</html>

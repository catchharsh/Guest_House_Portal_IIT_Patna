<?php
session_start();
if (empty(($_SESSION['username']))) {
	header('Location: index.html');
	exit();
}
?>
<!DOCTYPE HTML>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
    $DB_HOST='localhost';
    $DB_USER='root';
    $DB_PASS='';
    $DB_NAME='guests';
    
    $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    if(mysqli_connect_errno()){
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }

    $book_id = $_SESSION['booking_id'];
    $check_in = $_SESSION['check_in'];
    $check_out = $_SESSION['check_out'];
    $user_id="";

    if ($stmt = $con->prepare("SELECT user_id FROM guest_info WHERE booking_id = '$book_id'"))
    {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        $stmt->fetch();
    } 
    $update_query="UPDATE guest_info SET booking_status='CONFIRMED' WHERE booking_id='$book_id' ";
    $update_result=mysqli_query($con,$update_query);
    
    if( isset($_POST['roomschosen']) )
    {
        if(!empty($_POST['check_list']))
        {
            foreach ($_POST['check_list'] as $item)
            {
                if(isset($item))
                {
                    if($stmt = $con->prepare("INSERT INTO bookings(booking_id, user_id, room_id, start_date, end_date) VALUES(?,?,?,?,?)"))
                    {
                        $stmt->bind_param("sssss",$book_id, $user_id, $item, $check_in, $check_out);
                        $xx = $stmt->execute();
                        if(false === $xx) {
                            die('execute() failed: ' . htmlspecialchars($stmt->error));
                        }
                    }
                    else{
                        echo "Couldn't Prepare the statsment";
                    }
                }
            }
           echo "<div class='header'> <h2> Boookings Done </h2> </div>";
           echo "<div class='header'> <a href='home.php' style='float:center;'> <label >Home Page </label> </a> </div> ";

        }
    }
?>

</body>
</html>

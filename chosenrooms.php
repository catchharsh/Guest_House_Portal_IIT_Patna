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

    $book_id = $_SESSION['booking_id'];
    $user_id = $_SESSION['user_id'];
    $check_in = $_SESSION['check_in'];
    $check_out = $_SESSION['check_out'];
    
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
                        $stmt->execute();
                        echo "Bookings Done";
                    }
                    else{
                        echo "Couldn't Prepare the statsment";
                    }
                }
            }

        }
    }
?>

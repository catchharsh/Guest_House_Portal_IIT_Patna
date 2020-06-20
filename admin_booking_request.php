<?php
    session_start();
    $con=mysqli_connect("localhost","root","","guests") or die(mysqli_error());
    if(mysqli_connect_errno())
        echo "Failed to connect to Database : ".mysqli_connect_error();
    $query = "SELECT * FROM `guest_info` WHERE booking_status='PENDING' ";
    $result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Booking Requests</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<html>
    <body>
        <div class="container">
            <h2 align="center">Booking Requests</a></h2>
            <br />
            <h3 align="center">Booking details</h3>
            <br />
            <form action="update_request.php" method="post">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>S.No.</th>
                        <th>Booking ID</th>
                        <th>Rooms</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Confirm</th>
                        <th>Decline</th>
                    </tr>
                    <?php
                        $serial_number=1;
                        $confirm_counter="confirm1";
                        $decline_counter="decline1";
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '
                            <tr>
                            <td>'.$serial_number.'</td>
                            <td>'.$row["booking_id"].'</td>
                            <td>'.$row["rooms"].'</td>
                            <td>'.$row["check_in"].'</td>
                            <td>'.$row["check_out"].'</td>
                            <td> <input name='.$confirm_counter.' type="submit" value="Confirm"/> </td>
                            <td> <input name='.$decline_counter.' type="submit" value="Decline"/> </td>
                            </tr>
                            ';
                            $confirm_counter++;
                            $decline_counter++;
                            $serial_number++;
                        }   
                    ?>
                </table>
            </div>
            </form>
        </div>
    </body>
</html>


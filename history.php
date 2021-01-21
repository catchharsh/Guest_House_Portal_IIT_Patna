<?php
session_start();
if (empty(($_SESSION['username']))) {
    header('Location: index.html');
    exit();
}
?> 
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style1.css" />

</head>
<html>
    <body>
        <a href='home.php' style='float:right;'> <label > Home Page </label> </a>
        <div class="container">
            <h3 align="center">Booking history</h3>
            <br />
            <form action="update_cancel.php" method="post">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>S.No.</th>
                        <th>Booking ID</th>
                        <th>User ID</th>
                        <th>Indentor name</th>
                        <th>Guest name</th>
                        <th>Rooms</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Payment status</th>
                        <th>Booking status</th>
                        <th> Cancel </th>
                        
                    </tr>
                    <?php
                        $con=mysqli_connect("localhost:3307","root","","guests") or die(mysqli_error());
                        if(mysqli_connect_errno())
                            echo "Failed to connect to Database : ".mysqli_connect_error();
                        $id=$_SESSION['user_id'];
                        $data="SELECT * FROM `guest_info` WHERE user_id=$id ";
                        $result=mysqli_query($con,$data);
                        $serial_number=1;
                        $cancel_counter="cancel1";
                        if($result)
                        {
                            while($row = mysqli_fetch_array($result))
                            {
                                echo '
                                <tr>
                                <td>'.$serial_number.'</td>
                                <td>'.$row["booking_id"].'</td>
                                <td>'.$row["user_id"].'</td>
                                <td>'.$row["username"].'</td>
                                <td>'.$row["name"].'</td>
                                <td>'.$row["rooms"].'</td>
                                <td>'.$row["check_in"].'</td>
                                <td>'.$row["check_out"].'</td>
                                <td id="pstatus">'.$row["payment_status"].'</td>
                                <td id="bstatus">'.$row["booking_status"].'</td>
                                ';

                                if($row["payment_status"]=="CONFIRMED" || $row["booking_status"]=="CONFIRMED")
                                echo '
                                <td> <input id ="Cancelbtn" name='.$cancel_counter.' type="submit" value="Cancel" disabled="disabled"/> </td>
                                </td>
                                </tr>
                                ';

                                else
                                echo '
                                <td> <input id ="Cancelbtn" name='.$cancel_counter.' type="submit" value="Cancel" /> </td>
                                </td>
                                </tr>
                                ';

                                $serial_number++;
                                $cancel_counter++;
                            }
                            $con->close();
                        }
                    ?>
                </table>
            </div>
                    </form>
        </div>
    </body>
</html>

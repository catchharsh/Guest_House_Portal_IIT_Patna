<?php
session_start();
if (empty(($_SESSION['username']))) {
	header('Location: index.html');
	exit();
}
?> 
<?php
    $con=mysqli_connect("localhost","root","","guests") or die(mysqli_error());
    if(mysqli_connect_errno())
        echo "Failed to connect to Database : ".mysqli_connect_error();
    $query = "SELECT * FROM `guest_info` WHERE payment_status='PENDING' AND booking_status='CONFIRMED' ";
    $result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Payment confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <style>
        a:link, a:visited {
            background-color: white;
            color: black;
            border: 2px solid  #5F9EA0;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        a:hover, a:active {
            background-color: #5F9EA0;
            color: white;
  }
    </style>
</head>
<html>
    <body>
    <a href='home.php' style="float:right;"> <label > Home Page </label> </a>
        <div class="container">
            <h2 align="center">Confirm payment of booking</a></h2>
            <br />
            <h3 align="center">Booking details</h3>
            <br />
            <form action="update_payment.php" method="post">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>S.No.</th>
                        <th>Booking ID</th>
                        <th>Rooms</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Payment status</th>
                    </tr>
                    <?php
                        $serial_number=1;
                        $counter="dropdown1";
                        if($result)
                        {
                            while($row = mysqli_fetch_array($result))
                            {
                                echo '
                                <tr>
                                <td>'.$serial_number.'</td>
                                <td>'.$row["booking_id"].'</td>
                                <td>'.$row["rooms"].'</td>
                                <td>'.$row["check_in"].'</td>
                                <td>'.$row["check_out"].'</td>
                                <td> <select name='.$counter.'>
                                        <option value="PENDING">PENDING</option>
                                        <option value="CONFIRMED">CONFIRMED</option>
                                    </select>
                                 </td>
                                </tr>
                                ';
                                $counter++;
                                $serial_number++;
                            }   
                        }
                    ?>
                </table>
            </div>
            <div style="text-align:center">  
                <input type="submit" name="submit" value="Submit"/>
            </div>
            </form>
        </div>
    </body>
</html>

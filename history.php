<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<html>
	<body>
		<div class="container">
			<h3 align="center">Booking history</h3>
            <br />
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>S.No.</th>
                        <th>Booking ID</th>
                        <th>Rooms</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Payment status</th>
                        <th>Booking status</th>
                    </tr>
					<?php
                        session_start();
					    $con=mysqli_connect("localhost","root","","guests") or die(mysqli_error());
					    if(mysqli_connect_errno())
					        echo "Failed to connect to Database : ".mysqli_connect_error();
					    $id="16";
					    $data="SELECT * FROM `guest_info` WHERE user_id=$id ";
					    $result=mysqli_query($con,$data);
					    $serial_number=1;
					    while($row = mysqli_fetch_array($result))
    					{
    						echo '
                            <tr>
                            <td>'.$serial_number.'</td>
                            <td>'.$row["booking_id"].'</td>
                            <td>'.$row["rooms"].'</td>
                            <td>'.$row["check_in"].'</td>
                            <td>'.$row["check_out"].'</td>
                            <td>'.$row["payment_status"].'</td>
                            <td>'.$row["booking_status"].'</td>
                            </td>
                            </tr>
                            ';
                            $serial_number++;
    					}
					?>
                </table>
            </div>
        </div>
    </body>
</html>

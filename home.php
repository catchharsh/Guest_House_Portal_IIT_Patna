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
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
        <form>
        <img src='iitp.png' alt = 'iitp_logo' style="float:left;width:15%;height=15%;">
        
        <a href='home.php' style="float:right;"> <label > Home Page </label> </a>
        <!-- <div class="header"><h3>Guest House Booking Portal IIT Patna </h3></div> -->
        <div class='header'>
            <label>
               <h3> Welcome !</br>
                <?php echo $_SESSION['username']?>
                </br>
</h3>
            </label>
        </div>
        </br>
        <p style="text-align:center;">What would you like to explore !!!</p>
        <table> 
            <?php
              $admin_user = 'admin';
              $check_username = $_SESSION['username'];
              $check_username = strtolower($check_username);
              $admin_user = strtolower($admin_user);
              if ($check_username ==  $admin_user)
              {
                  echo "

                  <div class= 'header'><a href='admin_history.php'> <label > Admin History </label> </a> </div>
                  <div class= 'header'><a href='admin_booking_request.php'> <label > Admin Booking Requests </label> </a> </div> 
                  <div class= 'header'><a href='availability.php'> <label > Check Availability Of Rooms</label> </a> </div>
                  <div class= 'header'><a href='pending.php'> <label >Pending Payments</label> </a> </div>
                  <div class= 'header'><a href='change_password.php'> <label > Change Password </label> </a> </div> 
                  <div class= 'header'><a href='logout.php'> <label >Logout</label> </a> </div>
                  ";
              }
              else
              {
                  echo "
                  <div class= 'header'><a href='history.php'> <label > My Bookings </label> </a> </div>
                  <div class= 'header'><a href='booked_rooms.php'> <label > My Booked Rooms </label> </a> </div>
                  <div class= 'header'><a href='bookings.php'> <label > Make a Booking </label> </a> </div> 
                  <div class= 'header'><a href='availability.php'> <label > Check Availability Of Rooms</label> </a> </div>
                  <div class= 'header'><a href='logout.php'> <label >Logout</label> </a> </div>

                  ";
              }
            ?>
        </table>
        </form>
	</body>
</html>

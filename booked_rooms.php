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
    <link rel="stylesheet" href="style1.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    
</head>

<body>
<a href='home.php' style="float:right;"> <label > Home Page </label> </a>
 <!-- <div class="header"><h3>     Guest House Booking Portal IIT Patna </h3></div> -->
        <form name="search_parameters" method="post">
        
               
            <h3 align="center">Booked Rooms</h3>
            <div class='input-group'> <label>Booking ID:</label> <input type="text" name="book_id" required></div>
            <div style="text-align:center;"><input type="submit" class='btn' name="submit" value="Submit"></div>
      </form>
<?php
    $con=mysqli_connect("localhost:3307","root","","guests") or die(mysqli_error());
    if(mysqli_connect_errno())
        echo "Failed to connect to Database : ".mysqli_connect_error();
    if(isset($_POST['submit'])) 
    {
        $book_id=$_POST['book_id'];
        $user_id=$_SESSION['user_id'];
        $query = "SELECT * FROM `bookings` WHERE booking_id='$book_id' AND user_id='$user_id' " ;
        $result = mysqli_query($con, $query);
   ?>
  <div class="container">
    <h2 align="center">List of Rooms</a></h2>
      <br />
      <div class="table-responsive">
          <table class="table table-bordered table-striped">
              <tr>
                  <th>Room ID</th>
                  <th>Check In</th>
                  <th>Check Out</th>
              </tr>
          <?php
                echo "<h4>Booking ID : ".$book_id."</h4>";
              if($result)
              {
                while($row = mysqli_fetch_array($result))
                {
                    echo '
                    <tr>
                    <td>'.$row["room_id"].'</td>
                    <td>'.$row["start_date"].'</td>
                    <td>'.$row["end_date"].'</td>
                    </tr>
                    ';
                }  
              }
            } 
          ?>
          </table>
      </div>
  </div>
</body>
</html>

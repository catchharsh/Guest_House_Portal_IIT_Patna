<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Availability</title>
    <link rel="stylesheet" href="css/style1.css" />
</head>
<script type="text/javascript" language="javascript">
    function checkInp()
    {
          var x=document.forms["availability_form"]["rooms"].value;
          var y=document.forms["availability_form"]["adults"].value;
          var z=document.forms["availability_form"]["children"].value;
          var cur=Date();
          var startDt=document.forms["availability_form"]["check_in"].value;
          var endDt=document.forms["availability_form"]["check_out"].value;
          if (isNaN(x) || parseInt(x)<=0) 
          {
            alert("Number of rooms should be a positive numeric value");
            return false;
          }
          if (isNaN(y) || parseInt(y)<0) 
          {
            alert("Number of adults should be a non=negative numeric value");
            return false;
          }
          if (isNaN(z) || parseInt(z)<0) 
          {
            alert("Number of Children should be a non=negative numeric value");
            return false;
          }
          if(Date.parse(startDt)>Date.parse(endDt))
          {
            alert("Check out date should not be before check in date");
            return false;
          }
          if(Date.parse(cur)>Date.parse(startDt))
          {
            alert("Check in date is in the past");
            return false;
          }
    }
</script>
<body>
    <div class="form">
        <h1>Availability Status</h1>
        <form name="availability_form" method="post" onsubmit="return checkInp()" action="">
            <p>Number of Rooms: <input type="text" name="rooms" value="" required></p>
            <p>Number of Guests: </p> 
            <p>Adults: <input type="text" name="adults" value="" required></p>
            <p>Children: <input type="text" name="children" value="" required></p>
            <p>Check-in date: <input type="date" name="check_in" data-date-format="yyyy-mm-dd" required></p>
            <p>Check-out date: <input type="date" name="check_out" data-date-format="yyyy-mm-dd" required></p>
            <p><input type="submit" name="check" value="Check"></p>
            <input type="hidden" name="form_submitted" value="1">
      </form>
  </div>
    <?php
        $con=mysqli_connect("localhost","root","","guests") or die(mysqli_error());
        if(mysqli_connect_errno())
            echo "Failed to connect to Database : ".mysqli_connect_error();
        $data="SELECT * FROM `rooms`";
        $val=mysqli_query($con,$data);
        $total_room=mysqli_num_rows($val);
        if(isset($_POST['form_submitted']))
        {
            $rooms=$_REQUEST['rooms'];
            $chkIn=$_REQUEST['check_in'];
            $chkOut=$_REQUEST['check_out'];
            $startDt=$chkIn;
            $endDt=$chkOut;
            $occupied=0;        
            while($r=mysqli_fetch_array($val))
            {
                $r_id=$r['room_id'];
                $query="SELECT * FROM `bookings` WHERE room_id='$r_id' ";
                $result=mysqli_query($con,$query);
                while($row=mysqli_fetch_array($result))
                {
                  $dt1=$row['start_date'];
                  $dt2=$row['end_date'];
                  if(!($startDt>$dt2 || $endDt<$dt1))
                  {
                      $occupied++;
                      break;
                  }
                }
            }   
            $available_rooms=$total_room-$occupied;
            $available_rooms=max(0,min($available_rooms,$rooms));
            echo "<div class='form'> <h2>Available rooms : ".$available_rooms."</h2>";
            echo "<br/><a href='booking.php'>Click here for Booking</a>";
        }
    ?>
</body>
</html>

    

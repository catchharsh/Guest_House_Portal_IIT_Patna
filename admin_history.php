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
<script type="text/javascript" language="javascript">
    function checkInp()
    {
          var id=document.forms["search_parameters"]["id"].value;
          var cur=Date();
          var startDt=document.forms["search_parameters"]["check_in"].value;
          var endDt=document.forms["search_parameters"]["check_out"].value;
          if(isNaN(id) || parseInt(x)<=0) 
          {
            alert("User id should be a valid positive numeric value");
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
        <form name="search_parameters" method="post" onsubmit="return checkInp()" >
            <a href='home.php' style='float:right;'> <label > Home Page </label> </a>
            <div class='header'><h4>Choose search Parameters</h4></div></br>
            <div class='input-group'> <label>User ID:</label> <input type="text" name="id" placeholder="ALL"></div>
            <div class='input-group'> <label>Check-in date:</label> <input type="date" name="check_in" data-date-format="yyyy-mm-dd" placeholder="ALL"></div>
            <div class='input-group'> <label>Check-out date:</label> <input type="date" name="check_out" data-date-format="yyyy-mm-dd" placeholder="ALL"></div>
            <div class='input-group'>
                <label>Payment Status:</label> 
                <select name='payment' id = 'payment'>
                    <option value="ALL">ALL</option>
                    <option value="PENDING">PENDING</option>
                    <option value="CONFIRMED">CONFIRMED</option>
                </select>
            </div>
            <div class='input-group'>
                <label>Booking Status:</label> 
                <select name="confirmation" id='confirmation' >
                    <option value="ALL">ALL</option>
                    <option value="PENDING">PENDING</option>
                    <option value="CONFIRMED">CONFIRMED</option>
                </select>
            </div>
            <div style="text-align:center;"><input type="submit" class='btn' name="submit" value="Submit"></div>
      </form>
<?php
    $con=mysqli_connect("localhost","root","","guests") or die(mysqli_error());
    if(mysqli_connect_errno())
        echo "Failed to connect to Database : ".mysqli_connect_error();
    if(isset($_POST['submit'])) 
    {
        $query = "SELECT * FROM `guest_info`";
        $first=0;
        $id=$_POST['id'];
        $check_in=$_POST['check_in'];
        $check_out=$_POST['check_out'];
        $payment=$_POST['payment'];
        $confirmation=$_POST['confirmation'];
        if($id!=0)
        {
            if($first==0)
            {
                $first=1;
                $query.=" WHERE user_id='$id' ";
            }
            else
                $query.=" AND user_id='$id' ";  
        }
        if($check_in!=0)
        {
            if($first==0)
            {
                $first=1;
                $query.=" WHERE check_in='$check_in' ";
            }
            else
                $query.=" AND check_in='$check_in' ";  
        }
        if($check_out!=0)
        {
            if($first==0)
            {
                $first=1;
                $query.=" WHERE check_out='$check_out' ";
            }
            else
                $query.=" AND check_out='$check_out' ";  
        }
        if($payment!="ALL")
        {
            if($first==0)
            {
                $first=1;
                $query.=" WHERE payment_status='$payment' ";
            }
            else
                $query.=" AND payment_status='$payment' ";  
        }
        if($confirmation!="ALL")
        {
            if($first==0)
            {
                $first=1;
                $query.=" WHERE booking_status='$confirmation' ";
            }
            else
                $query.=" AND booking_status='$confirmation' ";  
        }
        $result = mysqli_query($con, $query);
   ?>
  <div class="container">
    <h2 align="center">Booking history</a></h2>
      <br />
      <div class="table-responsive">
          <table class="table table-bordered table-striped">
              <tr>
                  <th>S.No.</th>
                  <th>User ID</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Payment status</th>
                  <th>Booking status</th>
              </tr>
          <?php
              $serial_number=1;
              while($row = mysqli_fetch_array($result))
              {
                  echo '
                  <tr>
                  <td>'.$serial_number.'</td>
                  <td>'.$row["user_id"].'</td>
                  <td>'.$row["check_in"].'</td>
                  <td>'.$row["check_out"].'</td>
                  <td>'.$row["payment_status"].'</td>
                  <td>'.$row["booking_status"].'</td>
                  </tr>
                  ';
                  $serial_number++;
              }  
            } 
          ?>
          </table>
      </div>
  </div>
</body>
</html>

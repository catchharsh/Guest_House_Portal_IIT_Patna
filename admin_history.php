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
            <div class='input-group'>
                <label>Sort by:</label> 
                <select name="sort_order" id='sort_order' >
                    <option value="NONE">NONE</option>
                    <option value="user_ID ASC">User_ID ASC</option>
                    <option value="user_ID DESC">User_ID DESC</option>
                    <option value="name ASC">Guest name ASC</option>
                    <option value="name DESC">Guest name DESC</option>
                    <option value="username ASC">Indentor name ASC</option>
                    <option value="username DESC">Indentor name DESC</option>
                    <option value="check_in ASC">Check in ASC</option>
                    <option value="check_in DESC">Check in DESC</option>
                    <option value="check_out ASC">Check out ASC</option>
                    <option value="check_out DESC">Check out DESC</option>
                    <option value="payment_status ASC">Payment status ASC</option>
                    <option value="payment_status DESC">Payment status DESC</option>
                    <option value="booking_status ASC">Booking status ASC</option>
                    <option value="booking_status DESC">Booking status DESC</option>
                </select>
            </div>
            <div style="text-align:center;"><input type="submit" class='btn' name="submit" value="Submit"></div>
      </form>
<?php
    $con=mysqli_connect("localhost:3307","root","","guests") or die(mysqli_error());
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
        $sort_order=$_POST['sort_order'];
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
                $query.=" WHERE check_in>='$check_in' ";
            }
            else
                $query.=" AND check_in>='$check_in' ";  
        }
        if($check_out!=0)
        {
            if($first==0)
            {
                $first=1;
                $query.=" WHERE check_out<='$check_out' ";
            }
            else
                $query.=" AND check_out<='$check_out' ";  
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
        if($sort_order!="NONE")
            $query.=" ORDER by $sort_order ";
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
                  <th>Indentor name</th>
                  <th>Guest name</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Payment status</th>
                  <th>Booking status</th>
              </tr>
          <?php
              $serial_number=1;
              if($result)
              {
                while($row = mysqli_fetch_array($result))
                {
                    echo '
                    <tr>
                    <td>'.$serial_number.'</td>
                    <td>'.$row["user_id"].'</td>
                    <td>'.$row["username"].'</td>
                    <td>'.$row["name"].'</td>
                    <td>'.$row["check_in"].'</td>
                    <td>'.$row["check_out"].'</td>
                    <td>'.$row["payment_status"].'</td>
                    <td>'.$row["booking_status"].'</td>
                    </tr>
                    ';
                    $serial_number++;
                }  
              }
            } 
          ?>
          </table>
      </div>
  </div>
</body>
</html>

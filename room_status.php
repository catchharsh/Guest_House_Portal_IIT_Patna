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
$from=$_SESSION['check_in'];
$to=$_SESSION['check_out'];
$sql = "SELECT room_id FROM rooms WHERE state='bad'";
$blocked_rooms = mysqli_query($con,$sql);
$query = "SELECT room_id,floor FROM room_status WHERE (start_date >= '$from' AND start_date <= '$to') OR (end_date >= '$from' AND end_date <= '$to' ) OR ('$from'>=start_date AND '$to'<=end_date)";
$booked_rooms = mysqli_query($con,$query);
$query1 = "SELECT room_id,floor FROM rooms WHERE state='good' OR state='bad'";
$rooms= mysqli_query($con,$query1); 
$blocked_rooms_array=[];
$booked_rooms_array=[];
while($r = mysqli_fetch_assoc($blocked_rooms))
{
    $blocked_rooms_array[]=$r['room_id'];
}
while($rr  = mysqli_fetch_assoc($booked_rooms))
{
    $booked_rooms_array[]=$rr['room_id'];
}
// echo mysqli_num_rows($booked_rooms)."</br>".count($booked_rooms_array)."</br>".mysqli_num_rows($rooms)."</br>".mysqli_num_rows($blocked_rooms)."</br>";
if(mysqli_num_rows($rooms) != 0){
    ?>
    <link rel="stylesheet" type="text/css" href="matrix.css">
   
     <div class="building">
     <div class="screen-side">
       <div class="screen"></div>
       <h3 class="select-text">Please select your rooms.</h3>
     </div>
     <form class="form" id="room" action="chosenrooms.php" method="post" name="room">
     <ol class="cabin">
       <?php
       $row2=array();
       while($row = mysqli_fetch_array($rooms))
       {
         $row2[]=$row;
       }
       for ($i=1; $i <=4; $i++) {
         $j=0;
         ?>
       <li class="rows row--<?php echo $i ?>">
         <ol class="rooms" type="A">
           <?php foreach ($row2 as $row1)
           {   
             if ($row1["floor"]==$i)
             {
               if(!isset($booked_rooms_array))
               {
                echo "hi"."</br>";
               echo '<li class="room">
                 <input class="single-checkbox" type="checkbox" name="check_list[]" onclick=" return checkThis(this,1)" value="'.$row1["room_id"].'" id="'.$row1["room_id"].'" />
                 <label for="'.$row1["room_id"].'">'.$row1["room_id"].'</label>
               </li>';
               }
               else
               {
                 if(!(in_array($row1['room_id'],$booked_rooms_array)))
                 {
                   echo '<li class="room">
                     <input class="single-checkbox" type="checkbox" name="check_list[]" onclick=" return checkThis(this,1)" value="'.$row1["room_id"].'" id="'.$row1["room_id"].'" />
                     <label for="'.$row1["room_id"].'">'.$row1["room_id"].'</label>
                   </li>';
                 }
                 else
                 {
                   echo '<li class="room">
                   <input class="single-checkbox" type="checkbox" name="check_list[]" onclick=" return checkThis(this,1)" disabled value="'.$row1["room_id"].'" id="'.$row1["room_id"].'" />
                   <label for="'.$row1["room_id"].'">'.$row1["room_id"].'</label>
                   </li>';
                 }
               }
             }
             $j++;
           }
          ?>
        </ol>
      </li>
       <?php } }
       ?>
   
         </ol>
         <button type="submit" class="btn btn-primary" id="roomsubmit" name="roomschosen" style="margin: 2.5% auto 2.5%; display:block;">Submit</button>
         </form>
   
   <div class="align" style="display: flex; margin-left:25%;">
     <figure style="display: flex; float:left; margin-right:3%;">
       <img src="green.png" alt="" style="height:20px; width:20px; display:inline-block; margin-left:5%; margin-right:2%;">
       <figcaption style="float:right; margin-left:5%; display:inline-block;">Selected</figcaption>
     </figure>
     <figure style="display: flex; float:left; margin-right:3%;">
       <img src="crimson.png" alt="" style="height:20px; width:20px; display:inline-block; margin-left:5%; margin-right:2%;">
       <figcaption style="float:right; margin-left:5%;">Booked</figcaption>
     </figure>
     <figure style="display: flex;float:left; margin-right:3%;">
       <img src="blue.png" alt="" style="height:20px; width:20px; display:inline-block; margin-left:5%; margin-right:2%;">
       <figcaption style="float:right; margin-left:5%;">Normal </figcaption>
     </figure>
     <figure style="display: flex; float:left; margin-right:3%;">
       <img src="orange.png" alt="" style="height:20px; width:20px; display:inline-block; margin-left:5%; margin-right:2%;">
       <figcaption style="float:right; margin-left:5%;">Blocked</figcaption>
     </figure>
   </div>
   
   </div>






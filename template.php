<?php
$DB_HOST='localhost';
$DB_USER='root';
$DB_PASS='';
$DB_NAME='guests';
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if(mysqli_connect_errno()){
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
$from=$arrival;
$to=$depart;
$room_query = " SELECT room_id,floor FROM rooms ";
$booked_query = " SELECT room_id FROM bookings WHERE  (start_date >= '$from' AND start_date <= '$to') OR (end_date >= '$from' AND end_date <= '$to' ) OR ('$from'>=start_date AND '$to'<=end_date)  ";
$booked_rooms = mysqli_query($con,$booked_query);
$rooms= mysqli_query($con,$room_query); 
$booked_rooms_array=[];
while($rr  = mysqli_fetch_assoc($booked_rooms))
{
    $booked_rooms_array[]=$rr['room_id'];
}
if(mysqli_num_rows($rooms) != 0){
    ?>
    <link rel="stylesheet" type="text/css" href="matrix.css">
   
     <div class="building">
     <div class="screen-side">
       <div class="screen"></div>
       <h3 class="select-text">Please select your rooms.</h3>
     </div>
     <form class="form" id="room" action="chosenrooms.php" onsubmit="return validateForm()" method="post" name="room">
     <ol class="cabin">
       <?php
       $all_rooms=array();
       while($row = mysqli_fetch_array($rooms))
       {
         $all_rooms[]=$row;
       }
       for ($i=1; $i <=4; $i++) {
         $j=0;
         ?>
       <li class="rows row--<?php echo $i ?>">
         <ol class="rooms" type="A">
           <?php foreach ($all_rooms as $row1)
           {   
             if ($row1["floor"]==$i)
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
             $j++;
           }
          ?>
        </ol>
      </li>
       <?php } }
       ?>
   
         </ol>
         <button type="submit" class="btn btn-primary" id="roomsubmit"  name="roomschosen" style="margin: 2.5% auto 2.5%; display:block;">Submit</button>
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
       <figcaption style="float:right; margin-left:5%;"> Unbooked </figcaption>
     </figure>
   </div>
   
   </div>

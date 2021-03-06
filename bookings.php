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
<title> Booking </title>
<link rel="stylesheet" type="text/css" href="style.css">

<script>
    function validateForm()
    {
        var to_match = /^[1-9]\d{9}$/ ;
        var x=document.forms['booking_form']['contact'].value;
        if(!x.match(to_match)) {
            alert("Please put 10 digit Contact Number");
            return false;
            }
        var y=document.forms['booking_form']['email'].value;
        if(y.length<12) {
            alert("Please put correct Institute - Email address");
            return false;
        }
        var last = y.substr(y.length - 11);
        var check="@iitp.ac.in";
        if(! (last==check))
        {
            alert("Please put correct Institute - Email address");
            return false;
        }
        var z=document.forms['booking_form']['age'].value;
        z = parseInt(z,10);
        if (isNaN(z) || z < 1 || z > 150)
        {
            alert('The age must be number between 1 and 150');
            return false;
        }
        var t=document.forms['booking_form']['rooms'].value;
        t = parseInt(t,10);
        if(isNaN(t) || t<0 || t>10)
        {
            alert('The number of rooms must be between 0 and 10 only');
            return false;
        }
        var cur = Date();
        var startDt = document.forms['booking_form']['chin'].value;
        var endDt   = document.forms['booking_form']['chout'].value;
        if(Date.parse(startDt)>Date.parse(endDt) )
        {
            alert('End date should be greater than starting date');
            return false;
        }
        if(Date.parse(cur)>Date.parse(endDt))
        {
            alert('End date should be greater than current date');
            return false;
        }
        if(Date.parse(cur)>Date.parse(startDt))
        {
            alert('Start date should be greater than current date');
            return false;
        }
        }
</script>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


<script>
        $( function(){
            $("#category").change(function() {
            $("#purpose").load("alltexts/"+$(this).val() + ".txt");
            });
        });

        $( function(){
            $("#purpose").change(function() {
            $("#payment").load("alltexts/"+$(this).val() + ".txt");
            });
        });

</script>

 </head>


<body>
    
    <form name='booking_form' action='booking.php' onsubmit="return validateForm()" method='POST' enctype="multipart/form-data">

        <img src='iitp.png' alt = 'iitp_logo' style="float:left;width:15%;height:15%;">
        <a href='home.php' style="float:right;"> <label > Home Page </label> </a>
        <div class="header"> <h2>Guest Details</h2> </div>
        <div class="input-group">
  	   <label>Name</label>
  	  <input type="text" name="name" placeholder="Guest Name" required>
      </div>
      
  	<div class="input-group">
        <label>Sex</label>
        <select id="sex" name="sex" class="blueText">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="others">Others</option>
          </select>
      </div>
      
  	<div class="input-group">
  	  <label>Age</label>
  	  <input type="text" name="age" placeholder="Age" required>
      </div>
      
      <div class="input-group">
  	  <label>Rooms Required</label>
  	  <input type="text" name="rooms" placeholder="Rooms Required" required>
      </div>
      
      <div class="input-group">
  	  <label>Address</label>
  	  <input type="text" name="address" placeholder='Address' required>
      </div>

      <div class="input-group">
  	  <label>Check-In Date</label>
  	  <input type="date" name="chin"  required>
      </div>

      <div class="input-group">
  	  <label>Check-Out Date</label>
  	  <input type="date" name="chout" required>
      </div>

      


      <div class="header"> <h2>Indentor Details</h2> </div>
      <div class="input-group">
  	  <label>Your Name</label>
  	  <input type="text" name="user" placeholder='Your Name' required>
      </div>

      <div class="input-group">
  	  <label>Institute E-mail ID</label>
  	  <input type="email" name="email" placeholder='Institute Email' required>
      </div>

      <div class="input-group">
  	  <label>Contact Number:</label>
        <input type="tel" name="contact" placeholder='Please put a correct 10 digit contact number' required>
      </div>




      <div class="header"> <h2>Category Details</h2> </div>

      <div class="input-group">
        <label>Category</label>
        <select id="category" name="category" class="blueText">
            <option selected >Please Choose one</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
          </select>
      </div>

      <div class="input-group">
        <label>Purpose</label>
        <select id="purpose" name="purpose" class="blueText">
        </select>
      </div>

      <div class="input-group">
        <label>Payment By</label>
        <select id="payment" name="payment" class="blueText">
        </select>
      </div>

      <div class="input-group">
        <label>Additional:</label>
        <label> Fill None if payment is neither by Dept. nor Fund, else fill Department Name or Fund Number </label>
        <input type="text" name="additional" placeholder='None' required>
      </div>

 
      <div class='input-group'>
          <label>Upload Document(Proof Of Payment) in Pdf</label>
          <input type="file" name='file' required>
      </div>


  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Upload and Book</button>
      </div>

  </form>

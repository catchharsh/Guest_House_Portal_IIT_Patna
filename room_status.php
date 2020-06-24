<?php
session_start();
if (empty(($_SESSION['username']))) {
	header('Location: index.html');
	exit();
}
?> 
<?php
 $arrival = $_SESSION['check_in'];
 $depart = $_SESSION['check_out'];
 $rooms_limit = $_SESSION['number_of_rooms']; 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose your rooms</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/matrix.css">

  <script type="text/javascript" language="javascript">
  function checkThis(Checkbox, limit)
  {
    var result='<?php echo $rooms_limit?>';
    limit=result;
    var check_box,i=0,n=limit;
    var Form = Checkbox.form;
    while(checkbox = Form.elements[i++])
    {
       if(checkbox.className = 'single-checkbox' && checkbox.checked) n--;
       if(n<0)
       {
         alert('Please select no more than '+ limit +' rooms. ')
         return false;
       }
    }
    return true;
  }
  function validateForm()
  {
    var inputs = document.getElementsByTagName("input");
    var count =0;
    for(var i=0;i<inputs.length ;i++)
    {
      if(inputs[i].type == "checkbox")
      {
        if(inputs[i].checked)
          count = count+1;
      }
    }
    var limit = '<?php echo $rooms_limit ?>';
    if(count != limit){
      alert('Please select atleast ' + limit + ' rooms.');
      return false;
    }
  }
  </script>

  </head>
  <body class="root">
    <?php require_once("template.php"); ?>
  </body>
</html>

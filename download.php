<?php
    $db=new PDO("mysql:host=localhost;dbname=guests","root","");
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $stmt = $db->prepare("select file_name, file_data from guest_info where booking_id=? limit 1");
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        header('Content-Type: application/pdf') ;
        header('Content-Disposition: inline; filename="test.pdf"') ;
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        echo $result['file_data'];
        exit();
    }
?>

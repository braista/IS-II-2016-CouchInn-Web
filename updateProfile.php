<?php
    include 'functions.php';
    $link= connect();
    $userid= $_POST['userid'];
    $lname= $_POST['lname'];
    $fname= $_POST['fname'];
    $bdate= $_POST['bdate'];
    $phonen= $_POST['phonen'];
    $SQL = "UPDATE usuarios SET apellido='$lname', nombre='$fname', fnacimiento='$bdate', telefono='$phonen' WHERE idusuario='$userid'";
    $result= mysqli_query($link, $SQL);
    if($result){
        session_start();
        $_SESSION['user']= $fname;
        redirectAfter("profile.php?ok=true", 2);
    }
?>

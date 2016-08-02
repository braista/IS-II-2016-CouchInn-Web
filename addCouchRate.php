<?php
include 'functions.php';
if(count($_POST) != 0){
    $link= connect();
    $rating= $_POST['rating'];
    $comment= $_POST['comment'];
    $couchID= $_POST['couchID'];
    $userID= $_POST['userID'];
    $requestID= $_POST['requestID'];
    $query= "INSERT INTO `puntajes-couchs`(`puntaje`, `idreserva`, `comentario`, `idusuario`, `idcouch`) VALUES ('$rating', '$requestID', '$comment', '$userID', '$couchID')";
    $result= mysqli_query($link, $query);
    if($result){
            redirect("lastCouchs.php");
    }else{
        redirectWithAlert("lastCouchs.php", "Hubo un error en la base de datos.");
    }
}

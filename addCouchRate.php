<?php
include 'functions.php';
if(count($_POST) != 0){
    $link= connect();
    $rating= $_POST['rating'];
    $comment= $_POST['comment'];
    $couchID= $_POST['couchID'];
    $userID= $_POST['userID'];
    $query= "INSERT INTO `puntajes-couchs`(`puntaje`, `comentario`, `idusuario`, `idcouch`) VALUES ('$rating', '$comment', '$userID', '$couchID')";
    $result= mysqli_query($link, $query);
    if($result){
        $query= "UPDATE reservas SET idestado=5 WHERE idcouch='$couchID' AND idusuario='$userID'";
        $result= mysqli_query($link, $query);
        redirect("lastCouchs.php");
    }else{
        redirectWithAlert("lastCouchs.php", "Hubo un error en la base de datos.");
    }
}

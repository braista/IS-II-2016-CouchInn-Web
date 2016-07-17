<?php
include 'functions.php';
if(count($_POST) != 0){
    $link= connect();
    $rating= $_POST['rating'];
    $comment= $_POST['comment'];
    $otherID= $_POST['otherID'];
    $userID= $_POST['userID'];
    $query= "INSERT INTO `puntajes-usuarios`(`puntaje`, `comentario`, `idusuario_puntuador`, `idusuario_puntuado`) VALUES ('$rating', '$comment', '$userID', '$otherID')";
    $result= mysqli_query($link, $query);
    if($result){
        redirect("lastUsers.php");
    }else{
        redirectWithAlert("lastUsers.php", "Hubo un error en la base de datos.");
    }
}

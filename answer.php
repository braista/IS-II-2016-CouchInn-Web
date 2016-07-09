<?php
include_once 'functions.php';
if(count($_POST) != 0){
    $link= connect();
    $answerID= $_POST['answerID'];
    $questionID= $_POST['questionID'];
    $couchID= $_POST['couchID'];
    $text= $_POST["answerBox$answerID"];
    $query= "INSERT INTO respuestas (texto, idpregunta) VALUES ('$text', '$questionID')";
    $result= mysqli_query($link, $query);
    if($result){
        redirectAfter("show.php?id=$couchID", 2);
    }else{
        redirectWithAlert("show.php?id=$couchID", "Hubo un problema con la base de datos");
    }
}else
    redirectWithAlert ("index.php", "Hubo un problema con el envio de datos.");


<?php
include_once 'functions.php';
if(count($_POST) != 0){
    $link= connect();
    $answerID= $_POST['answerID'];
    $couchID= $_POST['couchID'];
    $query= "DELETE FROM respuestas WHERE idrespuesta='$answerID'";
    $result= mysqli_query($link, $query);
    if($result){
        redirectAfter("show.php?id=$couchID", 2);
    }else{
        redirectWithAlert("show.php?id=$couchID", "Hubo un error en la base de datos.");
    }
}


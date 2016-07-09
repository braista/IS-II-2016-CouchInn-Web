<?php
include_once 'functions.php';
if(count($_POST) != 0){
    $link= connect();
    $questionID= $_POST['questionID'];
    $couchID= $_POST['couchID'];
    $query= "DELETE FROM preguntas WHERE idpregunta='$questionID'";
    $query2= "DELETE FROM respuestas WHERE idpregunta='$questionID'";    
    $result= mysqli_query($link, $query);
    $result2= mysqli_query($link, $query2);
    if($result){        
        redirectAfter("show.php?id=$couchID", 2);
    }else{
        redirectWithAlert("show.php?id=$couchID", "Hubo un error en la base de datos.");
    }
}


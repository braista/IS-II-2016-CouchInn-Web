<?php
    include_once 'functions.php';
    $date= date('Y-m-d H:i');
    $link= connect();
    $question= $_POST['questionBox'];
    $qid= $_POST['questionerID'];
    $couchid= $_POST['couchID'];
    $SQL = "INSERT INTO preguntas (texto, idusuario, idcouch) VALUES('$question', '$qid', '$couchid')";
    $result= mysqli_query($link, $SQL);
    if($result){        
        redirectAfter("show.php?id=$couchid&ok=true", 2);
    }else
        redirectWithAlert("show.php?id=$couchid", "Hubo un problema con la base de datos");
?>

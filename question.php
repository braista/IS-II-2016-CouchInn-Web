<?php
    include_once 'functions.php';
    $date= date('Y-m-d H:i');
    $link= connect();
    $question= $_POST['questionBox'];
    $qid= $_POST['questionerid'];
    $couchid= $_POST['couchid'];
    $SQL = "INSERT INTO preguntas (texto, fecha, idusuario, idcouch) VALUES('$question', '$date', '$qid', '$couchid')";
    $result= mysqli_query($link, $SQL);
    if($result){        
        redirectAfter("show.php?id=$couchid&ok=true", 2);
    }
?>

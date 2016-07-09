<?php
include 'functions.php';
$link= connect();
if(count($_POST) != 0){
    $fdate= $_POST["fdate"];
    $tdate= $_POST["tdate"];
    $amount= $_POST["amount"];
    $couchID= $_POST["couchID"];
    $userID= $_POST["userID"];
    
    $query= "INSERT INTO reservas (fecha_inicio, fecha_fin, cantidad, idusuario, idcouch, idestado) VALUES('$fdate', '$tdate', '$amount', '$userID', '$couchID', 1)";
    $result= mysqli_query($link, $query);
    if($result)
        redirectWithAlert("show.php?id=$couchID", "La solicitud de reserva se realizó correctamente. Pulse aceptar para volver a la publicación.");
    else
        redirectWithAlert("show.php?id=$couchID", "Hubo un problema con el procesamiento en la base de datos.");
    
}else{
    alert("Hubo un problema con el envio de datos.");
    back();
}

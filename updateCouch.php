<?php
include_once 'functions.php';
$link= connect();
if(count($_POST) !=0){
    $couchID= $_POST["couchid"];
    $title= $_POST["title1"];
    $capacity= $_POST["capacity"];
    $place= $_POST["place"];
    $type= $_POST["type"];
    if(isset($_POST["enable"]))
        $enable=1;
    else
        $enable=0;
    $description= $_POST["description"];
    
    //UPDATE DEL COUCH
    $query="UPDATE couchs SET titulo='$title', capacidad='$capacity', lugar='$place', idtipocouch='$type', habilitado='$enable', descripcion='$description' WHERE idcouch='$couchID'";
    $result= mysqli_query($link, $query);
    if($result){
        redirectAfter("cpanel.php?edit", 1);
    }else{
        alert("Hubo un error en la modificación de la publicación. Pulse aceptar para volver.");
        back();
    }
}else{
    alert("Hubo un error con el envio de los datos. Pulse aceptar para volver.");
    back();
}
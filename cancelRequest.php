<?php
include_once 'functions.php';
if(count($_POST) != 0){
    $link=  connect();
    $requestID= $_POST['requestID'];
    $query= "DELETE FROM reservas WHERE idreserva='$requestID'";
    $result= mysqli_query($link, $query);
    if($result)
        redirectAfter ("sentRequests.php", 2);
    else
        redirectWithAlert ("sentRequests.php", "Hubo un problema con la base de datos");
} else
    redirectWithAlert ("sentRequests.php", "Hubo un problema en el envio de datos.");
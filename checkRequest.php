<?php  
include_once 'functions.php';
$link=  connect();
$couchId = $_REQUEST["couchid"];
$requestId = $_REQUEST["id"];
$fdesde = $_REQUEST["desde"];
$fhasta = $_REQUEST["hasta"];
if(isset($_REQUEST["noAcept"])){
    $SQL = "UPDATE reservas SET idestado = '3' WHERE idreserva = '$requestId'";
    $result = mysqli_query($link, $SQL);
    alert("La reserva se ha rechazado correctamente.");
}
elseif (isset($_REQUEST["acept"])) {
    $SQL = "UPDATE reservas SET idestado = '2' WHERE idreserva='$requestId'";
    $result = mysqli_query($link, $SQL);
    $SQL = "SELECT * FROM reservas WHERE ((fecha_inicio BETWEEN '$fdesde' AND '$fhasta') OR (fecha_fin BETWEEN '$fdesde' AND '$fhasta') OR (fecha_inicio<='$fdesde' AND fecha_fin>='$fhasta')) AND (idestado=1) AND (idcouch = '$couchId')";
    $result = mysqli_query($link, $SQL);
    while($row = mysqli_fetch_array($result)){
        $idrequestaux = $row['idreserva'];
        $result1 = mysqli_query($link,"UPDATE reservas SET idestado = '3' WHERE idreserva='$idrequestaux'");
    }
    alert("La reserva se ha aceptado correctamente.");
}
back();   
?>
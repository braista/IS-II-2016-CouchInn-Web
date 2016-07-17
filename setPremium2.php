<?php
    include_once 'functions.php';
    $link= connect();
    if(isset($_POST['userid'])){
        $userid= $_POST['userid'];
        $cardn= $_POST['cardn'];
        $query= "SELECT * FROM premium";
        $row= mysqli_fetch_array(mysqli_query($link, $query));
        $amount= $row['monto'];
        $query= "INSERT INTO pagos (nrotarjeta, idusuario, monto) VALUES ('$cardn', '$userid', '$amount')";
        $result= mysqli_query($link, $query);
        if($result){
            $SQL = "UPDATE usuarios SET idtipousuario='2' WHERE idusuario='$userid'";
            $result= mysqli_query($link, $SQL);
            if($result){        
                redirectAfter("premium.php?ok=true", 2);
            }        
        }else{
            alert("Hubo un problema con el registro del pago.");
            back();
        }
    }
?>

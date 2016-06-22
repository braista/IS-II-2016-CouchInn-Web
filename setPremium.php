<?php
    include_once 'functions.php';
    $link= connect();
    if(isset($_POST['userid'])){
        $userid= $_POST['userid'];
        $cardn= $_POST['cardn'];
        $date= getdate();
        $dd= $date['mday'];
        $mm= $date['mon'];
        $yy= $date['year'];
        $date= "$yy-$mm-$dd";
        $query= "INSERT INTO pagos (nrotarjeta, fecha, idusuario) VALUES ('$cardn', '$date', '$userid')";
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

<?php
    include_once 'functions.php';
    $link= connect();
    $userid= $_POST['userid'];
    $SQL = "UPDATE usuarios SET idtipousuario='2' WHERE idusuario='$userid'";
    $result= mysqli_query($link, $SQL);
    if($result){        
        redirectAfter("premium.php?ok=true", 2);
    }
?>

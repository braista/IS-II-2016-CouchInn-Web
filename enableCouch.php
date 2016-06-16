<?php
    include_once 'functions.php';
    $link= connect();
    if(isset($_GET['id']) && $_GET['id'] != ""){
        $couchid= $_GET['id'];
        $query= "UPDATE couchs SET habilitado='1' WHERE idcouch='$couchid'";;
        $result= mysqli_query($link, $query);
        if($result){
            redirectWithAlert('cpanel.php', 'El couch fue habilitado correctamente.');
        }
    }
?>

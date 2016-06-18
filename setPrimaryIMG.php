<?php
include_once 'functions.php';
$link= connect();
if((isset($_GET["primary"]) && $_GET["primary"] != "") && 
   (isset($_GET["new"]) && $_GET["new"] != "")){
    $primaryID= $_GET["primary"];
    $newID= $_GET["new"];
    $del1="/";
    $del2=".";
    
    //CONSULTA NUEVA IMG PRIMARIA
    $query= "SELECT * FROM imagenes WHERE idimagen='$newID'";
    $newRow= mysqli_fetch_array(mysqli_query($link, $query));    
    $new= $newRow["imagen"];
    //ID DEL COUCH PARA REDIRIGIR
    $couchID= $newRow["idcouch"]; 
    
    $total2= strpos($new, $del2);
    $newExt= substr($new,$total2+1);
    rename("img/$new", "img/$couchID/55.$newExt");
    $total1= strpos($new, $del1)+1;
    $newIMG= substr($new,$total1);
    $total2= strpos($newIMG, $del2);
    $newIMG= substr($newIMG, 0,$total2);    

    //CONSULTA IMG A SER REEMPLAZADA
    $query= "SELECT * FROM imagenes WHERE idimagen='$primaryID'";
    $primaryRow= mysqli_fetch_array(mysqli_query($link, $query));
    $prev= $primaryRow["imagen"];    
    $total2= strpos($prev, $del2);
    $prevExt= substr($prev,$total2+1);
    
    //RENOMBRE DE ARCHIVOS
    $primary= "$couchID/1.$newExt"; //IMG A SER NUEVA PRIMARIA
    $old= "$couchID/$newIMG.$prevExt"; //IMG VIEJA PRIMARIA REEMPLAZADA
    rename("img/$prev", "img/$couchID/$newIMG.$prevExt");
    rename("img/$couchID/55.$newExt", "img/$couchID/1.$newExt");
    
    //INSERT IMG PRIMARIA
    $query="UPDATE imagenes SET imagen='$primary' WHERE idimagen='$primaryID'";
    mysqli_query($link, $query);
    //INSERT ANTERIOR IMG PRIMARIA
    $query="UPDATE imagenes SET imagen='$old' WHERE idimagen='$newID'";
    mysqli_query($link, $query);
    
    redirectWithAlertAfter("editCouch.php?id=$couchID", "Se ingreso correctamente la nueva imagen de portada.", 1);
}else{
    alert("No se recibieron correctamente los datos enviados.");
    back();
}

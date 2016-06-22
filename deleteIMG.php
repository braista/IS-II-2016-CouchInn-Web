<?php
include_once 'functions.php';
$link= connect();
$delIMG = $_GET["img"];
$couchid= $_GET["id"];
$query= "SELECT * FROM imagenes WHERE idimagen='$delIMG'";
$result= mysqli_query($link, $query);
$row= mysqli_fetch_array($result);
$imgname= $row["imagen"];

//CORTE DEL NOMBRE
$del1="/";
$del2=".";
//NOMBRE DE IMG
$total1= strpos($imgname, $del1)+1;
$img= substr($imgname,$total1);

$total2= strpos($img, $del2);
$img= substr($img, 0,$total2);

$query= "SELECT * FROM imagenes WHERE idcouch='$couchid' ORDER BY idimagen ASC";
$result= mysqli_query($link, $query);

    $i=0;   
    
    //PROCESO RESTO DE IMAGENES
    $ok= false;
    while ($imgRow = mysqli_fetch_array($result)) {
        $imgID= $imgRow["idimagen"];
        $img= $imgRow["imagen"];
        
        //SI SE BORRO IMG, SE REEMPLAZA Y RENOMBRAN
        if($ok){            
            
            //EXTENSION DE IMG
            $total2= strpos($img, $del2);
            $ext= substr($img,$total2+1);
            $newname= "$couchid/$i.$ext";
            
            $query= "UPDATE imagenes SET imagen='$newname' WHERE idimagen='$imgID'";
            $update= mysqli_query($link, $query);
            
            rename("img/$img", "img/$newname");
        }        
        if($imgID == $delIMG){
            $ok= true;
            //BORRO LA IMAGEN SELECCIONADA
            $query= "DELETE FROM imagenes WHERE idimagen='$delIMG'";
            $delete= mysqli_query($link, $query);
            unlink("img/$img");
        }                
        $i++;
    }

redirectAfter("editCouch.php?id=$couchid", 1);
?>


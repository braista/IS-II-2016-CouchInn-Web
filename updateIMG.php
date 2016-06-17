<?php
    include_once 'functions.php';
    $link= connect();
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    if($_FILES["image"]["name"] != ""){
        if(in_array($_FILES["image"]["type"], $permitidos)){
            
            //DATOS RECIBIDOS POR POST
            $imgID= $_POST['imgid'];
            $imgname= $_POST['imgname'];
            $couchid= $_POST['couchid'];
            
            unlink("img/".$imgname);
            
            //CORTE DEL NOMBRE
            $del1="/";
            $del2=".";
            $total1= strpos($imgname, $del1);
            $total2= strpos($imgname, $del2);
            $imgname= substr($imgname,$total1+1,$total2-3);
            
            //PROCESO IMG            
            $imgtype= $_FILES["image"]["type"];
            $img= $_FILES["image"]["tmp_name"];           
            $path= $couchid."/".$imgname.".".getIMGType($imgtype);                        
            @move_uploaded_file($img, "img/".$path);
            $query= "UPDATE imagenes SET imagen='$path' WHERE idimagen='$imgID'";
            mysqli_query($link, $query);
            redirectAfter("editCouch.php?id=$couchid", 1);            
        } else{
            alert("La imagen tiene un formato inválido.");
            back();           
        }
    }
?>


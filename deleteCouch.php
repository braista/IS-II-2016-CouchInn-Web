<?php
include 'functions.php';
if(isset($_POST['couchid'])){    
    $link= connect();
    $couchID= $_POST['couchid'];
    
    //CONSULTA SI EL COUCH POSEE RESERVAS. SI TIENE SE DESHABILITA, SI NO TIENE SE BORRA.
    $query= "SELECT * FROM reservas WHERE idcouch='$couchID'";
    $result= mysqli_query($link, $query);
    
    if(mysqli_num_rows($result) == 0){ //SI NO TIENE RESERVAS
        $query= "DELETE FROM imagenes WHERE idcouch='$couchID'"; //BORRA IMG DEL COUCH
        $result= mysqli_query($link, $query);
        
        if($result){ //SE BORRARON CORRECTAMENTE LAS IMAGENES DE LA PUBLICACIÓN.
            deleteFolder("img/$couchID"); //FUNCION QUE BORRA UNA CARPETA CON LOS ARCHIVOS DENTRO
            $query= "DELETE FROM couchs WHERE idcouch='$couchID'";
            $result= mysqli_query($link, $query);
            if($result){ //SE BORRÓ CORRECTAMENTE LA PUBLICACIÓN
                redirectAfter("cpanel.php?delete", 2);
            }else{
                alert("Hubo un problema en el borrado de la publicación.");
                back();
            }
        } else{
            alert("Hubo un problema en el borrado de imágenes de la publicación.");
            back();
        }
    }else{ //LA PUBLICACION TIENE RESERVAS. ENTONCES SE CONSULTA SI DESHABILITAR O NO.
        redirectWithAlert("disableCouch.php?id=$couchID", "La publicación que se intentó borrar tenia reservas hechas. Se deshabilitó la publicación.");
    }
} else {
    alert("Hubo un problema en el envio de datos.");
    back();
}
?>



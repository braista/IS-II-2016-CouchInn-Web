<?php
    include_once 'functions.php';
    $link= connect();
    if (isset($_POST["couchid"]) && $_POST["couchid"] != ""){        
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
        if($_FILES["image"]["name"] != ""){
            if(in_array($_FILES["image"]["type"], $permitidos)){
                
                //DATOS RECIBIDOS POR POST
                $couchID= $_POST['couchid'];
                
                //CONSULTA CANTIDAD DE IMG
                $query="SELECT * FROM imagenes WHERE idcouch='$couchID'";
                $result= mysqli_query($link, $query);
                $imgamount= mysqli_num_rows($result) + 1;

                //PROCESO IMG            
                $imgtype= getIMGType($_FILES["image"]["type"]);
                $tmp= $_FILES["image"]["tmp_name"];
                $path= $couchID."/".$imgamount.".".$imgtype;                       
                
                //INSERTO IMG EN CARPETA IMG
                @move_uploaded_file($tmp, "img/$path");
                
                //INSERTO IMG EN BD
                $query= "INSERT INTO imagenes (imagen, idcouch) VALUES ('$path', '$couchID')";
                $result= mysqli_query($link, $query);
                if($result)
                    redirectAfter("editCouch.php?id=$couchID", 1);
                else{
                    alert("Hubo en error en la inserción de la IMG en la BD.");
                    back();
                }
            } else{
                alert("La imagen tiene un formato inválido.");
                back();           
            }
        }
    } else{
        alert("No se recibieron correctamente los datos.");
        back();
    }
?>
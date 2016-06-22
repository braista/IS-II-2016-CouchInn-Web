<?php
    include_once 'functions.php';
    $link= connect();
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    if($_FILES["img1"]["name"] != ""){
        if(in_array($_FILES["img1"]["type"], $permitidos)){
            $ok=true;
        } else{
            alert("La imagen 1 tiene un formato inválido.");
            $ok= false;
            back();
        }
    }
    if($_FILES["img2"]["name"] != ""){
        if(in_array($_FILES["img2"]["type"], $permitidos)){            
            $ok=true;
        } else{
            alert("La imagen 2 tiene un formato inválido.");
            $ok= false;
            back();
        }
    }
    if($_FILES["img3"]["name"] != ""){
        if(in_array($_FILES["img3"]["type"], $permitidos)){            
            $ok=true;
        } else{
            alert("La imagen 3 tiene un formato inválido.");
            $ok= false;
            back();
        }
    }
    if($_FILES["img4"]["name"] != ""){
        if(in_array($_FILES["img4"]["type"], $permitidos)){            
            $ok=true;
        } else{
            alert("La imagen 4 tiene un formato inválido.");
            $ok= false;
            back();
        }
    }
    if($_FILES["img5"]["name"] != ""){
        if(in_array($_FILES["img5"]["type"], $permitidos)){            
            $ok=true;
        } else{
            alert("La imagen 5 tiene un formato inválido.");
            $ok= false;
            back();
        }
    }
        
    if($ok){
        if(count($_POST) > 0){
            $title= $_POST["title1"];
            $capacity= $_POST["capacity"];
            $place= $_POST["place"];
            $type= $_POST["type"];
            if(isset($_POST["enable"]))
                $enable=1;
            else
                $enable=0;
            $description= $_POST["description"];
            $userid= $_POST["userid"];
            $query= "INSERT INTO couchs (titulo, capacidad, lugar, idtipocouch, habilitado, descripcion, idusuario, puntaje) VALUES ('$title','$capacity','$place','$type','$enable','$description', '$userid', '0')";
            $result= mysqli_query($link, $query);
            if($result){
                $query= "SELECT * FROM couchs ORDER BY idcouch DESC";
                $row= mysqli_fetch_array(mysqli_query($link, $query));
                $couchid= $row['idcouch'];                                    
                mkdir("img/".$couchid);
                if($_FILES["img1"]["name"] != ""){
                    $imgtype= $_FILES["img1"]["type"];
                    $img= $_FILES["img1"]["tmp_name"];
                    $path= $couchid."/1.".getIMGType($imgtype);                        
                    @move_uploaded_file($img, "img/".$path);
                    $query= "INSERT INTO imagenes (imagen, idcouch) VALUES ('$path','$couchid')";
                    mysqli_query($link, $query);                    
                }
                if($_FILES["img2"]["name"] != ""){
                    $imgtype= $_FILES["img2"]["type"];
                    $img= $_FILES["img2"]["tmp_name"];
                    $path= $couchid."/2.".getIMGType($imgtype);                        
                    @move_uploaded_file($img, "img/".$path);
                    $query= "INSERT INTO imagenes (imagen, idcouch) VALUES ('$path','$couchid')";
                    mysqli_query($link, $query);                    
                }
                if($_FILES["img3"]["name"] != ""){
                    $imgtype= $_FILES["img3"]["type"];
                    $img= $_FILES["img3"]["tmp_name"];
                    $path= $couchid."/3.".getIMGType($imgtype);                        
                    @move_uploaded_file($img, "img/".$path);
                    $query= "INSERT INTO imagenes (imagen, idcouch) VALUES ('$path','$couchid')";
                    mysqli_query($link, $query);                    
                }
                if($_FILES["img4"]["name"] != ""){
                    $imgtype= $_FILES["img4"]["type"];
                    $img= $_FILES["img4"]["tmp_name"];
                    $path= $couchid."/4.".getIMGType($imgtype);                        
                    @move_uploaded_file($img, "img/".$path);
                    $query= "INSERT INTO imagenes (imagen, idcouch) VALUES ('$path','$couchid')";
                    mysqli_query($link, $query);                    
                }
                if($_FILES["img5"]["name"] != ""){
                    $imgtype= $_FILES["img5"]["type"];
                    $img= $_FILES["img5"]["tmp_name"];
                    $path= $couchid."/5.".getIMGType($imgtype);                        
                    @move_uploaded_file($img, "img/".$path);
                    $query= "INSERT INTO imagenes (imagen, idcouch) VALUES ('$path','$couchid')";
                    mysqli_query($link, $query);                    
                }
                redirectAfter("cpanel.php?add", 1);
            } else{
                alert("Error al cargar los datos en la base de datos.");
            }                
        }
    } 
?>


<?php
    if(isset($_GET['id']) && $_GET['id']!=0){
        $userid=  getUserID();
        $usertypeid= getUserType($userid);
                    
		//CONSULTA COUCH-TIPOCOUCH
        $couchid= $_GET['id']; 
		$SQL= "SELECT * FROM couchs c LEFT JOIN tipocouchs tc ON c.idtipocouch=tc.idtipocouch WHERE c.idcouch=$couchid";
		$result = mysqli_query($link, $SQL);
                    
        //COMPRUEBA EXISTENCIA DE COUCH
        if(mysqli_num_rows($result)!= 0){
            $couchRow = mysqli_fetch_array($result);                        
            $ownerid= $couchRow['idusuario'];
                        
            //CONSULTA IMG					
            $SQL= "SELECT * FROM imagenes WHERE idcouch=$couchid ORDER BY imagen ASC";
            $imgResult = mysqli_query($link, $SQL);
            $imgRow = mysqli_fetch_array($imgResult);
            $imgamount= mysqli_num_rows($imgResult);
            if($imgamount == 0){
                $img= 'null.png';
                $okimg= false;
            } else{
                $img= $imgRow['imagen'];
                $okimg= true;
            }
                        
            //CONSULTA USUARIO DUEÑO DEL COUCH
            $SQL= "SELECT nombre,apellido FROM usuarios WHERE idusuario=$ownerid";
            $result= mysqli_query($link, $SQL);
            $userRow= mysqli_fetch_array($result);
            $lname= $userRow['apellido'];
            $fname= $userRow['nombre']; 
        }else
            echo '<script>showError("couchError")</script>';                    
	} else
		echo '<script>showError("noIdError")</script>';
?>
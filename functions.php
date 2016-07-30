<?php
function checkRequestsDate(){
    $link= connect();
    $date= getdate();
        $dd= $date['mday'];
        $mm= $date['mon'];
        $yy= $date['year'];
        $date= "$yy-$mm-$dd";
    $query= "UPDATE reservas SET idestado=4 WHERE idestado!=5 AND fecha_fin <= '$date'";
    $result= mysqli_query($link, $query);
}
function getCouchAVG($couchID){
    $link= connect();
    $query= "SELECT AVG(puntaje) FROM `puntajes-couchs` WHERE idcouch='$couchID'";
    $ratingRow= mysqli_fetch_array(mysqli_query($link, $query));
    if($ratingRow["AVG(puntaje)"] == NULL)
        return 0;
    else{
        $rating= round($ratingRow["AVG(puntaje)"], 2);
        return $rating;
    }
}
function getUserAVG($userID){
    $link= connect();
    $query= "SELECT AVG(puntaje) FROM `puntajes-usuarios` WHERE idusuario_puntuado='$userID'";
    $ratingRow= mysqli_fetch_array(mysqli_query($link, $query));
    if($ratingRow["AVG(puntaje)"] == NULL)
        return 0;
    else{
        $rating= round($ratingRow["AVG(puntaje)"], 2);
        return $rating;
    }
}
function confirm($texto){
    echo'<script language="javascript">confirm('.$texto.');</script>';
}
function back(){
    echo'<script language="javascript">history.back();</script>';
}
function redirect($url) {	
        echo'<script language="javascript">location.href="'.$url.'";</script>';
}

function deleteFolder($folder){
    foreach(glob($folder . "/*") as $file){
        if (is_dir($file))        
            deleteFolder($file);        
        else        
            unlink($file);        
    } 
    rmdir($folder);
}

    function redirectAfter($url, $seconds){
        sleep($seconds);
	redirect($url);
    }
    
    function alert($text){
        echo'<script language="javascript">alert("'.$text.'");</script>';
    }
    
    function redirectWithAlert($url, $text) {
            alert($text);
            redirect($url);
}
function redirectWithAlertAfter($url, $text, $seconds) {
            alert($text);
            redirectAfter($url, $seconds);
}
    
    function checkAuth() {
        if(empty($_SESSION['user'])){
            alert("Acceso denegado. Tenes que iniciar sesion para ingresar a esta seccion.");
            echo'<script>window.location="index.php";</script>';            
        }
    }
    
    function checkBackendAuth($userid) {
            $usertype= getUserType($userid);
            if($usertype != 3)
                    redirectWithAlert("index.php","Acceso denegado. Sólo el administrador puede ingresar a esta sección.");
}
    
    function checkSession() {
        session_start();
        $user = 'null';
        if (isset($_SESSION['user']))
            $user = $_SESSION['user'];
        if(empty($_COOKIE['userid']))
            setcookie("userid", 0, time() + 60*60*24 );
        return $user;            
    }
	function getUserID(){
        if(isset($_SESSION['userid']))
            $userid= $_SESSION['userid'];
		else
            $userid= 0;
		return $userid;
	}

    function getUserName($userID){
        $link= connect();
        if($userID != 0){
            $SQL= "SELECT nombre, apellido FROM usuarios WHERE idusuario='$userID'";
            $result= mysqli_query($link, $SQL);
            $row= mysqli_fetch_array($result);
            $name= $row["nombre"];
            $apellido= $row["apellido"];
            return "$name $apellido";
        } else
            return "";
    }
    
    function getOwnerID($couchID){
        $link= connect();
        if($couchID != 0){
            $SQL= "SELECT idusuario FROM couchs WHERE idcouch='$couchID'";
            $result= mysqli_query($link, $SQL);
            $row= mysqli_fetch_array($result);
            $userID= $row['idusuario'];
            return $userID;
        } else
            return "";
    }

	function getUserType($userid) {
		$link= connect();
        if($userid != 0){
            $SQL= "SELECT idtipousuario FROM usuarios WHERE idusuario='$userid'";
            $result= mysqli_query($link, $SQL);
            $usertypeRow= mysqli_fetch_array($result);
            $usertype= $usertypeRow['idtipousuario'];
        } else
            $usertype= 0;
		return $usertype;
	}
    
    function getCouchTypeID($couchid) {
		$link= connect();
		$SQL= "SELECT idtipocouch FROM couchs WHERE idcouch='$couchid'";
		$result= mysqli_query($link, $SQL);
		$couchtypeRow= mysqli_fetch_array($result);
		$couchtype= $couchtypeRow['idtipocouch'];
		return $usertype;
	}
    
    function getCouchType($typeID){
        $link= connect();
        $query= "SELECT nombre FROM tipocouchs WHERE idtipocouch='$typeID'";
        $result= mysqli_query($link, $query);
        $couchTypeRow= mysqli_fetch_array($result);
        $couchType = $couchTypeRow['nombre'];
        return $couchType;
    }
	
    function getIMGType($type){
        if($type == "image/jpg")
            return "jpg";
        if($type == "image/jpeg")
            return "jpg";
        if($type == "image/gif")
            return "gif";
        if($type == "image/png")
            return "png";
    }
    
	function getAuth() {
		if (isset($_SESSION['user']))
			return true;
		else 			
			return false;
	}

    function connect(){
		$link = mysqli_connect('localhost', 'bys', 'google', 'bd') or die("Error". mysqli_error($link));
        return $link;
    }
    
    function loadCouchs($option, $link){
        //Si es un array, entonces hicieorn una busqueda avanzada y tengo que considerar los datos.
        if (is_array($option)){
            $nom=$option['name'];
            $cap=$option['capacity'];
            $place=$option['place'];
            $desc=$option['description'];
            $tipoH=$option['tipoH'];
            $fechaI=$option['fechaI'];
            $fechaF=$option['fechaF'];
            $SQL = "SELECT * FROM couchs";

            if ($cap!=0){
                $SQL=$SQL." WHERE capacidad BETWEEN $cap and '99' AND titulo LIKE '%$nom%' AND descripcion LIKE '%$desc%' AND lugar LIKE '%$place%'";
            }else
                $SQL =$SQL." WHERE titulo LIKE '%$nom%' AND descripcion LIKE '%$desc%' AND lugar LIKE '%$place%'";
            if($tipoH!=0){
                $SQL=$SQL." AND idtipocouch='$tipoH'";
                $result2= mysqli_query($link, "SELECT * FROM tipocouchs WHERE idtipocouch='$tipoH'");
                $row2=mysqli_fetch_array($result2);
            }else{
                $result2= mysqli_query($link, "SELECT * FROM tipocouchs");
                $row2=mysqli_fetch_array($result2);
                }
            if($fechaI!="" AND $fechaF==""){
                $fechaF=date_create();
                $fechaF->modify('+2 year');
                $fechaF=serialize($fechaF);
                $fechaF=substr($fechaF, 35, 10);
            }
            if ($fechaI>$fechaF) {
                redirectWithAlert("advanced_search.php","Las fechas introducidas son incorrectas.");
            }

            if ($fechaI!="" AND $fechaF==""){
                //Si seleccionaron fecha de inicio pero no fecha limite, tomo las reservas de los 2 aÃ±os siguientes.
                $resultRFF=true;
            }elseif ($fechaI!="" AND $fechaF!=""){
                //Si seleccionaron las 2 fechas ME VOY A GUARDAR LOS COUCHS QUE TIENEN RESERVAS ENTRE LAS 2 FECHAS SELECCIONADAS. 
                $resultR2F=true;
            }elseif ($fechaI=="" AND $fechaF!="") {
                //Si seleccionaron fecha limite pero no fecha desde.
                $resultRFF=true;
                
            }
        }  
        //fin de la busqueda avanzada
        //Si no es null pero no es un array, entonces hicieron una busqueda basica.
         if(($option != 'null') and (!is_array($option))){
            $SQL = "SELECT * FROM couchs WHERE titulo LIKE '%$option%'";
            $result3 = mysqli_query($link, "SELECT * FROM tipocouchs");
            $row2 = mysqli_fetch_array($result3);
        //Si es null es porque hay que cargar los couchs sin ningun filtro.
        }elseif ($option=='null') 
            $SQL = "SELECT * FROM couchs AS c LEFT JOIN tipocouchs AS tc ON c.idtipocouch=tc.idtipocouch";               
        echo' <table class="table">
            <tr>    
            <td>Imagen</td>
            <td>Titulo</td>
            <td>Tipo</td>
            <td>Capacidad</td>
            <td>Puntaje</td>
            <td>Lugar</td>
            </tr>';
        $result = mysqli_query($link,$SQL);
        if (mysqli_num_rows($result) != 0){
                while ($row = mysqli_fetch_array($result)){
                    if($row['habilitado'] == 1){
                        //SI ESTA SETEADA ALGUNA FECHA.
                      if ((isset($resultR2F))||(isset($resultRFF))||(isset($resultRFI))){
                        //SI ESTAN SETEADAS LAS 2 FECHAS FILTRO LOS COUCHS A MOSTRAR POR LAS 2 FECHAS SELECCIONADAS.
                        if ((isset($resultR2F)) and ($resultR2F!=NULL)){
                            $bool=false;
                            $SQL2= "SELECT c.idcouch FROM couchs AS c LEFT JOIN reservas AS tc ON c.idcouch=tc.idcouch WHERE ((fecha_inicio BETWEEN '$fechaI' AND '$fechaF') OR (fecha_fin BETWEEN '$fechaI' AND '$fechaF') OR (fecha_inicio<='$fechaI' AND fecha_fin>='$fechaF')) AND (idestado=2)";
                            $resultR=mysqli_query($link,$SQL2);

                        //SI ESTA SETEADA SOLO LA FECHA "HASTA" TOMO "HOY" COMO LA FECHA DESDE PARA VER LOS COUCHS SIN RESERVAS
                        }elseif ((isset($resultRFF)) and ($resultRFF!=NULL)){
                            $bool=false;
                            $fechaI=date_create();
                            $fechaI=serialize($fechaI);
                            $fechaI=substr($fechaI, 35, 10);
                            $SQL2= "SELECT c.idcouch FROM couchs AS c LEFT JOIN reservas AS tc ON c.idcouch=tc.idcouch WHERE ((fecha_inicio BETWEEN '$fechaI' AND '$fechaF') OR (fecha_fin BETWEEN '$fechaI' AND '$fechaF') OR (fecha_inicio<='$fechaI' AND fecha_fin>='$fechaF')) AND (idestado=2)";
                            $resultR=mysqli_query($link,$SQL2);
                        
                        //SI ESTA SETEADA SOLO LA FECHA INICIAL VOY A VER LOS COUCHS QUE NO TIENEN RESERVA EN LOS 2 SIGUIENTES AÃ‘OS.          
                        }elseif((isset($resultRFI)) and ($resultRFI!=NULL)){
                            $bool=false;
                            $fechaF=date_create();
                            $fechaF->modify('+2 year');
                            $fechaF=serialize($fechaF);
                            $fechaF=substr($fechaF, 35, 10);
                            $SQL2= "SELECT c.idcouch FROM couchs AS c LEFT JOIN reservas AS tc ON c.idcouch=tc.idcouch WHERE ((fecha_inicio BETWEEN '$fechaI' AND '$fechaF') OR (fecha_fin BETWEEN '$fechaI' AND '$fechaF') OR (fecha_inicio<='$fechaI' AND fecha_fin>='$fechaF')) AND (idestado=2)";
                            $resultR=mysqli_query($link,$SQL2);
                        }
                            //VOY A RECORRER EL ARREGLO DE LA CONSULTA DE RESERVAS ENTRE LAS FECHAS PREGUNTANDO SI EL COUCH QUE ESTOY PROCESANDO ESTÃ� EN DICHA CONSULTA.
                            while (($rowR=mysqli_fetch_row($resultR)) and ($bool==false))
                                $bool=in_array($row['idcouch'], $rowR);

                            //SI NO ESTÃ� EN LA CONSULTA LO MUESTRO, SI ESTÃ� EN LA CONSULTA ES PORQUE TIENE RESERVAS ENTRE LAS FECHAS Y NO LO MUESTRO.
                            if (!($bool)){
                                $userid= $row['idusuario']; 
                                $couchid= $row['idcouch'];
                                // CONSULTA TIPO DE USUARIOS
                                $usertype= getUserType($userid);
                                 //CONSULTA DE IMAGEN PRINCIPAL
                                 $SQL= "SELECT * FROM imagenes WHERE idcouch=$couchid";
                                 $result2= mysqli_query($link, $SQL);
                                 if (mysqli_num_rows($result2) != 0){
                                    $imgRow= mysqli_fetch_array($result2);
                                    $okimg= true;
                                 }else
                                        $okimg= false;                                                                                
                                 echo'<tr>';
                                    if($usertype == 1)
                                        echo'<td class="item"><a href="show.php?id='.$row[0].'"><img src="img/couchinn.png" width=80px height=80px ></a></td> ';
                                    else{
                                        if($okimg)
                                            echo'<td class="item"><a href="show.php?id='.$row[0].'"><img src="img/'.$imgRow["imagen"].'" width=80px height=80px ></a></td>';
                                        else    
                                            echo'<td class="item"><a href="show.php?id='.$row[0].'"><img src="img/null.png" width=80px height=80px ></a></td>';
                                    }
                                    echo '<td class="item"><a href="show.php?id='.$row[0].'">'.$row["titulo"].'</a></td>';
                                    if ($option=='null')
                                        echo '<td class="item">'.$row["nombre"].'</td>';
                                    else{
                                        $idtipo=$row['idtipocouch'];
                                        $result2= mysqli_query($link, "SELECT * FROM tipocouchs WHERE idtipocouch='$idtipo'");
                                        $row2=mysqli_fetch_array($result2);
                                        echo '<td class="item">'.$row2["nombre"].'</td>';
                                    }
                                    echo '<td class="item">'.$row["capacidad"].'</td>';                        
                                echo '<td class="item"><a href="couchRating.php?id='.$couchid.'">'.getCouchAVG($couchid).'</a></td>';
                                echo '<td class="item">'.$row["lugar"].'</td>';
                                echo'</tr>';
                            }
                        }
                        else{
                       $userid= $row['idusuario']; 
                       $couchid= $row['idcouch'];
                       // CONSULTA TIPO DE USUARIOS
                       $usertype= getUserType($userid);
                        //CONSULTA DE IMAGEN PRINCIPAL
                        $SQL= "SELECT * FROM imagenes WHERE idcouch=$couchid";
                        $result2= mysqli_query($link, $SQL);
                        if (mysqli_num_rows($result2) != 0){
                           $imgRow= mysqli_fetch_array($result2);
                           $okimg= true;
                        }else
                            $okimg= false;                                
                                                                    
                        echo'<tr>';
                        if($usertype == 1)
                             echo'<td class="item"><a href="show.php?id='.$row[0].'"><img src="img/couchinn.png" width=80px height=80px ></a></td> ';
                         else{
                            if($okimg)
                               echo'<td class="item"><a href="show.php?id='.$row[0].'"><img src="img/'.$imgRow["imagen"].'" width=80px height=80px ></a></td>';
                             else    
                                echo'<td class="item"><a href="show.php?id='.$row[0].'"><img src="img/null.png" width=80px height=80px ></a></td>';
                             }
                            echo '<td class="item"><a href="show.php?id='.$row[0].'">'.$row["titulo"].'</a></td>';
                            if ($option=='null')
                                echo '<td class="item">'.$row["nombre"].'</td>';
                            else{
                                $idtipo=$row['idtipocouch'];
                                $result2= mysqli_query($link, "SELECT * FROM tipocouchs WHERE idtipocouch='$idtipo'");
                                $row2=mysqli_fetch_array($result2);
                                echo '<td class="item">'.$row2["nombre"].'</td>';
                            }
                            echo '<td class="item">'.$row["capacidad"].'</td>';                        
                            echo '<td class="item"><a href="couchRating.php?id='.$couchid.'">'.getCouchAVG($couchid).'</a></td>';
                            echo '<td class="item">'.$row["lugar"].'</td>';
                            echo'</tr>';
                    }  
                }
            }                       
                echo'</table>';
            }else {
                echo '
                    </table>
                    <div id="tableError">
                        <p>No se encontraron resultados.</p>
                    </div>';
            }
    }
	
	function show($option) {
        switch ($option) {
            case 'header':
                checkRequestsDate();
                $user = checkSession();
                if($user == 'null'){
                        $okauth= false;
                        $usertype=0;
                }else{
                       $okauth= true;
                        $userid= getUserID();
                        $usertype= getUserType($userid);
                }
                echo '
                    <div id="head">
                        <div id="logo1">
                            <img src="img/logo.png">
                        </div>
                        <div id="menu1">
                            <div id="menu1Options">
                                <a href="index.php" class="fade">INICIO</a>
				';
				if(!($okauth))
					echo '<a href="register.php" class="fade">REGISTRARSE</a>';
				echo '
                                <a href="premium.php" class="fade">PREMIUM</a>';
                                if($okauth)
                                        echo '<a href="profile.php" class="fade">MI PERFIL</a>';
                                if($usertype == 3)
                                        echo '<a href="backend.php" class="fade">CONFIGURAR</a>';
                                echo'
                            </div>								
                        </div>
                    <div id="#loginPanel">';                     
                if($user != 'null') 
                    echo'
                        <div id=texto1>
                            <label class="bienvenido">Bienvenido '.$user.'</label><br>
                        </div>
                        <div id=texto2> 
                            <a href="cpanel.php" class="fade" id="fadeButton"><span class="icon-clipboard"></span>Panel</a> <a class="separador"> | </a> 
                            <a href="logout.php" class="fade" id="fadeButton"><span class="icon-exit"></span>Salir</a>
                        </div>
                    ';
                else
                    echo'
                        <div id=texto1>
                            <a class="fade" href="login.php">Ingresar</a>
                        </div>
                        </div> 
                        </div>               
                    ';        
            break;            
            case 'footer':
                echo '
                    <div id="footer">
                        CouchInn © 2016
                    </div> 
                ';
            break;
        }
    }    
?>
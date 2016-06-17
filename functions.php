<?php 
function confirm($texto){
    echo'<script language="javascript">confirm('.$texto.');</script>';
}
function back(){
    echo'<script language="javascript">history.back();</script>';
}
function redirect($url) {	
        echo'<script language="javascript">location.href="'.$url.'";</script>';
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
		$userid= $_COOKIE['userid'];
		return $userid;
	}
	function getUserType($userid) {
		$link= connect();
		$SQL= "SELECT idtipousuario FROM usuarios WHERE idusuario='$userid'";
		$result= mysqli_query($link, $SQL);
		$usertypeRow= mysqli_fetch_array($result);
		$usertype= $usertypeRow['idtipousuario'];
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
            return "jpeg";
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
		$link = mysqli_connect('localhost', 'bys', 'google', 'bdatos') or die("Error". mysqli_error($link));
//      $link = mysqli_connect('mysql.hostinger.com.ar', 'u278563399_bys', 'google', 'u278563399_bd') or die("Error". mysqli_error($link));
        return $link;
    }
        function loadCouchs($option, $link) {
                if($option == 'null'){
                        echo'
                                <table class="table">
					<tr>	
						<td>Imagen</td>
						<td>Titulo</td>
						<td>Tipo</td>
						<td>Capacidad</td>
						<td>Puntaje</td>
						<td>Lugar</td>
					</tr>
                        ';
			$SQL = "SELECT * FROM couchs AS c LEFT JOIN tipocouchs AS tc ON c.idtipocouch=tc.idtipocouch";
			$result = mysqli_query($link, $SQL);            
			if (mysqli_num_rows($result) != 0){
				while ($row = mysqli_fetch_array($result)) {
                                        if($row['habilitado'] == 1){
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
                                                }else{
                                                        $okimg= false;
                                                }                                                
                                                echo'<tr class="listItem">';
                                                if($usertype == 1)
                                                        echo'<td class="item"><a href="show.php?id='.$row[0].'"><img src="img/couchinn.png" width=80px height=80px ></a></td> ';
                                                else{
                                                        if($okimg)
                                                                echo'<td class="item"><a href="show.php?id='.$row[0].'"><img src="img/'.$imgRow["imagen"].'" width=80px height=80px ></a></td>';
                                                        else 	
                                                                echo'<td class="item"><a href="show.php?id='.$row[0].'"><img src="img/null.png" width=80px height=80px ></a></td>';
                                                }
                                                echo '<td class="item"><a href="show.php?id='.$row[0].'">'.$row["titulo"].'</a></td>';
                                                echo '<td class="item">'.$row["nombre"].'</td>';
                                                echo '<td class="item">'.$row["capacidad"].'</td>';                        
                                                echo '<td class="item">'.$row["puntaje"].'</td>';
                                                echo '<td class="item">'.$row["lugar"].'</td>';
                                                echo'</tr>';
                                        }
				}						
				echo'</table>';
			} else {
				echo '
					</table>
					<div id="tableError">
						<p>No se encontraron resultados.</p>
					</div>';
			}
                }
        }
	
	function show($option) {
        switch ($option) {
            case 'header': 
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
                                <a href="premium.php" class="fade">PREMIUM</a>
                                <a href="" class="fade">CONTACTO</a>';
                                if($okauth)
                                        echo '<a href="profile.php" class="fade">MI PERFIL</a>';
                                if($usertype == 3)
                                        echo '<a href="backend.php" class="fade">BACKEND</a>';
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
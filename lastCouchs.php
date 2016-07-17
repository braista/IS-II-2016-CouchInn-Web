<html>
    <head> 
        <script type="text/javascript" src="/functions.js"></script>                       
       	<link rel="stylesheet" href="CSS/main.css">               
        <script src="jquery/jquery-1.12.4.min.js" type="text/javascript"></script>
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <?php 
        include_once 'functions.php';
        $link=  connect();        
        ?>  
        <title>CouchInn - Últimos hospedajes</title>
	</head>
		<body>
			<!-- HEADER -->
			<header>		
                <?php
                show('header');
                //SE VERIFICA QUE EL USUARIO SE ENCUENTRA LOGUEADO Y QUE ES UN ADMINISTRADOR                                
                checkAuth();
                ?>
			</header>
	       <!-- CONTENEDOR-->
			<div id="contenedor">
                <div id="content">                    
                    <div id="backButton">
                        <a id="backButton" class="fade" href="cpanel.php">◄ Atrás</a>
                    </div>
                    <div id="info">
                    <div id="title">
                        <p class="noMargin">Últimos hospedajes donde me alojé</p>
                    </div>
                        <table class="table">
                            <tr>    
                                <td>Imagen</td>
                                <td>Título</td>
                                <td>Puntaje</td>
                                <td>Dueño</td>
                                <td>Desde</td>
                                <td>Hasta</td>
                                <td style="width: 15%;">Calificar</td>
                            </tr>
                            <?php
                                $userID= getUserID();
                                $SQL = "SELECT * FROM reservas WHERE idusuario = '$userID' AND (idestado='4' OR idestado='5' OR idestado='2') ORDER BY idreserva DESC";
                                $result = mysqli_query($link, $SQL);
                                if(mysqli_num_rows($result) != 0){
                                    while ($row = mysqli_fetch_array($result)) { 
                                        $couchID= $row['idcouch'];
                                        $query= "SELECT * FROM imagenes WHERE idcouch='$couchID' ORDER BY idimagen";
                                        $imgRow= mysqli_fetch_array(mysqli_query($link, $query));
                                        $query= "SELECT * FROM couchs WHERE idcouch='$couchID'";
                                        $couchRow= mysqli_fetch_array(mysqli_query($link, $query));
                                        $userID= getOwnerID($couchID);
                                        $requestID= $row['idreserva'];
                                        $amount = $row['cantidad'];
                                        $fdate = date('d/m/Y', strtotime($row['fecha_inicio']));
                                        $tdate = date('d/m/Y', strtotime($row['fecha_fin']));
                                        $status = $row['idestado'];
                                        echo'<tr class="listItem">';                                        
                                        echo '<td class="item"><a href="show.php?id='.$couchID.'"><img src="img/'.$imgRow["imagen"].'" width="60px" height="60px"></a></td>';
                                        echo '<td class="item">'.$couchRow["titulo"].'</td>';
                                        echo '<td class="item">
                                                    <a href="couchRating.php?id='.$couchID.'"><p>'.getCouchAVG($couchID).'</p></a>
                                                </td>';
                                        echo '<td class="item"><a href="userProfile.php?id='.getOwnerID($couchID).'">'.getUserName(getOwnerID($couchID)).'</a></td>';
                                        echo '<td class="item">'.$fdate.'</td>';
                                        echo '<td class="item">'.$tdate.'</td>';
                                        if($status == 2){?>
                                            <td class="item">
                                                <button id="button" onclick="alert('La estadia debe haber finalizado para poder calificar')" style="background-color: grey;">Calificar</button>
                                            </td>
                                        <?php
                                        }else if ($status == 4){?>                                            
                                            <td class="item">
                                                <form action="rateCouch.php" method="POST">
                                                    <input type="hidden" name="couchID" value="<?php echo $couchID; ?>">
                                                    <input type="submit" title="Calificar hospedaje" class="button" value="Calificar">
                                                </form>
                                            </td>                                          
                                        <?php 
                                        } else if ($status == 5){
                                            $userID= getUserID();
                                            $query= "SELECT * FROM `puntajes-couchs` WHERE idusuario=$userID AND idcouch=$couchID";
                                            $ratingRow= mysqli_fetch_array(mysqli_query($link, $query));
                                            $rating= $ratingRow['puntaje'];
                                            ?>
                                                <td class="item">
                                                    <p><?php echo $rating; ?></p>
                                                </td>
                                            </td>
                                        <?php
                                        }
                                        echo'</tr>';
                                    }                                    
                                }
                            echo'</table>'; 
                            ?> 
                    </div>
                </div>
			</div>
			<footer>
    			<div id="footer">
        			CouchInn © 2016
    			</div>                       
    		</footer>
		</body>
</html>
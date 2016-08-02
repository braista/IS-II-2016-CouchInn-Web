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
        <title>CouchInn - Últimos huéspedes</title>
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
                        <p class="noMargin">Últimos huéspedes</p>
                    </div>
                        <table class="table">
                            <tr>
                                <td>Couch</td>
                                <td>Huesped</td>
                                <td>Puntaje</td>
                                <td>Desde</td>
                                <td>Hasta</td>
                                <td style="width: 15%;">Calificar</td>
                            </tr>
                            <?php
                                $userID= getUserID();
                                $query= "SELECT * FROM reservas WHERE (idestado= 2 OR idestado=4) AND idcouch IN(SELECT idcouch FROM couchs WHERE idusuario=$userID)";
                                $result= mysqli_query($link, $query);
                                if(mysqli_num_rows($result)!= 0){
                                    while($row= mysqli_fetch_array($result)){
                                        $otherID= $row['idusuario'];                                        
                                        $fdate = $row['fecha_inicio'];
                                        $tdate = $row['fecha_fin'];
                                        $couchID= $row['idcouch'];                                        
                                        $state= $row['idestado'];
                                        $requestID= $row['idreserva'];
                                        $query= "SELECT * FROM usuarios WHERE idusuario=$otherID";
                                        $result2= mysqli_query($link, $query);
                                        $userRow= mysqli_fetch_array($result2);
                                        $query= "SELECT * FROM imagenes WHERE idcouch='$couchID' ORDER BY idimagen";
                                        $imgRow= mysqli_fetch_array(mysqli_query($link, $query));
                                        echo'<tr class="listItem">';
                                        echo '<td class="item"><a href="show.php?id='.$couchID.'"><img src="img/'.$imgRow["imagen"].'" width="60px" height="60px"></a></td>';
                                        echo '<td class="item"><a href="userProfile.php?id='.$otherID.'">'.getUserName($otherID).'</a></td>';                                        
                                        echo '<td class="item"><a href="userRating.php?id='.$otherID.'"><p>'.getUserAVG($otherID).'</p></a></td>';
                                        echo '<td class="item">'.date('d/m/Y', strtotime($fdate)).'</td>';
                                        echo '<td class="item">'.date('d/m/Y', strtotime($tdate)).'</td>';
                                        if($state == 2){?>
                                            <td class="item">
                                                    <button id="button" onclick="alert('La estadia debe haber finalizado para poder calificar')" style="background-color: grey;">Calificar</button>
                                            </td>
                                        <?php
                                        }else{
                                            $query= "SELECT * FROM `puntajes-usuarios` WHERE idreserva=$requestID";
                                            $qresult= mysqli_query($link, $query);
                                            if(mysqli_num_rows($qresult) == 0){
                                                ?>
                                                <td class="item">
                                                    <form action="rateUser.php" method="POST">
                                                        <input type="hidden" name="userID" value="<?php echo $otherID; ?>">                                                        
                                                        <input type="hidden" name="requestID" value="<?php echo $requestID; ?>">
                                                        <input type="submit" title="Calificar huesped" class="button" value="Calificar">
                                                    </form>
                                                </td>
                                                <?php                                            
                                            } else{
                                                $ratingRow= mysqli_fetch_array($qresult); ?>
                                                <td class="item"><?php echo $ratingRow['puntaje']; ?></td>
                                        <?php
                                            }
                                        }
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </table>
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
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
        <title>CouchInn - Solicitudes enviadas</title>
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
                        <a id="backButton" class="fade" href="show.php?id=<?php echo $couchID;?>">◄ Atrás</a>
                    </div>
                    <div id="title">
                        <p class="noMargin">Solicitudes enviadas</p>
                    </div>
                        <table class="table">
                            <tr>    
                                <td>Enviada a</td>
                                <td>Personas</td>
                                <td>Desde</td>
                                <td>Hasta</td>
                                <td>Estado</td>
                                <td>Opción</td>
                            </tr>
                            <?php
                                $userID= getUserID();
                                $SQL = "SELECT * FROM reservas WHERE idusuario = '$userID' ORDER BY idreserva DESC";
                                $result = mysqli_query($link, $SQL);
                                if(mysqli_num_rows($result) != 0){
                                    while ($row = mysqli_fetch_array($result)) { 
                                        $couchID= $row['idcouch'];
                                        $userID= getOwnerID($couchID);
                                        $requestID= $row['idreserva'];
                                        $amount = $row['cantidad'];
                                        $fdate = $row['fecha_inicio'];
                                        $tdate = $row['fecha_fin'];
                                        $status = $row['idestado'];
                                        echo'<tr class="listItem">';
                                        echo '<td class="item"><a href="show.php?id='.$couchID.'">'.getUserName($userID).'</a></td>';
                                        echo '<td class="item">'.$amount.'</td>';                        
                                        echo '<td class="item">'.$fdate.'</td>';
                                        echo '<td class="item">'.$tdate.'</td>';
                                        if($status == 1){  ?>
                                            <td class="pendingItem">Pendiente</td>
                                            <td class="item">
                                                <form action="cancelRequest.php" method="POST" onsubmit="return (confirm('¿Cancelar la solicitud?'));">
                                                    <input type="hidden" name="requestID" value="<?php echo $requestID; ?>">
                                                    <input type="image" value="Cancelar" src="img/del.gif" title="Cancelar solicitud" width=18px height=18px>
                                                </form>
                                            </td>
                                        <?php
                                        }
                                        else if ($status == 3){?>
                                            <td class="rejectedItem">Rechazada</td>
                                            <td class="item">
                                                <form action="cancelRequest.php" method="POST">
                                                    <input type="hidden" name="requestID" value="<?php echo $requestID; ?>">
                                                    <input type="image" value="Limpiar" src="img/clean.png" title="Limpiar solicitud rechazada" width=18px height=18px>
                                                </form>
                                            </td>                                      
                                        <?php    
                                        } else{ ?>
                                            <td class="acceptedItem">Aceptada</td>
                                            <td class="item">
                                                <form action="userProfile.php" method="POST">
                                                    <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                                                    <input type="image" value="Perfil" src="img/profile.png" title="Ver perfil de usuario" width=18px height=18px>
                                                </form>
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
			<footer>
    			<div id="footer">
        			CouchInn © 2016
    			</div>                       
    		</footer>
		</body>
</html>
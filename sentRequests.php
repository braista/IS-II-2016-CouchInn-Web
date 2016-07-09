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
                                <td>Opciones</td>
                            </tr>
                            <?php
                                $userID= getUserID();
                                $SQL = "SELECT * FROM reservas WHERE idusuario = '$userID' ORDER BY idreserva DESC";
                                $result = mysqli_query($link, $SQL);
                                if(mysqli_num_rows($result) != 0){
                                    while ($row = mysqli_fetch_array($result)) {
                                        $id = $row['idusuario'];
                                        $usuario =getUserName($id);
                                        $personas = $row['cantidad'];
                                        $desde = $row['fecha_inicio'];
                                        $hasta = $row['fecha_fin'];
                                        echo'<tr class="listItem">';
                                        echo '<td class="item">'.$usuario.'</td>';
                                        echo '<td class="item">'.$personas.'</td>';                        
                                        echo '<td class="item">'.$desde.'</td>';
                                        echo '<td class="item">'.$hasta.'</td>';
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
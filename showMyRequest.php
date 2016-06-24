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
        	<title>CouchInn - Reservas</title>
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
                <?php echo '<div id="backButton">
                                <a id="backButton" class="fade" href="javascript:history.back()">◄ Atrás</a>
                            </div>';
                ?> 
                <div id="content">
                    <div id="title">
                    <?php
                    if (isset($_REQUEST['couch'])) {
                        $couchId = $_REQUEST['couch'];
                        $link = connect();
                        $SQL = "SELECT * FROM couchs WHERE idcouch = '$couchId'";
                        $result = mysqli_query($link, $SQL); 
                        $row = mysqli_fetch_array($result);
                        $titulo = $row['titulo'];
                    }
                    echo'<p>Solicitudes para '.$titulo.'</p>
                    ';
                    ?>
                    </div>
                        <table class="table">
                            <tr>    
                                <td>Usuario</td>
                                <td>Personas</td>
                                <td>Desde</td>
                                <td>Hasta</td>
                            </tr>
                            <?php  
                            if (isset($_REQUEST['couch'])) {
                                $couchId = $_REQUEST['couch'];
                                $link = connect();
                                $SQL = "SELECT * FROM reservas WHERE idcouch = '$couchId' AND idestado = 0";
                                $result = mysqli_query($link, $SQL);
                            } 
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
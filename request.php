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
        	<title>CouchInn - Reserva</title>
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
            <?php
                echo '<div id="back">
                    <a id="backButton" class="fade" href="javascript:history.back()">◄ Atrás</a>
                </div>';
                    if (isset($_REQUEST['user'])) {
                        $couchId = $_REQUEST['couch'];
                        $usuarioId = $_REQUEST['user'];
                    }
                    if (isset($_REQUEST['iDate'])) {
                         $desde_Fec = $_REQUEST['iDate'];
                         $hasta_Fec = $_REQUEST['fDate'];
                         $couchId = $_REQUEST['couch'];
                         $userId = $_REQUEST['user'];
                         $cant = $_REQUEST['cant'];
                         $link = connect();
                         $SQL = "SELECT * FROM couchs WHERE idcouch = '$couchId'";
                         $result = mysqli_query($link, $SQL);
                         $row = mysqli_fetch_array($result);
                        if ($cant!=0)
                         if ($cant <= $row['capacidad']) {
                         	$SQL = "INSERT INTO reservas(cantidad, fecha_inicio, fecha_fin, idusuario, idcouch, idestado) VALUES ('$cant', '$desde_Fec', '$hasta_Fec', '$userId', '$couchId', '0')";
                         	mysqli_query($link,$SQL);
                         	redirectWithAlert("index.php", "Se ha reservado correctamente");
                         }else
                         	Alert("Se ingresó una capacidad invalida, verifique La cantidad aceptada por el couch");
                        else
                            Alert("Revise la cantidad de personas que se Hospedarán y vuelva a intentarlo");
                         
                         } ?>
                                <div id="content">
                                        <div id="info">
                                                <div id="title">
                                                        <p>Reservar</p>
                                                </div>
                                                <p style="clear: both; text-indent: 1%;">Elija entre dos fechas el tiempo que desea realizar su experiencia.</p>
                                
                                                <div id="registerSection">
                                                        <form name="register"  action="request.php" method="POST">
                                                                    <div id="formItem">
                                                                        <div class="formLabel">
                                                                            <label>Desde:</label>
                                                                        </div>
                                                                        <div class="formInput">
                                                                                <input type="date" name="iDate" required>
                                                                        </div>
                                                                    </div>
                                                                    <div id="formItem">
                                                                        <div class="formLabel">
                                                                            <label>Hasta:</label>
                                                                        </div>
                                                                        <div class="formInput">
                                                                                <input type="date" name="fDate" required>
                                                                        </div>
                                                                    </div>
                                                                     <div id="formItem">
                                                                        <div class="formLabel">
                                                                            <label>Cantidad de personas:</label>
                                                                        </div>
                                                                        <div class="formInput">
                                                                                <input type="number" name="cant" required>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="couch" value="<?php echo $couchId; ?>">
                                                                    <input type="hidden" name="user" value="<?php echo $usuarioId; ?>">
                                                                                                                                                   
                                                                <div id="loginSubmit">
                                                                        <input type="submit" id="button" value="Confirmar">
                                                                </div>
                                                        </form>
                                                </div>
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
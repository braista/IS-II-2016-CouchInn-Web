<html>
    <head>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="fonts/style.css">
        <script type="text/javascript" src="/functions.js"></script>
        <script src="jquery/jquery-1.12.4.min.js" type="text/javascript"></script>
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <?php
            include_once 'functions.php';            
            $link=  connect();            
        ?>                
        <title>CouchInn - Mi perfil</title>
    </head>
        <body>
		<!-- HEADER -->
		
		<header>
			<?php
				show('header');
                //SE VERIFICA QUE EL USUARIO SE ENCUENTRA LOGUEADO
                checkAuth();
			?>
		</header>
	
		<!-- CONTENEDOR-->
		
		<div id="contenedor">			
            <?php
                $userid= $_COOKIE['userid'];
                $SQL= "SELECT * FROM usuarios u LEFT JOIN tipousuarios tu ON u.idtipousuario=tu.idtipousuario WHERE idusuario=$userid";
                $result = mysqli_query($link, $SQL);
                $userRow= mysqli_fetch_array($result);
                $bdate= date('d/m/Y', strtotime($userRow['fnacimiento']));
            ?>
            <div id="content">
                <div id="back">
                    <a id="backButton" class="fade" href="javascript:history.back()">◄ Atrás</a>
				</div>
                <?php
                    // CARTEL DE MODIFICACION CORRECTA Y CODIGO JQUERY PARA OCULTAR EN CASO DE CLICK
                    if(isset($_GET['ok']) && $_GET['ok']== 'true'){ ?>
                        <div id="okUpdate" class="ok">
                            <img src="img/ok.png" class="okImg">
                            <p class="noMargin">Los datos del perfil se modificaron correctamente.</p>
                        </div>
                        <script>
                            hideDivBlur('#okUpdate');
                        </script>
                <?php
                    }
                ?> 
				<div id="info">
                    <div id="title">
                        <p>Datos de perfil</p>
                    </div>
                    <div id="profileModForm">
                        <form action="editProfile.php" method="POST">
                            <input type="hidden" name="couch" value="<?php echo $couchid; ?>">                            
                            <input type="submit" id="button" value="Editar perfil">
                        </form>
                    </div>
                    <div id="profileDetails1">
                        <p>Apellido:</p>
			<p>Nombre:</p>
			<p>Fecha de nacimiento:</p>
			<p>Puntaje:</p>
                        <p>Telefono:</p>
			<p>Tipo de usuario:</p>
					</div>
                    <div id="profileDetails2">
                        <p><?php echo $userRow['apellido']; ?></p>
                        <p><?php echo $userRow['nombre']; ?></p>
			<p><?php echo $bdate; ?></p>
			<p><?php echo $userRow['puntaje']; ?></p>
                        <p><?php echo $userRow['telefono']; ?></p>
			<p><?php echo $userRow['tipo']; ?></p>
                    </div>
				</div>
            </div>
		</div>
        <footer>
            <?php    
                show('footer');
            ?>                       
        </footer>
        </body>
</html>
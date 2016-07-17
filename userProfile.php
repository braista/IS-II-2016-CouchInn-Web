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
        <title>CouchInn - Ver perfil</title>
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
            if(count($_POST)!= 0){
                $userID= $_POST['userID'];
                $SQL= "SELECT * FROM usuarios u LEFT JOIN tipousuarios tu ON u.idtipousuario=tu.idtipousuario WHERE idusuario=$userID";
                $result = mysqli_query($link, $SQL);
                $userRow= mysqli_fetch_array($result);
                $bdate= date('d m Y', strtotime($userRow['fnacimiento']));                
            } else if(count($_GET) != 0){
                $userID= $_GET['id'];
                $SQL= "SELECT * FROM usuarios u LEFT JOIN tipousuarios tu ON u.idtipousuario=tu.idtipousuario WHERE idusuario=$userID";
                $result = mysqli_query($link, $SQL);
                $userRow= mysqli_fetch_array($result);
                $bdate= date('d m Y', strtotime($userRow['fnacimiento']));
            }
            ?>
            <div id="content">
                <div id="back">
                    <a id="backButton" class="fade" href="javascript:history.back()">◄ Atrás</a>
				</div>
				<div id="info">
                    <div id="title">
                        <p>Perfil del usuario <?php echo getUserName($userID);?></p>
                    </div>
                    <div id="profileDetails">
                        <div id="profileDetails1">
                            <p>Apellido:</p>
                            <p>Nombre:</p>
                            <p>Fecha de nacimiento:</p>
                            <p>Puntaje:</p>
                            <p>Tipo de usuario:</p>
                        </div>
                        <div id="profileDetails2">
                            <p><?php echo $userRow['apellido']; ?></p>
                            <p><?php echo $userRow['nombre']; ?></p>
                            <p><?php echo $bdate; ?></p>
                            <a href="userRating.php?id=<?php echo $userID;?>"><p><?php echo getUserAVG($userID); ?></p></a>
                            <p><?php echo $userRow['tipo']; ?></p>
                        </div>
                    </div>
                    <div id="sub">
                        <p id="subtitle">Datos de contacto:</p>
                    </div>
                    <div id="profileDetails1">
                        <p>Telefono</p>
                        <p>Email</p>
                    </div>
                    <div id="profileDetails2">
                        <p><?php echo $userRow['telefono']; ?></p>
                        <p><?php echo $userRow['email']; ?></p>
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
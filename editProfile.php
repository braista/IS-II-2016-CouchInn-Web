<html>
    <head>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="fonts/style.css">
        <script type="text/javascript" src="/functions.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <?php
            include_once 'functions.php';            
            $link=  connect();            
        ?>                
        <title>CouchInn - Editar perfil</title>
    </head>
        <body>
		<!-- HEADER -->
		
		<header>
			<?php
				show('header');                
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
            ?>
            <div id="content">
                               
				<div id="info">
                    <div id="title">
                        <p>Editar perfil</p>
                    </div>                    
                    <div id="editProfile">
                        <form name="profile" id="editProfileForm" method="POST" action="updateProfile.php" onsubmit="return (formValidation('profile'))">
                            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                            Apellido:<br>
                            <input type="text" name="lname" value="<?php echo $userRow['apellido']; ?>" placeholder="Ingrese su nuevo apellido" required><br>
                            Nombre:<br>
                            <input type="text" name="fname" value="<?php echo $userRow['nombre']; ?>" placeholder="Ingrese su nuevo nombre" required><br>
                            Teléfono:<br>
                            <input type="text" name="phonen" value="<?php echo $userRow['telefono']; ?>" minlength="10" maxlength="11" placeholder="Ej: 2214256369 (sin parentesis)" required><br>
                            Fecha de nacimiento:<br>
                            <input type="date" name="bdate" value="<?php echo $userRow['fnacimiento']; ?>" required><br>   
                            <div id="editProfileButtons">
                                <input id="button" type="submit" value="Editar perfil">
                                <input type="button" id="button" value="Cancelar" onclick="confirmCancel()">
                            </div>
                        </form>
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
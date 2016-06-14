<html>
		<head>
       		    <link rel="stylesheet" href="CSS/main.css">
        		<link rel="stylesheet" href="fonts/style.css">
				<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        		<?php 
                include_once 'functions.php';
                $link=  connect();
                ?>  
        		<title>CouchInn - Recuperar Contraseña</title>
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
                                                <div id="info">
                                                        <div id="title">
                                                                <p>Recuperar contraseña</p>
                                                        </div>
                                                        <p class="texto_biselado desc"  style="clear: both">• Se enviara un mail con su contraseña a la siguiente direccion:</p>
                                                        <div id="recoveryForm">
                                                                <form id= "pasform" name="pasform" method="post" action="password.php">										
										<label class="texto_biselado desc" for="nombre">• Email: </label><br>
												<input style="margin: auto" maxlength="30" type="email" placeholder="Ej: ejemplo@correo.com" name="nombre" id="nombre" required>
										<button id="button" type="submit">Confirmar</button><br>
										<input type="hidden" name="ok" value="oka">
                                                                </form>
                                                        </div>
								<?php
									if(isset($_REQUEST['ok']) and ($_REQUEST['ok'])=='oka'){
										$email = $_REQUEST['nombre'];
        								$sql = "SELECT * FROM usuarios WHERE email='$email'";
        								$result = mysqli_query($link, $sql);
        								if(!mysqli_num_rows($result)==0){
        										$row = mysqli_fetch_array($result);
        										$pass = $row['clave'];
        										$email = $row['email'];
        										echo '<p> Ha sido correctamente enviado a '.$email.' la contraseña: '.$pass.'</p>';
        								}
        								else{
        									echo '<p>El mail no existe en nuestro sistema.</p>';
        								}
        							}
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
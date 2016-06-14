<html>
	<head>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="fonts/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
         <?php
         	include_once 'functions.php';
         	include_once 'scripts.js';
         	$link = connect();
          ?>                
        <title>CouchInn - Agregar Tipo de Hospedaje</title>
    </head>
    <body>
		<!-- HEADER -->
		<header>		
			<?php
				show('header');
			?>       
		</header>
		<div id="contenedor">
		<?php

			echo'<div id="backButton">
			<a class="backButton" href="listado.php">◄ Atrás</a></br>
			</div>
			<form class="backend_container" style="text-align:left;width: 50%" action="add_tipo.php" method="POST" name="hosp" onsubmit="confirmacionA();">
			<span>Nombre: </span>
			<input type="text" class="texto_biselado" maxlength="18" name="tipohospedaje" id="tipohospedaje" required>
			<input type="hidden" name="agregar" value="ok_hospedaje">
			<button class="button button_primary" style="margin:10px" type="submit" value="agregar">Agregar</button>
			</form>';

//Luego, si ya se mandó a agregar un hospedaje
		if(isset($_REQUEST['agregar'])and($_REQUEST['agregar'])=='ok_hospedaje'){
			$tipohospedaje=$_REQUEST['tipohospedaje'];
			$eliminado=0;
			$resultado=mysqli_query($link, "SELECT * FROM tipocouchs WHERE nombre='$tipohospedaje'");
			if(mysqli_num_rows($resultado) == 0){
				$sql="INSERT INTO tipocouchs(nombre, eliminado) VALUES('$tipohospedaje', '$eliminado')";
				if(mysqli_query($link,$sql))
					echo '<p> Exito en la carga! <img src="img/success.png" height="20px" weight="20px"> </p>';
				else
					echo '<p> La carga del nuevo Tipo de Hospedaje Falló <img src="img/error.png" width="15px" height="15px"></p>';
			}else{
				$row=mysqli_fetch_array($resultado);
				if ($row['eliminado'] == 1){
					$sql="UPDATE tipocouchs SET eliminado='$eliminado' WHERE nombre='$tipohospedaje'";
					if(mysqli_query($link,$sql))
						echo '<p> Exito en la carga! <img src="img/success.png" height="20px" weight="20px"> </p>';
					else
						echo '<p> La carga del nuevo Tipo de Hospedaje Falló <img src="img/error.png" width="15px" height="15px"></p>';
				}else
					echo '<p> Ya se dispone de un hospedaje de ese mismo tipo, verifique los datos y vuelva a intentarlo <img src="img/error.png" width="15px" height="15px"></p>';
			}		
		}		
		?>
	</div>
	<footer>
        <div id="footer">
            CouchInn © 2016
        </div>
    </footer>
    </body>
</html>
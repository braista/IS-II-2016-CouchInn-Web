<html>
	<head>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="fonts/style.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
         <?php
         	include_once 'functions.php';
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
		if (isset($_REQUEST['tipohospedajemod_id'])){
			$idtipohospedaje=$_REQUEST['tipohospedajemod_id'];
			$nombre=$_REQUEST['nombre'];
			$result=mysqli_query($link,"SELECT * FROM tipocouchs WHERE idtipocouch=$idtipohospedaje");
			echo '<div style="text-align:left; margin:30px">
			<div id="backButton">
					<a class="backButton" href="javascript:history.back()">◄ Atrás</a>
			</div>
			<h4>Modifique el tipo de hospedaje y haga clic en la tilde verde.</h4>		
			<form name="hosp" action="mod_tipo.php" method="GET" onsubmit="return validacion_hosp();">
				<p>Nombre del tipo de hospedaje :</p>
				<input name="nombre" id="nombre" maxlength="18" type="text" value="'.$nombre.'" required>
				<button type="submit" name="tipohospedaje_id" value="'.$idtipohospedaje.'">
					<img width="25px" height="25px" src="img/select.png"/>
				</button>
			</form>
			</div>
			<HR width=50% align="left">';
			unset($result);
		}
//SI YA SE MODIFICÓ EL TIPO DE HOSPEDAJE

		if(isset($_REQUEST['tipohospedaje_id'])){
			$id=$_REQUEST['tipohospedaje_id'];
			$nombre=$_REQUEST['nombre'];
			$sql="UPDATE tipocouchs SET nombre='$nombre' WHERE idtipocouch=$id";
			echo'<div id="backButton">
					<a class="backButton" href="listado.php">◄ Atrás</a></br>
				</div>';
			if(mysqli_query($link,$sql))
				echo '<h1>Se ha modificado el tipo de hospedaje con éxito <img src="img/success.png" height="40px" weight="40px"></h1>';
			else
				echo '<h1>La modificación del tipo de Hospedaje falló. <img src="img/error.png" width="30px" height="30px"></h1>';
		}
		?>
		<?php 
	//LUEGO VOY A VERIFICAR SI ME ENVIARON A ELIMINAR ALGÚN TIPO DE HOSPEDAJE.
		 if (isset($_REQUEST['tipohospedajerem_id'])){
		 	$idtipohospedaje=$_REQUEST['tipohospedajerem_id'];
		 	$consulta=mysqli_query($link, "SELECT * FROM couchs WHERE idtipocouch='$idtipohospedaje'");
		 	$eliminado=1;
		 	if (mysqli_num_rows($consulta) == 0){
		 		$sql="DELETE FROM tipocouchs WHERE idtipocouch='$idtipohospedaje'";
		 		echo'<div id="backButton">
					<a class="backButton" href="listado.php">◄ Atrás</a></br>
				</div>';
		 		if(mysqli_query($link,$sql))
					echo '<p>Se ha Eliminado el tipo de hospedaje con éxito <img src="img/success.png" height="40px" weight="40px"></p>';
				else
					echo '<p>La Eliminación del tipo de Hospedaje falló. <img src="img/error.png" width="30px" height="30px"></p>';
		 	}else{
		 		$sql="UPDATE tipocouchs SET eliminado='$eliminado' WHERE idtipocouch=$idtipohospedaje";
		 		echo'<div id="backButton">
					<a class="backButton" href="listado.php">◄ Atrás</a></br>
				</div>';
		 		if(mysqli_query($link,$sql))
					echo '<p>Se ha Eliminado el tipo de hospedaje con éxito <img src="img/success.png" height="40px" weight="40px"></p>';
				else
					echo '<p>La Eliminación del tipo de Hospedaje falló. <img src="img/error.png" width="30px" height="30px"></p>';
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
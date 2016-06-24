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
    	 <script language="javascript" type="text/javascript">
    	function confirmacion(){
    		return(confirm("Usted va a modificar de forma permanente los datos, proceder?"));
		}
		 </script>
		<!-- HEADER -->
		<header>		
			<?php
				show('header');
				checkBackendAuth(getUserID());
			?>       
		</header>

		<div id="contenedor">
		<?php
		//Si me enviaron a Modificar un tipo de hospedaje..
		if (isset($_REQUEST['tipohospedajemod_id'])){
			$idtipohospedaje=$_REQUEST['tipohospedajemod_id'];
			$nombre=$_REQUEST['nombre'];
			$result=mysqli_query($link,"SELECT * FROM tipocouchs WHERE idtipocouch=$idtipohospedaje");
			echo '<div style="text-align:left; margin:30px">
			<div id="backButton">
					<a class="fade" href="javascript:history.back()">◄ Atrás</a>
			</div>
			<h4>Modifique el tipo de hospedaje y haga clic en la tilde verde.</h4>		
			<form name="hosp" action="mod_tipo.php" method="GET" onsubmit="return confirmacion();">
				<input name="nombre" id="nombre" maxlength="18" type="text" value="'.$nombre.'" required>
				<button type="submit" name="tipohospedaje_id" value="'.$idtipohospedaje.'">
					<img width="20px" height="20px" src="img/select.png"/>
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
			$result=mysqli_query($link,"SELECT * FROM tipocouchs WHERE nombre='$nombre'");
			echo '<div id="backButton">
					<a class="fade" href="listado.php">◄ Atrás</a>
			</div>';
			if (mysqli_num_rows($result)!=0)
				echo '<p> Ya se dispone de un hospedaje de ese mismo tipo, verifique los datos y vuelva a intentarlo <img src="img/error.png" width="15px" height="15px"></p>';
			else{
				$sql="UPDATE tipocouchs SET nombre='$nombre' WHERE idtipocouch=$id";
				if(mysqli_query($link,$sql))
					echo '<p>Se ha modificado el tipo de hospedaje con éxito <img src="img/ok.png" height="30px" weight="30px"></p>';
				else
					echo '<p>La modificación del tipo de Hospedaje falló. <img src="img/notok.png" width="30px" height="30px"></p>';
			}
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
					<a class="fade" href="listado.php">◄ Atrás</a></br>
				</div>';
		 		if(mysqli_query($link,$sql))
					redirectWithAlert("listado.php","Se ha eliminado el tipo de hospedaje con exito.");
				else
					redirectWithAlert("listado.php","La eliminacion falló.");
		 	}else{
		 		$sql="UPDATE tipocouchs SET eliminado='$eliminado' WHERE idtipocouch=$idtipohospedaje";
		 		echo'<div id="backButton">
					<a class="fade" href="listado.php">◄ Atrás</a></br>
				</div>';
		 		if(mysqli_query($link,$sql))
					redirectWithAlert("listado.php","Se ha eliminado el tipo de hospedaje con exito.");
				else
					redirectWithAlert("listado.php","La eliminacion falló.");
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
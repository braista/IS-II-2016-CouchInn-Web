<html>
	<head>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="fonts/style.css">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script language="javascript" type="text/javascript">
			function confirmacionB(){
    			return(confirm("Está seguro que desea eliminar este tipo de hospedaje?"));
			}
		</script>
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
				checkBackendAuth(getUserID());
			?>       
		</header>
		<div id="contenedor">
			<?php
			echo'
			<div id="backButton">
					<a id="backButton" class="fade" href="javascript:history.back()">◄ Atrás</a>
			</div>';
			echo '<form name="add" method="POST" action="add_tipo.php">
			<button id="button" style="margin:10px" type="submit" value="agregar">Agregar Nuevo Tipo De Hospedaje</button>
			</form>';
			$result=mysqli_query($link,"SELECT * FROM tipocouchs");
			$num=0;
			if (mysqli_num_rows($result) == 0)
				echo 'No hay tipos de Hospedajes para visualizar.';
			else{
				echo '<h4>Se dispone de los siguientes tipos de Hospedaje:</h4>';
				while($row=mysqli_fetch_array($result)){
					if ($row['eliminado'] != 1){
						echo '<div style="text-align:left; margin:30px">
						<div width="40px">
						<form name="hospM" action="mod_tipo.php" method="GET" onsubmit="return confirmacionB();">
						<p>'.$row['nombre'].':</p>
						<input name="nombre" id="nombre" type="hidden" value="'.$row['nombre'].'">
						<button type="submit" name="tipohospedajerem_id" value="'.$row['idtipocouch'].'">
							<img height="25px" width="25px" src="img/del.gif"/>
						</button>
						</form>
						</div>

						<form name="hospB" action="mod_tipo.php" method="GET">
						<input name="nombre" id="nombre" type="hidden" value="'.$row['nombre'].'">
						<button type="submit" name="tipohospedajemod_id" value="'.$row['idtipocouch'].'">
							<img height="25px" width="25px" src="img/modi.png"/>
						</button>
						</form>
						</div>
				<HR width=50% align="left">';
					}
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
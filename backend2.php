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
                <title>CouchInn - Ajustes e Info</title>
        </head>
        <body>
		<!-- HEADER -->
		
		<header>
			<?php
				show('header');
                    //SE VERIFICA QUE EL USUARIO SE ENCUENTRA LOGUEADO Y QUE ES UN ADMINISTRADOR                                
                    checkAuth();
                    checkBackendAuth(getUserID());
			?>
		</header>
	
		<!-- CONTENEDOR-->
		<div id="contenedor">			
                        <div id="content">                
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
                        <p>Ajustes e info</p>
                    </div>
                    <div id="backmenu">
                        <div id="backmenuItem">
                            <a id="button" href="listado.php">Administrar Tipos de couchs</a>
                    </div>
                    <div id="backmenuItem">
                        <form action="backend.php" name="ver_ganancias" method="POST">
                            <button id="button" name="ver_ganancias">Ver Ganancias</button>
                        </form>
                    </div>     
            </div>
				</div>
                <?php 
                if(isset($_POST['ver_ganancias'])){ ?>
                        <div id="info">
                            <div id="title">
                                <p>Ganancias</p>
                            </div>
                            <div id="formSection">
                                <form action="backend.php" name="fecha" method="GET">
                                    <div id="formItem">
                                        <div class="formLabel">
                                            <label>Desde: </label>
                                        </div>
                                        <div class="formInput">
                                            <input type="date" max="<?php echo date("Y-m-d");?>" name="fechaI" id="fechaI" required>
                                        </div>
                                    </div>
                                    <div id="formItem">
                                        <div class="formLabel">
                                            <label>Hasta: </label>
                                        </div>
                                        <div class="formInput">
                                            <input type="date" max="<?php echo date("Y-m-d");?>" name="fechaF" id="fechaF">
                                        </div>
                                    </div>
                                    <div id="formItem">
                                        <div class="formInput">    
                                            <button id="button" name="ver" type="submit" value="ganancia_fecha">Ver</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <form action="backend.php" name="fecha" method="POST" style="float:left">
                            </form>
                        </div>
                    <?php 
                    }
                    if((isset($_GET['fechaI'])) and ($_GET['fechaI'])!=''){ ?>
                        <div id="info">
                            <div id="title">
                                <?php 
                                $fechaI=$_GET['fechaI'];
                                $fechaF=$_GET['fechaF'];
                                if ($fechaI!="" AND $fechaF==""){
                                    //Si seleccionaron fecha de inicio pero no fecha limite, tomo las reservas de los 2 años siguientes.
                                    $fechaF=date_create();
                                    $fechaF=serialize($fechaF);
                                    $fechaF=substr($fechaF, 35, 10);
                                }
                                if ($fechaI>$fechaF) {
                                    redirectWithAlert("backend.php","Las fechas introducidas son incorrectas.");
                                }
                                $SQL="SELECT * FROM pagos AS c LEFT JOIN usuarios AS tc ON c.idusuario=tc.idusuario WHERE fecha BETWEEN '$fechaI' AND '$fechaF'";
                                $consulta=mysqli_query($link,$SQL);
                                $cant=mysqli_num_rows($consulta);
                                if ($cant==0)
                                    echo '<h3>No hay pagos para visualizar entre el rango de fechas seleccionadas.</h3>';
                                else{
                                    if ($fechaI==$fechaF)
                                        echo'<h3>Ganancias del día: '.$fechaI.'</h3>';
                                    else
                                        echo'<h3>Ganancias entre: '.'  '.$fechaI.'  y  '.$fechaF.'</h3>';
                            ?>
                            </div><?php
                                    $SQL= "SELECT monto FROM pagos WHERE fecha BETWEEN '$fechaI' AND '$fechaF'";
                                    $consulta=mysqli_query($link,$SQL);
                                    $total=0;
                                    while($row=mysqli_fetch_array($consulta))
                                        $total=$total+$row['monto'];
                                    echo'<div id="subtitle">
                                    <p class="font">Total: $'.$total.'</p>
                                    </div>
                                    <table class="table">
                                        <tr>    
                                            <td>Usuario</td>
                                            <td>Tarjeta</td>
                                            <td>Fecha</td>
                                            <td>Monto</td>
                                        </tr>';
                                    $SQL="SELECT * FROM pagos AS c LEFT JOIN usuarios AS tc ON c.idusuario=tc.idusuario WHERE fecha BETWEEN '$fechaI' AND '$fechaF'";
                                    $consulta=mysqli_query($link,$SQL);
                                    $cant=mysqli_num_rows($consulta);
                                    while ($row=mysqli_fetch_array($consulta)){
                                        $nom=$row['nombre'];
                                        $ape=$row['apellido'];
                                        $nro=$row['nrotarjeta'];
                                        $fecha=$row['fecha'];
                                        $monto=$row['monto'];
                                        echo'<tr class="listItem">';
                                        echo '<td class="item">'.$nom.' '.$ape.'</td>';
                                        echo '<td class="item">'.$nro.'</td>';
                                        echo '<td class="item">'.$fecha.'</td>';
                                        echo '<td class="item">$'.$monto.'</td>';
                                        echo'</tr>';
                                    }
                                    echo'</table>
                                    <div>
                                        <h4>Cantidad de Usuarios Premium:'.' '.$cant.'</h4>
                                    </div>';
                                    $SQL= "SELECT monto FROM pagos";
                                    $consulta=mysqli_query($link,$SQL);
                                    $total=0;
                                    while($row=mysqli_fetch_array($consulta))
                                        $total=$total+$row['monto'];
                                    echo'<div id="subtitle">
                                    <p class="font">Total de ganancias hasta hoy: $'.$total.'</p>
                                    </div>';
                                }
                    }
                    ?>  
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
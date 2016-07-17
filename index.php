<html>
    <head>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="fonts/style.css">
        <script type="text/javascript" src="/functions.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <?php
		include_once 'functions.php';
		$link= connect();
        ?>
        <title>CouchInn - Inicio</title>
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
		  <div id="search_container">
                <span class="caja_search">
                <!--Filtro por nombre-->
                    <form class="search_form,form center" name="search" id="search" action="index.php" method="POST">
                         Nombre:
                        <input type="text" id="search" name="search" maxlength="15" placeholder="Nombre del couch que busca" required>
                        <button id="button" style="margin:10px" type="submit" value="Ir">Buscar</button>
                     </form>
                    <form class="search_form,form center" name="search" id="search" action="advanced_search.php" method="GET">
                        <button id="button" style="margin:10px" type="submit" value="advanced_search">Busqueda Avanzada</button>
                    </form>   
                </span>
            </div>

            <div id="content"> 							
				<?php 
                    if (isset($_REQUEST['name'])){
                        $row['name']=$_REQUEST['name'];
                        $name=$row['name'];
                        $row['place']=$_REQUEST['place'];
                        $place=$row['place'];
                        $row['capacity']=$_REQUEST['capacity'];
                        $capacity=$row['capacity'];
                        $row['description']=$_REQUEST['description'];
                        $description=$row['description'];
                        $row['tipoH']=$_REQUEST['hosp_id'];
                        $tipo=$row['tipoH'];
                        $row['fechaI']=$_REQUEST['fechaI'];
                        $fechaI=$row['fechaI'];
                        $row['fechaF']=$_REQUEST['fechaF'];
                        $fechaF=$row['fechaF'];
                        
                        echo'<a href="index.php" id="button">Volver</a>';
                        echo '<table>
                            <tr>';
                        $str="<td><h4>Filtrado por: </h4></td>";
                        echo $str;
                        if ($name!='0' and $name!='')
                            echo '</tr>/<tr><td>Nombre: '.$name.'</td>';
                        if ($place!='0' and $place!='')
                            echo '</tr>/<tr><td>Lugar: '.$place.'</td>';
                        if ($capacity!='0' and $capacity!='')
                            echo '</tr>/<tr><td>Capacidad: '.$capacity.'</td>';
                        if ($description!='0' and $description!='')
                            echo '</tr>/<tr><td>Descripción: '.$description.'</td>';
                        if ($tipo!='0' and $tipo!=''){
                            $result2= mysqli_query($link, "SELECT * FROM tipocouchs WHERE idtipocouch='$tipo'");
                            $row2=mysqli_fetch_array($result2);
                            echo '</tr>/<tr><td>Tipo De Hospedaje: '.$row2['nombre'].'</td>';
                        }
                        if ($fechaI!='' AND $fechaF!=''){
                            echo '</tr>/<tr><td>Desde: '.$fechaI.'</td>';
                            echo '<td>Hasta: '.$fechaF.' </td>';

                        }elseif ($fechaI=='' AND $fechaF!='') {
                            echo '</tr>/<tr><td>Desde: HOY</td>';
                            echo '<td>Hasta: '.$fechaF.'</td>';

                        }elseif ($fechaI!='' AND $fechaF=='') {
                            echo '</tr>/<tr><td>Desde: '.$fechaI.'</td>';
                            echo '<td>Hasta: ---- </td>';
                        }
                        echo '</tr>
                            </table>';
                       loadCouchs($row,$link);
                    }
                    elseif(isset($_REQUEST["search"])){
                        $palabra=$_REQUEST["search"];
                        echo'<a href="index.php" id="button">Volver</a>';
                        loadCouchs($palabra, $link);
                    }
                    else
                        loadCouchs('null', $link);
				?>
            </div>
        </div>
        <footer>
            <?php    
                show('footer');
            ?>
        </footer>
    </body>
</html>
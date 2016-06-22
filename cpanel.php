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
        <title>CouchInn - Panel</title>
    </head>
    <body>
		<!-- HEADER -->
		
		<header>
			<?php
				show('header');
                //SE VERIFICA QUE EL USUARIO SE ENCUENTRA LOGUEADO Y QUE ES UN ADMINISTRADOR                                
                checkAuth();
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
                        <p>Panel de control</p>
                    </div>
                    <div id="backmenu">
                        <div id="backmenuItem">
                            <a href="newCouch.php" id="button">Agregar couch</a>
                        </div>        
                    </div>
                    <?php
                        $userid= getUserID();
                        $SQL= "SELECT * FROM couchs WHERE idusuario=$userid";
                        $result= mysqli_query($link, $SQL);
                        $ok = (mysqli_num_rows($result)>0);
                    ?>
                    <div id="subtitle">
                        <p class="subtitle">Mis couchs</p>
                    </div>
                    <?php 
                    if(!($ok)){ ?>
                        <div id="alertUpdate" class="alert">
                            <img src="img/alert.png" class="okImg">
                            <p class="noMargin">No tienes publicaciones de couchs aún.</p>
                        </div>
                    <?php
                    }else{
                        ?>
                    <table class="table">
                        <tr>	
                            <td>Imagen</td>
                            <td>Titulo</td>
                            <td>Tipo</td>
                            <td>Modificar</td>
                            <td>Eliminar</td>
                            <td>Habilitar/Deshabilitar</td>
                        </tr>
                        <?php
                            while($row = mysqli_fetch_array($result)){
                                $couchid= $row['idcouch'];
                                $couchType= getCouchType($row['idtipocouch']);
                                $query= "SELECT * FROM imagenes WHERE idcouch=$couchid";
                                $result2= mysqli_query($link, $query);
                                if (mysqli_num_rows($result2) != 0){
                                    $imgRow= mysqli_fetch_array($result2);
                                    $img= $imgRow['imagen'];                                    
                                }
                                echo '<tr>';
                                echo'<td class="item"><a href="show.php?id='.$row["idcouch"].'"><img src="img/'.$img.'" width=50px height=50px ></a></td>';
                                echo'<td class="item"><a href="show.php?id='.$row["idcouch"].'">'.$row["titulo"].'</a></td>';
                                echo'<td class="item">'.$couchType.'</td>';
                                echo'<td class="item"><a href="editCouch.php?id='.$couchid.'"><img src="img/modi.png" width=25px height=25px ></a></td>';
                                echo'<td class="item"><a href="deleteCouch.php"><img src="img/del.gif" width=20px height=20px ></a></td>';
                                if($row['habilitado'] == 1){ ?>                                
                                    <td class="item"><a href="disableCouch.php?id=<?php echo $couchid; ?>">Deshabilitar</a></td>
                                <?php
                                }else { ?>
                                    <td class="item"><a href="enableCouch.php?id=<?php echo $couchid; ?>">Habilitar</a></td>
                                <?php
                                }
                                echo '</tr>';
                            }
                        ?>
                    </table>
                    <?php
                        }
                    ?>
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
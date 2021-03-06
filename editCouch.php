<html>
    <head> 
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="fonts/style.css">
        <script type="text/javascript" src="/functions.js"></script>
        <script src="jquery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/slimbox2.js"></script>
        <script type="text/javascript" src="js/jquery_min.js"></script>
        <link rel="stylesheet" href="css/slimbox2.css" type="text/css" media="screen" />
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <?php 
            include_once 'functions.php';
            $link=  connect();
        ?>  
        <title>CouchInn - Modificar couch</title>
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
                <div id="content">
                    <div id="back">
                        <a id="backButton" class="fade" href="cpanel.php">◄ Atrás</a>
                    </div>
                    <div id="info">
                        <div id="title">
                            <p>Modificar publicación</p>
                        </div>
                        <p style="clear: both; text-indent: 1%;">Modifica la publicación de tu couch en el siguiente formulario. No es necesario aplicar los cambios para modificar las imágenes.</p>
                        <?php
                            if(isset($_GET['id']) && $_GET['id'] != ""){
                                $couchid= $_GET['id'];
                                //CONSULTA COUCH
                                $query= "SELECT * FROM couchs WHERE idcouch='$couchid'";
                                $result= mysqli_query($link, $query);
                                if(mysqli_num_rows($result) == 0){ ?>
                                    <script>showError('couchError');</script>
                                <?php
                                }else{
                                    $couchRow= mysqli_fetch_array ($result);
                                    //CONSULTA TIPO DE COUCHS DISPONIBLES PARA ELEGIR
                                    $query= "SELECT * FROM tipocouchs ORDER BY nombre";
                                    $result= mysqli_query($link, $query);
                                    //CONSULTA IMAGENES DE LA PUBLICAZAO
                                    $query= "SELECT * FROM imagenes WHERE idcouch='$couchid' ORDER BY imagen ASC";                                    
                                    $imgResult= mysqli_query($link, $query);
                                    $imgamount= mysqli_num_rows($imgResult);
                                }
                            }
                            
                        ?>
                        <div id="registerSection">
                            <div id="sub">
                                <p id="subtitle">Información del Couch:</p>
                            </div>
                            <form name="couch" action="editCouchInfo.php" method="GET">
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Titulo:</label>
                                    </div>
                                    <div class="formInput">
                                        <?php echo $couchRow['titulo'];?>
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Capacidad:</label>
                                    </div>
                                    <div class="formInput">
                                        <?php echo $couchRow['capacidad'];?>
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Lugar:</label>
                                    </div>
                                    <div class="formInput">
                                        <?php echo $couchRow['lugar'];?>
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Tipo:</label>
                                    </div>
                                    <div class="formInput">
                                        <?php echo $couchRow['idtipocouch'];?>
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Habilitado:</label>
                                    </div>
                                    <div class="formInput">
                                        <?php
                                        if($couchRow['habilitado'] == 1)
                                            echo 'Habilitado';
                                        else
                                            echo 'Deshabilitado';
                                        ?>
                                    </div>
                                </div>
                                <div id="formTextarea">
                                    <div class="formLabel">
                                        <label>Descripción:</label>
                                    </div>
                                    <div class="formInput">
                                        <?php echo $couchRow['descripcion'];?>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $couchRow['idcouch'];?>">
                                <div id="infoSubmit">
                                    <input type="submit" id="button" value="Modificar informacion">
                                </div>
                            </form>
                            <form name="couch" action="editCouchIMG.php" method="GET">
                                <div id="formFiles">
                                    <div class="imgLabel">
                                        <label>Imágenes:</label>
                                    </div>
                                    <div id="gallery">
                                        <?php
                                        if($imgamount == 1){
                                            $imgRow = mysqli_fetch_array($imgResult);
                                            echo'<div id="galleryIMG">';
                                            echo'<td class="item"><a href="img/'.$imgRow["imagen"].'" rel="lightbox"><img src="img/'.$imgRow["imagen"].'" width=70px height=70px ></a></td>';
                                            echo'</div>';
                                        }else {
                                            //SE MUESTRA IMG PRIMARIA
                                            $imgRow = mysqli_fetch_array($imgResult);
                                            $primaryIMG= $imgRow["idimagen"];
                                            echo'<div id="galleryIMG">';
                                            echo'<td class="item"><a href="img/'.$imgRow["imagen"].'" rel="lightbox"><img src="img/'.$imgRow["imagen"].'" width=70px height=70px ></a></td>';
                                            echo'</div>';
                                            while ($imgRow = mysqli_fetch_array($imgResult)) {
                                                echo'<div id="galleryIMG">';
                                                echo'<td class="item"><a href="img/'.$imgRow["imagen"].'" rel="lightbox"><img src="img/'.$imgRow["imagen"].'" width=70px height=70px ></a></td>';
                                                echo'</div>';
                                            }
                                        }
                                        ?>
                                    </div>                                        
                                </div>
                                <input type="hidden" name="id" value="<?php echo $couchid; ?>">
                                <div id="imgSubmit">
                                    <input type="submit" id="button" value="Modificar imagenes">
                                </div>
                            </form>
                            <script>
                                validateInputFile();
                            </script>
                        </div>
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
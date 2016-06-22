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
                    <div id="info">
                        <div id="title">
                            <p>Modificar publicación</p>
                        </div>
                        <p style="clear: both; text-indent: 1%;">Modifica la publicación de tu couch en el siguiente formulario.</p>
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
                            <form name="couch" action="updateCouch.php" method="POST" onsubmit="return couchFormValidation();" >
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Titulo:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="title1" id="title1" maxlength="25" minlength="4" placeholder="Título de la publicación" value="<?php echo $couchRow['titulo'];?>">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Capacidad:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="capacity" id="capacity" maxlength="2" placeholder="Capacidad máxima de huéspedes" value="<?php echo $couchRow['capacidad'];?>">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Lugar:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="place" id="place" placeholder="Lugar donde se encuentra" value="<?php echo $couchRow['lugar'];?>">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Tipo:</label>
                                    </div>
                                    <div class="formInput">
                                        <select name="type" id="type">
                                            <?php
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $value= $row['idtipocouch'];
                                                    $name= $row['nombre'];
                                                    if($value == $couchRow['idtipocouch'])
                                                        echo '<option value="'.$value.'" selected>'.$name.'</option>';
                                                    else
                                                        echo '<option value="'.$value.'">'.$name.'</option>';
                                                }
                                            ?>
                                        </select>                                        
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Habilitado:</label>
                                    </div>
                                    <div class="formInput">
                                        <?php
                                        if($couchRow['habilitado'] == 1)
                                            echo '<input type="checkbox" name="enable" id="enable" checked>';
                                        else
                                            echo '<input type="checkbox" name="enable" id="enable">';
                                        ?>
                                    </div>
                                </div>
                                <div id="formTextarea">
                                    <div class="formLabel">
                                        <label>Descripción:</label>
                                    </div>
                                    <div class="formInput">
                                        <textarea name="description" id="description" placeholder="Descripción de la publicación"><?php echo $couchRow['descripcion'];?></textarea>
                                    </div>
                                </div>
                                <div id="formFiles">
                                    <div class="imgLabel">
                                        <label>Imágenes:</label>
                                    </div>
                                    <?php
                                        if($imgamount == 1){
                                            $imgRow = mysqli_fetch_array($imgResult);
                                            echo'<div id="imgEdit">';
                                            echo'<td class="item"><a href="img/'.$imgRow["imagen"].'" rel="lightbox"><img src="img/'.$imgRow["imagen"].'" width=50px height=50px ></a></td>';
                                            echo'<div id="editButton">';
                                            echo'<a href="editIMG.php?img='.$imgRow["idimagen"].'">Cambiar</a><br>';
                                            echo'</div>';
                                            echo'</div>';
                                            echo'<div id="imgEdit">';
                                            echo'<div id="addIMGButton">';
                                            echo'<a href="newIMG.php?id='.$couchid.'">Agregar imagen</a><br>';
                                            echo'</div>';
                                            echo'</div>';
                                        }else {
                                            //SE MUESTRA IMG PRIMARIA
                                            $imgRow = mysqli_fetch_array($imgResult);
                                            $primaryIMG= $imgRow["idimagen"];
                                            echo'<div id="imgEdit">';
                                            echo'<td class="item"><a href="img/'.$imgRow["imagen"].'" rel="lightbox"><img src="img/'.$imgRow["imagen"].'" width=50px height=50px ></a></td>';
                                            echo'<div id="editButton">';
                                            echo'<a id="button" href="editIMG.php?img='.$imgRow["idimagen"].'">Cambiar</a><br>';
                                            echo'</div>';
                                            echo'<div id="editButton">';
                                            echo'<a id="button" href="deleteIMG.php?id='.$couchid.'&img='.$imgRow["idimagen"].'">Eliminar</a><br>';
                                            echo'</div>';
                                            echo'</div>';
                                            while ($imgRow = mysqli_fetch_array($imgResult)) {
                                                echo'<div id="imgEdit">';
                                                echo'<td class="item"><a href="img/'.$imgRow["imagen"].'" rel="lightbox"><img src="img/'.$imgRow["imagen"].'" width=50px height=50px ></a></td>';
                                                echo'<div id="editButton">';
                                                echo'<a id="button" href="editIMG.php?img='.$imgRow["idimagen"].'">Cambiar</a><br>';
                                                echo'</div>';
                                                echo'<div id="editButton">';
                                                echo'<a id="button" href="deleteIMG.php?id='.$couchid.'&img='.$imgRow["idimagen"].'">Eliminar</a><br>';
                                                echo'</div>';
                                                echo'<div id="editButton">';
                                                echo'<a id="button" href="setPrimaryIMG.php?primary='.$primaryIMG.'&new='.$imgRow["idimagen"].'">Elegir portada</a><br>';
                                                echo'</div>';
                                                echo'</div>';
                                            }
                                            if($imgamount != 5){
                                                echo'<div id="imgEdit">';
                                                echo'<div id="addIMGButton">';
                                                echo'<a id="button" href="newIMG.php?id='.$couchid.'">Agregar imagen</a><br>';
                                                echo'</div>';
                                                echo'</div>';
                                            }
                                        }
                                    ?>
                                </div>
                                <input type="hidden" name="couchid" value="<?php echo $couchid; ?>">
                                <div id="couchSubmit">
                                    <input type="submit" id="button" value="Modificar">
                                    <input type="button" id="button" value="Cancelar" onclick="confirmCancelEditCouch()">
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
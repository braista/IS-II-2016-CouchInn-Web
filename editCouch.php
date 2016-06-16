<html>
    <head> 
        <script type="text/javascript" src="/functions.js"></script>                       
       	<link rel="stylesheet" href="CSS/main.css">               
        <script src="jquery/jquery-1.12.4.min.js" type="text/javascript"></script>
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
                                    $query= "SELECT * FROM tipocouchs ORDER BY nombre";
                                    $result= mysqli_query($link, $query);
                                }
                            }
                            
                        ?>
                        <div id="registerSection">
                            <form name="couch" action="updateCouch.php" method="POST" onsubmit="return (formValidation('couch'));">
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
                                        <input type="text" name="location" id="location" placeholder="Lugar donde se encuentra" value="<?php echo $couchRow['lugar'];?>">
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
                                        if($row['habilitado'] == 1)
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
                                    <div class="formLabel">
                                        <label>Imágenes:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="file" name="img1" id="img1">
                                    </div>
                                    <div class="formInput">
                                        <input type="file" name="img2" id="img2" style="display: none">
                                    </div>
                                    <div class="formInput">
                                        <input type="file" name="img3" id="img3" style="display: none">
                                    </div>
                                    <div class="formInput">
                                        <input type="file" name="img4" id="img4" style="display: none">
                                    </div>
                                    <div class="formInput">
                                        <input type="file" name="img5" id="img5" style="display: none">
                                    </div>
                                </div>
                                <input type="hidden" name="userid" value="<?php getUserID() ?>">
                                <div id="couchSubmit">
                                    <input type="submit" id="button" value="Publicar">
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
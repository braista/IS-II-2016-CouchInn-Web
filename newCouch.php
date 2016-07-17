<html>
    <head>
        <script type="text/javascript" src="/js/validations.js"></script>
        <script type="text/javascript" src="/functions.js"></script>
       	<link rel="stylesheet" href="CSS/main.css">
        <script src="jquery/jquery-1.12.4.min.js" type="text/javascript"></script>
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <?php
            include_once 'functions.php';
            $link=  connect();
        ?>
        <title>CouchInn - Nuevo couch</title>
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
                            <p>Agregar nueva publicación</p>
                        </div>
                        <p style="clear: both; text-indent: 1%;">Completa los campos para agregar la nueva publicación.</p>
                        <?php
                            //CONSULTA TIPO DE COUCHS
                            $query= "SELECT * FROM tipocouchs ORDER BY nombre";
                            $result= mysqli_query($link, $query);
                            $userid= getUserID();
                        ?>
                        <div id="registerSection">
                            <form name="couch" action="addCouch.php" method="POST" onsubmit="return formValidation('couch');" enctype="multipart/form-data">
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Título:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="title1" id="title1" maxlength="25" minlength="4" placeholder="Título de la publicación">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Capacidad:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="capacity" id="capacity" maxlength="2" placeholder="Capacidad máxima de huéspedes">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Lugar:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="place" id="place" placeholder="Lugar donde se encuentra">
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
                                                    if($row['eliminado'] != 1){
                                                        $value= $row['idtipocouch'];
                                                        $name= $row['nombre'];                                                    
                                                        echo '<option value="'.$value.'">'.$name.'</option>';
                                                    }
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
                                        <input type="checkbox" name="enable" id="enable" checked>
                                    </div>
                                </div>
                                <div id="formTextarea">
                                    <div class="formLabel">
                                        <label>Descripción:</label>
                                    </div>
                                    <div class="formInput">
                                        <textarea name="description" id="description" placeholder="Descripción de la publicación"></textarea>
                                    </div>
                                </div>
                                <div id="formFiles">
                                    <div class="formLabel">
                                        <label>Imágenes:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="file" name="img1" id="img1" required onchange="validateInputFile();">
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
                                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                <div id="couchSubmit">
                                    <input type="submit" id="button" value="Publicar">
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
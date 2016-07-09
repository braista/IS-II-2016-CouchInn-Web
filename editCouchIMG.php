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
        <title>CouchInn - Modificar imagenes de couch</title>
	</head>
		<body>
			<!-- HEADER -->
			<header>		
                <?php
                show('header');
                checkAuth();
                if(isset($_GET['id']) && $_GET['id'] != "")
                    $couchid= $_GET['id'];
                ?>
			</header>
	
            <!-- CONTENEDOR-->
			<div id="contenedor">                
                <div id="content">
                    <div id="back">
                        <a id="backButton" class="fade" href="editCouch.php?id=<?php echo $couchid;?>">◄ Atrás</a>
                    </div>
                    <div id="info">
                        <div id="title">
                            <p>Modificar imagenes de publicación</p>
                        </div>
                        <p style="clear: both; text-indent: 1%;">Modifica las imagenes de la publicacion o cambia la imagen principal por otra.</p>
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
                                    //CONSULTA IMAGENES DE LA PUBLICAZAO
                                    $query= "SELECT * FROM imagenes WHERE idcouch='$couchid' ORDER BY imagen ASC";                                    
                                    $imgResult= mysqli_query($link, $query);
                                    $imgamount= mysqli_num_rows($imgResult);
                                }
                            }
                            
                        ?>
                        <div id="registerSection">
                            <div id="editIMG">                                
                                <div id="formFiles">
                                    <?php
                                        if($imgamount == 1){
                                            $imgRow = mysqli_fetch_array($imgResult);
                                            echo'<div id="imgEdit">';
                                            echo'<td class="item"><a href="img/'.$imgRow["imagen"].'" rel="lightbox"><img src="img/'.$imgRow["imagen"].'" width=75px height=75px ></a></td>';
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
                                            echo'<td class="item"><a href="img/'.$imgRow["imagen"].'" rel="lightbox"><img src="img/'.$imgRow["imagen"].'" width=75px height=75px ></a></td>';
                                            echo'<div id="editButton">';
                                            echo'<a id="button" href="editIMG.php?img='.$imgRow["idimagen"].'">Cambiar</a><br>';
                                            echo'</div>';
                                            echo'<div id="editButton">';
                                            echo'<a id="button" href="deleteIMG.php?id='.$couchid.'&img='.$imgRow["idimagen"].'">Eliminar</a><br>';
                                            echo'</div>';
                                            echo'</div>';
                                            while ($imgRow = mysqli_fetch_array($imgResult)) {
                                                echo'<div id="imgEdit">';
                                                echo'<td class="item"><a href="img/'.$imgRow["imagen"].'" rel="lightbox"><img src="img/'.$imgRow["imagen"].'" width=75px height=75px ></a></td>';
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
                            </div>
                        </div>
                            <script>
                                validateInputFile();
                            </script>
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
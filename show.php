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
        <title>CouchInn - Detalles</title>
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
            <?php
                include 'couchQuery.php';                
            ?>
            <div id="content">
                <div id="back">
                    <a id="backButton" class="fade" href="index.php">◄ Atrás</a>
				</div>
				<div id="info">
					
                    <?php
                        if(($userid != 0 && $userid != $ownerid) && ($usertypeid != 3)){
                    ?>
                            <div id="requestForm">
                                <form action="request.php" method="POST">
                                    <input type="hidden" name="couch" value="<?php echo $couchid; ?>">
                                    <input type="hidden" name="user" value="<?php echo $userid; ?>">
                                    <input type="submit" id="button" value="Solicitar">
                                </form>
                            </div>
                    <?php
                        }
                        if($userid == $ownerid){ ?>
                            <div id="couchButton">
                                <a href="editCouch.php?id=<?php echo $couchid; ?>"><img src="img/modi.png" width=25px height=25px title="Modificar publicación"></a>                                
                            </div>                    
                    <?php    
                        }
                        if($userid == $ownerid || $usertypeid == 3){ ?>
                            <div id="couchButton">
                                <form action="delete.php" method="POST" onsubmit="return (confirm('¿Desea borrar la publicación?'));">
                                    <input type="hidden" name="couch" value="<?php echo $couchid; ?>">
                                    <input type="image" value="Borrar" src="img/del.gif" width=22px height=22px title="Eliminar publicación">
                                </form>
                            </div>
                    <?php    
                        }
                    ?>
                    <div id="title">
						<p><?php echo $couchRow['titulo']; ?></p>
					</div>
                    <div id="couchDetails">
                        <div id="img">
                            <a href="img/<?php echo $img; ?>" rel="lightbox" id="imglink"><img id="imgdefault" src="img/<?php echo $img; ?>"></a> 
                        </div>                    
                        <div id="details1">
                            <p>Dueño:</p>
                            <p>Lugar:</p>
                            <p>Tipo:</p>
                            <p>Capacidad:</p>
                            <p>Puntaje:</p>
                            <p>Descripcion:</p>
                        </div>
                        <div id="details2">
                            <p><?php echo $lname; ?> <?php echo $fname; ?></p>
                            <p><?php echo $couchRow['lugar']; ?></p>
                            <p><?php echo $couchRow['nombre']; ?></p>
                            <p><?php echo $couchRow['capacidad']; ?></p>
                            <p><?php echo $couchRow['puntaje']; ?></p>
                            <p><?php echo $couchRow['descripcion']; ?></p>
                        </div><br>
                    </div>
                    <?php
                        if($okimg){
                    ?>
                        <div id="galery">
                            <?php
                                //CONSULTA IMG					
                                $SQL= "SELECT * FROM imagenes WHERE idcouch=$couchid ORDER BY imagen ASC";
                                $imgResult = mysqli_query($link, $SQL);
                                for ($i = 1; $i < $imgamount+1; $i++) {
                                    $imgRow = mysqli_fetch_array($imgResult); ?>
                                    <div id="galeryIMG">
                                        <a href="#"><img id="img<?php echo $i; ?>" class="thumbnail" src="img/<?php echo $imgRow['imagen']; ?>"></a>
                                    </div>                             
                            <?php
                                }                                                    
                            ?>
                            <script>
                                setDefaultIMG();
                            </script>
                        </div>
                    <?php
                        }
                    ?>
                        <!-- SECCIÓN PREGUNTAS --!>
                        
<!--                    <div id="questions">
                        <div id="subtitle">
                            <p class="subtitle">• Preguntas</p>
                        </div>
                        <?php
                            // CARTEL DE MODIFICACION CORRECTA Y CODIGO JQUERY PARA OCULTAR EN CASO DE CLICK
//                            if(isset($_GET['ok']) && $_GET['ok']== 'true'){ ?>
                                <div id="okQuestion" class="ok">
                                    <img src="img/ok.png" class="okImg">
                                    <p class="noMargin">La pregunta se publicó correctamente.</p>
                                </div>
                                <script>
                                    hideDivBlur('#okQuestion');
                                </script>
                            //<?php
//                                }
//                            ?>
                        //<?php
//                            if($userid != 0){
//                        ?>        
                                <div id="questionForm">
                                    <form name="question" method="POST" action="question.php" onsubmit="return sendQuestion()">                                        
                                        <input type="hidden" name="questionerid" value="//<?php //echo $userid; ?>">
                                        <input type="hidden" name="couchid" value="//<?php //echo $couchid; ?>">
                                        <textarea name="questionBox" class="questionBox" onfocus="openQuestionBox()" onblur="closeQuestionBox()" 
                                            placeholder="Ingrese una pregunta para el dueño de la publicacion..." maxlength="150"></textarea><br>
                                        <input type="submit" id="button" name="questionButton" value="Preguntar" style="display: none">                                                                        
                                    </form>                            
                                </div>
                        //<?php                        
//                            } 
//                        ?>
                        <div id="questionsList">
                            //<?php                        
//                                $SQL= "SELECT * FROM preguntas p LEFT JOIN usuarios u ON p.idusuario=u.idusuario WHERE idcouch=$couchid";
//                                $result= mysqli_query($link, $SQL);
//                                if(mysqli_num_rows($result)==0){ ?>
                                    <div id="noQuestions">
                                        <p>No realizaron preguntas todavía. Realizá una!</p>
                                    </div>
                            //<?php
//                                }else{
//                                    while($qrow = mysqli_fetch_array($result)) {
//                                        echo '<div id="questionItem">';
//                                        echo'<p class="noMargin">'.$qrow["apellido"].' '.$qrow["nombre"].'</p>';
//                                        echo '<p class="noMargin">('.$qrow["fecha"].')</p><br>';
//                                        echo'<p class="noMargin">'.$qrow["texto"].'</p>';
//                                        echo '</div>';
//                                    }                                        
//                                }                                                                        
//                            ?>
                        </div>
                        
                    </div>-->
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
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
        <title>CouchInn - Calificar couch</title>
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
                <div id="back">
                    <a id="backButton" class="fade" href="lastCouchs.php">◄ Atrás</a>
				</div>
				<div id="info">
                    <div id="title">
                        <p>Calificar couch</p>
                    </div>    
                    <p style="width: 100%; text-indent: 1%;overflow: hidden;">Califica el hospedaje con un numero entre 1 y 5, incluyendo un comentario obligatorio.</p>
                    <?php
                        if(count($_POST)!=0){
                            $couchID= $_POST['couchID'];
                            $userID= getUserID();
                        }else{
                            alert("Hubo un problema en el envio de datos");
                            back();
                        }
                    ?>
                    <div id="registerSection">
                        <form name="rateCouch" method="POST" action="addCouchRate.php" onsubmit="return formValidation('rate')">
                            <div id="formItem">
                                <div class="formLabel">
                                    <label>Puntuación:</label>
                                </div>
                                <div class="formInput">
                                    <input type="number" min="1" max="5" name="rating">
                                </div>
                            </div>
                            <div id="formTextarea">
                                <div class="formLabel">
                                    <label>Comentario:</label>
                                </div>
                                <div class="formInput">
                                    <textarea placeholder="Ingresar un comentario" name="comment" id="comment"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="couchID" value="<?php echo $couchID;?>">
                            <input type="hidden" name="userID" value="<?php echo $userID;?>">
                            <center>
                                <input type="submit" class="button" value="Calificar">
                            </center>
                            
                        </form>
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
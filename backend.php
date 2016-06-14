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
                <title>CouchInn - Backend</title>
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
                <?php

                ?>
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
                                            <p>Backend</p>
                                        </div>
                                        <div id="backmenu">
                                                <div id="backmenuItem">
                                                        <a href="listado.php" id="button">ABM Tipos de couchs</a>
                                                </div>        
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
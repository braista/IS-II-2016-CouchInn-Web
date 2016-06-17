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
        <title>CouchInn - Agregar imagen</title>
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
                            <p>Agregar imagen</p>
                        </div>
                        <p style="clear: both; text-indent: 1%;">Agregar una nueva imagen a la publicación.</p>
                        <?php
                            if(isset($_GET['id']) && $_GET['id'] != ""){
                                $couchID= $_GET['id'];
                                
                                //CONSULTA CANTIDAD DE IMG MAXIMO. EN CASO DE 5 SE VUELVE.
                                $query="SELECT * FROM imagenes WHERE idcouch='$couchID'";
                                $result= mysqli_query($link, $query);
                                if(mysqli_num_rows($result) == 5)
                                    redirectWithAlert("newIMG.php?id=$couchID", "El couch ya contiene el máximo de imágenes posibles (5)");                                
                            } else{
                                alert("No se especificó un couch para agregar la imagen. Aceptar para volver.");
                                back();
                            }
                        ?>
                        <div id="registerSection">                            
                            <form name="imgForm" action="addIMG.php" method="POST" enctype="multipart/form-data">
                                <input type="file" name="image" required>
                                <input type="hidden" name="couchid" value="<?php echo $couchID;?>">
                                <input type="submit" id="button" value="Agregar">
                                <input type="button" id="button" value="Cancelar" onclick="confirmCancel()">
                            </form>
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
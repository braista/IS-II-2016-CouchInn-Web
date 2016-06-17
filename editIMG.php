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
        <title>CouchInn - Modificar imagen</title>
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
                            <p>Modificar imagen</p>
                        </div>
                        <p style="clear: both; text-indent: 1%;">Cambiar la imagen por otra que elijas.</p>
                        <?php
                            if(isset($_GET['img']) && $_GET['img'] != ""){
                                $imgID= $_GET['img'];
                                //CONSULTA IMAGEN A MODIFICAR
                                $query= "SELECT * FROM imagenes WHERE idimagen='$imgID'";
                                $result= mysqli_query($link, $query);
                                $imgRow= mysqli_fetch_array ($result);                                
                            }                                                        
                        ?>
                        <div id="registerSection">
                            <img src="img/<?php echo $imgRow['imagen'];?>" height="250px" style="margin-bottom: 2%;">
                            <form name="imgForm" action="updateIMG.php" method="POST" enctype="multipart/form-data">
                                <input type="file" name="image" required>
                                <input type="hidden" name="imgname" value="<?php echo $imgRow['imagen'];?>">
                                <input type="hidden" name="imgid" value="<?php echo $imgRow['idimagen'];?>">
                                <input type="hidden" name="couchid" value="<?php echo $imgRow['idcouch'];?>">
                                <input type="submit" id="button" value="Modificar">
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
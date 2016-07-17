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
        <title>CouchInn - Puntuación del usuario</title>
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
                    <div id="backButton">
                        <a id="backButton" class="fade" href="javascript:history.back()">◄ Atrás</a>
                    </div>
                    <div id="info">
                        <div id="title">
                            <p class="noMargin">Puntuación del usuario</p>
                        </div>
                        <p style="width: 100%; overflow: hidden;">Todas las puntuaciones del usuario con sus respectivos comentarios.</p>
                        <?php
                        if(count($_GET)!=0){
                            $userID= $_GET['id'];
                            $query= "SELECT * FROM `puntajes-usuarios` WHERE idusuario_puntuado=$userID";
                            $result= mysqli_query($link, $query);
                            if(mysqli_num_rows($result) != 0){
                                while ($row = mysqli_fetch_array($result)) {
                                    $userID= $row['idusuario_puntuador'];
                                    ?>
                            <div id="rating">
                                <hr>
                                <div id="name" style="width: 100%; text-decoration: underline;">
                                    <?php echo getUserName($userID);
                                        echo ' <b>('.$row["puntaje"].')</b>';
                                    ?>
                                </div><br>
                                <div id="comment" style="font-size: 14px; text-indent: 1%;">
                                    <?php echo $row["comentario"];?>
                                </div>
                            </div>
                            <?php                             
                                }
                            }else{
                                
                            }
                        }
                        ?>
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
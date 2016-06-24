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
        <title>CouchInn - Reserva</title>
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
            <?php
            if(count($_POST) != 0){
                $couchID= $_POST["couchID"];
                $userID= $_POST["userID"];
                $query= "SELECT * FROM couchs WHERE idcouch='$couchID'";
                $row= mysqli_fetch_array(mysqli_query($link, $query));
                $maxAmount= $row["capacidad"];
            } else{
                alert("Hubo un problema con el envio de datos.");
                back();
            }
            ?>
                <div id="content">
                    <div id="info">
                        <div id="title">
                            <p>Reservar</p>
                        </div>
                        <p style="clear: both; text-indent: 1%;">Elija entre dos fechas el tiempo que desea realizar su experiencia, y una cantidad de personas.</p>
                        <p style="clear: both; text-indent: 1%; font-weight: bold;">Capacidad máxima de huespedes : <?php echo $maxAmount; ?></p>       
                        <div id="registerSection">
                            <form name="request"  action="addRequest.php" method="POST" onsubmit="return (formValidation('request'));">
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Desde:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="date" name="fdate" id="fdate" required>
                                    </div>
                                 </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Hasta:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="date" name="tdate" id="tdate" required>
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Cantidad de personas:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="number" name="amount" id="amount" required>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="couchID" value="<?php echo $couchID; ?>">
                                <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                                <input type="hidden" name="maxAmount" id="maxAmount" value="<?php echo $maxAmount; ?>">
                                                                                                                                                   
                                <div id="loginSubmit">
                                    <input type="submit" id="button" value="Confirmar">
                                </div>
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
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
        	<title>CouchInn - Registrarse</title>
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
                                <div id="content">
                                        <div id="info">
                                                <div id="title">
                                                        <p>Registrarse</p>
                                                </div>
                                                <p style="clear: both; text-indent: 1%;">Registrate en el sitio para poder publicar o buscar couchs para hospedarte.</p>
                                                <?php 
                                                if(isset($_GET['error'])){ ?>
                                                <div id="regError" class="error">
                                                        <img src="img/notok.png" class="okImg">
                                                        <p class="noMargin">Ese correo electronico ya existe. Elige otro.</p>
                                                </div>
                                                <script>
                                                        hideDivBlur('#regError');
                                                </script>
                                                <?php 
                                                }?>
                                                <div id="registerSection">
                                                        <form name="register"  action="new_User.php" method="POST" onsubmit="return formValidation('register')">
                                                                <div id="formItem">
                                                                        <div class="formLabel">
                                                                            <label>Apellido:</label>
                                                                        </div>
                                                                        <div class="formInput">
                                                                                <input type="text" name="lname" maxlength="16" minlength="3" placeholder="Ingrese su apellido" required>
                                                                        </div>
                                                                </div>
                                                                    <div id="formItem">
                                                                        <div class="formLabel">
                                                                            <label>Nombre:</label>
                                                                        </div>
                                                                        <div class="formInput">
                                                                                <input type="text" name="fname" maxlength="16" minlength="3" placeholder="Ingrese su nombre" required>
                                                                        </div>
                                                                    </div>
                                                                    <div id="formItem">
                                                                        <div class="formLabel">
                                                                            <label>Email:</label>
                                                                        </div>
                                                                        <div class="formInput">
                                                                                <input type="email" name="email" placeholder="Ej: ejemplo@correo.com" required>
                                                                        </div>
                                                                    </div>
                                                                    <div id="formItem">
                                                                        <div class="formLabel">
                                                                            <label>Telefono:</label>
                                                                        </div>
                                                                        <div class="formInput">
                                                                                <input type="text" name="phonen" placeholder="Ej: 2215654242" required>
                                                                        </div>
                                                                    </div>
                                                                    <div id="formItem">
                                                                        <div class="formLabel">
                                                                            <label>Fecha de nacimiento:</label>
                                                                        </div>
                                                                        <div class="formInput">
                                                                                <input type="date" name="bdate" required>
                                                                        </div>
                                                                    </div>
                                                                    <div id="formItem">
                                                                        <div class="formLabel">
                                                                            <label>Contraseña:</label>
                                                                        </div>
                                                                        <div class="formInput">
                                                                                <input type="password" id="pass" name="pass" placeholder="Ingrese una contraseña" required>
                                                                        </div>
                                                                    </div>
                                                                    <div id="formItem">
                                                                        <div class="formLabel">
                                                                            <label>Repita contraseña:</label>
                                                                        </div>
                                                                        <div class="formInput">
                                                                                <input type="password" id="rpass" name="rpass" placeholder="Confirme la contraseña" required>
                                                                        </div>
                                                                    </div>                                                                     
                                                                <div id="loginSubmit">
                                                                        <input type="submit" id="button" value="Registrarse">
                                                                </div>
                                                        </form>
                                                        <script>
                                                                validatePasswords();
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
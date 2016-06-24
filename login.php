<html>
    <head>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="fonts/style.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <script type="text/javascript" src="/functions.js"></script>
        <script src="jquery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <?php 
            include_once 'functions.php';
            $link=  connect();
        ?>  
        <title>CouchInn - Iniciar sesion</title>
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
                            <p>Iniciar sesión</p>
                        </div>
                        <?php 
                        if(isset($_GET['error'])){ ?>
                            <div id="authError" class="error">
                                <img src="img/notok.png" class="okImg">
                                <p class="noMargin">Usuario o contraseña incorrecta.</p>
                            </div>
                            <script>
                                hideDivBlur('#authError');
                            </script>
                        <?php 
                        }?>
                        <div id="loginSection">
                            <form name="login" method="POST" action="validate.php">
                                <p class="label">Email:</p>
                                    <input type="email" name="email" placeholder="Ej: ejemplo@correo.com" required><br>
                                <p class="label">Contraseña:</p>
                                    <input type="password" name="pass" placeholder="Ingrese su contraseña" required><br>
                                <div id="loginSubmit">
                                    <input type="submit" id="button" value="Confirmar">
                                </div>
                            </form>
                        </div>                                        
                        <div id="recoveryButton">
                            <a href="password.php" id="button">Recuperar contraseña</a>
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
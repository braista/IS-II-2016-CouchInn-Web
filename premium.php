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
        <title>CouchInn - Premium</title>
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
            
                //VALIDA SI ESTA LOGUEADO Y SI LO ESTA, EL TIPO DE USUARIO
		if(getAuth()){
			$usertype= getUserType(getUserID());
                        $noauth= false;
                }else{
                        $usertype= 0;
			$noauth= true;                        
                }
            ?>
            <div id="content">               
				<div id="info">
                    <div id="title">
                        <p>Beneficios de ser premium</p>
                    </div><br>
                    <?php
                        // CARTEL DE MODIFICACION CORRECTA Y CODIGO JQUERY PARA OCULTAR EN CASO DE CLICK
                        if(isset($_GET['ok']) && $_GET['ok']== 'true'){ ?>
                            <div id="okPremium" class="ok">
                                <img src="img/ok.png" class="okImg">
                                <p class="noMargin">La transferencia se realizo correctamente! Ahora eres un usuario premium.</p>
                            </div>
                            <script>
                                hideDivBlur('#okPremium');
                            </script>
                    <?php
                        }			
			if($usertype == 2){?>
				<div id="okPremium" class="ok">
                                       <img src="img/ok.png" class="okImg">
                                        <p class="noMargin">Ya eres un usuario premium.</p>
                                </div>
                    <?php
                        }			
                    ?>
                    <div id="premiumDescription">
                        <p>Los usuarios premium del sitio tienen los siguientes beneficios:</p>
                        <p>• Imagen a eleccion para mostrar en el listado principal de couchs de la sección inicio.</p>
                    </div>
                    <?php
                        if(!($noauth)){
                                if($usertype == 1){
                    ?>
                    <div id="premiumButton">
                        <a href="#" id="button">HACERME PREMIUM</a>
                    </div>
                    <script>
                        $(document).ready(function(){ 
                            $('#premiumButton').on('click',function(){
                               $('#premiumForm').toggle();
                            });
                         });
                    </script>
                    <div name="premiumForm" id="premiumForm" style="display: none">
                        <p>Completá el formulario convertirte en usuario Premium:</p>
                        
                        <form name="premium" action="setPremium.php" method="POST" onsubmit="return formValidation('premium')">                            
                                <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Nro tarjeta:</label>
                                    </div>
                                    <div class="formInput">
                                            <input type="text" name="cardn" maxlength="16" minlength="16" placeholder="Número de tarjeta sin guiones (sólo números)">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Titular:</label>
                                    </div>
                                    <div class="formInput">
                                            <input type="text" name="owner" placeholder="Nombre que figura en la tarjeta">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Vencimiento:</label>
                                    </div>
                                    <div class="formInput">
                                            <input type="text" name="expd" minlength="5" maxlength="5" placeholder="Fecha vencimiento que figura en la tarjeta">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Codigo de seguridad:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="scode" minlength="3" maxlength="4">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Direccion:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="adress">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Ciudad:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="city">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Provincia:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="province">
                                    </div>
                                </div>
                                <div id="formItem">
                                    <div class="formLabel">
                                        <label>Codigo postal:</label>
                                    </div>
                                    <div class="formInput">
                                        <input type="text" name="zcode" minlength="4" maxlength="5">
                                    </div>
                                </div>                                
                            <input type="submit" id="button" value="Enviar">
                        </form>
                    </div>
                    <?php 
                        }
                        }
                            ?>
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
<html>
    <head>
        <link rel="stylesheet" href="CSS/main.css">
        <link rel="stylesheet" href="fonts/style.css">
        <script type="text/javascript" src="/functions.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <?php
		include_once 'functions.php';
		$link= connect();
        ?>
        <title>CouchInn - Inicio</title>
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
			
            <!-- BUSCADOR GLOBAL -->
<!--            <div id="buscador">
                <div id="buscadorForm">
                    <form action="search.php" method="POST" name="searcher" onsubmit="return formValidation('search')">
                        <input type="text" name="tag" placeholder="Ingresar titulo o tipo de couch">
                        <input type="submit" value="BUSCAR" id="button">
                    </form>
                </div>			
            </div>-->

            <div id="content"> 							
				<?php
					loadCouchs('null', $link);
				?>
            </div>
		</div>
        <footer>
            <?php    
                show('footer');
            ?>
        </footer>
    </body>
</html>
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
            <div id="backButton">
                    <a id="backButton" class="fade" href="index.php">◄ Atrás</a>
            </div>'
            <div id="formSection">
            <span class="caja_filtro">
                <form class="filtro_form,form center" action="index.php" name="advanced_search" method="GET">
                    <div id="formItem">
                        <div class="formLabel">
                            <label>Nombre Del Couch:</label>
                        </div>
                        <div class="formInput">
                          <input type="text" name="name" id="name" maxlength="25" minlength="4">
                        </div>
                    </div>
                    <div id="formItem">
                        <div class="formLabel">
                            <label>Capacidad:</label>
                        </div>
                        <div class="formInput">
                            <input type="number" min="1" name="capacity" id="capacity" maxlength="2" placeholder="Cantidad de Huespedes">
                        </div>
                    </div>
                    <div id="formItem">
                        <div class="formLabel">
                            <label>Filtrar por tipo de Hospedaje:</label>
                        </div>
                        <div class="formInput">
                            <select name="hosp_id">
                                <?php 
                                 //Selector de tipos de hospedajes.
                                $result=mysqli_query($link,"SELECT * FROM tipocouchs");
                                while($row=mysqli_fetch_array($result)){
                                    $id = $row["idtipocouch"];
                                    echo '<option value="'.$id.'">'.$row["nombre"].'</option>';
                                }
                                unset($result);
                                echo '
                                <option value="0" selected>Ver todos...</option>';
                                ?>
                            </select>
                        </div>
                    </div>
                    <div id="formItem">
                        <div class="formLabel">
                            <label>Lugar:</label>
                        </div>
                        <div class="formInput">
                            <input type="text" name="place" id="place" placeholder="Lugar donde se encuentra">
                        </div>
                    </div>
                    <div id="formTextarea">
                        <div class="formLabel">
                            <label>Descripción:</label>
                        </div>
                        <div class="formInput">
                            <textarea name="description" id="description" placeholder="Descripción de la publicación"></textarea>
                        </div>
                    </div>
                    
                </div>
                <div id="couchSubmit">
                    <button id="button" type="submit" value="Ver">BUSCAR</button>
                </div>
            </form>
            </span>
        </div>
        </div>
        <footer>
            <?php    
                show('footer');
            ?>
        </footer>
    </body>
</html>
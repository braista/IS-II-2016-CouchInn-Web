<?php
        require_once 'functions.php';
        $ant= $_SERVER['HTTP_REFERER'];
        $link = connect();
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $SQL = "SELECT * FROM usuarios WHERE email='$email' AND clave='$pass'";
        $result = mysqli_query($link, $SQL);        
        if(mysqli_num_rows($result) != 0 ){ 
                session_start();
                $row= mysqli_fetch_array($result);
                $_SESSION['user']= $row['nombre'];
                setcookie("userid", $row['idusuario'], time() + 60*60*24 );
                redirectAfter("index.php", 2);
        } else {
                redirect("login.php?error");
        }
?>

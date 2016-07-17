<?php
    require_once 'functions.php';
    $link = connect();
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $SQL = "SELECT * FROM usuarios WHERE email='$email' AND clave='$pass'";
    $result = mysqli_query($link, $SQL);        
    if(mysqli_num_rows($result) != 0 ){ 
        session_start();
        $row= mysqli_fetch_array($result);
        $_SESSION['user']= $row['nombre'];
        $_SESSION['userid']= $row['idusuario'];
        setcookie("userid", $row['idusuario'], time() + 60*60*24 );
        redirect("index.php");
    } else 
        redirect("login.php?error");    
?>

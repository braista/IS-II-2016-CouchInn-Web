<?php
        require_once 'functions.php';
        $link = connect();
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $bdate = $_POST['bdate'];
        $phonen = $_POST['phonen'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $rpass = $_POST['rpass'];
        $SQL= "SELECT * FROM usuarios WHERE email='$email'";
        $result= mysqli_query($link, $SQL);
        if(mysqli_num_rows($result) == 0){
                $SQL = "INSERT INTO usuarios(apellido, nombre, fnacimiento, telefono, email, clave, idtipousuario) VALUES ('$lname', '$fname', '$bdate', '$phonen', '$email', '$pass', '1')";
                mysqli_query($link, $SQL);
                redirectWithAlert("login.php", "Se ha registrado correctamente");
        }
        else
                redirect("register.php?error");
?>

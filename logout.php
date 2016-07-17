<?php
    unset($_COOKIE['userid']);
	session_start();
	session_destroy();
	header("Location: index.php");

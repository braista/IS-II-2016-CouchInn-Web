<?php
    unset($_COOKIE['userid']);
	session_start();
	session_destroy();
	sleep(3);
	header("Location: index.php");
?>
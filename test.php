<?php
include 'functions.php';
$date= getdate();
$dd= $date['mday'];
$mm= $date['mon'];
$yy= $date['year'];
alert("$dd/$mm/$yy");
?>
<?php
include_once 'functions.php';
$link= connect();
$imgID = $_GET["img"];
$couchid= $_GET["id"];
$query= "SELECT * FROM imagenes WHERE idimagen='$imgID'";
$row= mysqli_fetch_array(mysqli_query($link, $query));
$imgname= $row["imagen"];

//CORTE DEL NOMBRE
$del1="/";
$del2=".";
//NOMBRE DE IMG
$total1= strpos($imgname, $del1);
$total2= strpos($imgname, $del2);
$img= substr($imgname,$total1+1,$total2-3);
alert($img);

$query= "SELECT * FROM imagenes WHERE idcouch='$couchid'";
if($img == "1"){
    $i=1;
    $oldname= $imgname;
    while ($imgRow = mysqli_fetch_array(mysqli_query($link, $query))) {
        $img= $imgRow["imagen"];
        //EXTENSION DE IMG
        $total2= strpos($img, $del2);
        $ext= substr($img,$total2+1);
        
        $query= "UPDATE imagenes SET imagen='$i.$ext' WHERE idimagen='$imgID";
        alert($i.".".$ext);
        rename("img/$oldname", "img/$i.$ext");
        $imgID= $imgRow["idimagen"];
        $oldname= $img;
        $i++;
    }
}

//$query= "DELETE imagenes WHERE idimagen='imgid'";
//$result= mysqli_query($link, $query);
//if ($result){
//    redirectWithAlert($url, $text);
//}
?>


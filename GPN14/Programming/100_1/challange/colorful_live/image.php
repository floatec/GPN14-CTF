<?php
session_start();
header ("Content-type: image/png");
$im = @ImageCreate (50, 100)
    or die ("Kann keinen neuen GD-Bild-Stream erzeugen");
$_SESSION['r'] = rand(0,255);
$_SESSION['g'] = rand(0,255);
$_SESSION['b'] = rand(0,255);
$_SESSION['time'] = $_SERVER['REQUEST_TIME'];
$background_color = ImageColorAllocate ($im, $_SESSION['r'], $_SESSION['g'],$_SESSION['b']);
ImagePNG ($im);
?>
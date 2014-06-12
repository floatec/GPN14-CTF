<?php
session_start();

header("Content-type: image/png");
function RandomString($len)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $len; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}
function makeGradient($fromRGB,$toRGB,$imgHeight){
    
    $diffR = ($fromRGB[0]-$toRGB[0]); //38
    $diffG = ($fromRGB[1]-$toRGB[1]); //133
    $diffB = ($fromRGB[2]-$toRGB[2]); // -6

    $maxR = $diffR / $imgHeight; // 0.475
    $maxG = $diffG / $imgHeight; // 1,66
    $maxB = $diffB / $imgHeight; // 0.075

    $maxNR = $maxR;
    $maxNG = $maxG;
    $maxNB = $maxB;

    for($x=0;$x<$imgHeight;$x++){
        $color['r'][$x] = abs($fromRGB[0] - $maxR);
        $color['g'][$x] = abs($fromRGB[1] - $maxG);
        $color['b'][$x] = abs($fromRGB[2] - $maxB);
        $maxR += $maxNR;
        $maxG += $maxNG;
        $maxB += $maxNB;
    }
    
    return $color;
    
}

$time_start = microtime(true);

// Schriftgröße
$size = 20;

//Bildgroesse
$imgWidth = 300;//200
$imgHeight = 50;//80

// Farbverlauf RGB-Wert Start und RGB-Wert Ende
$fromRGB = array(
    rand(0,255),
    rand(0,255),
    rand(0,255)
);
$toRGB = array(
    rand(0,255),
    rand(0,255),
    rand(0,255)
);

// Randfarbe
$colorBorder = array(
    154,
    53,
    2
);
/* Bild erstellen */
$img = ImageCreateTrueColor($imgWidth,$imgHeight);
$imgout = ImageCreateTrueColor($imgWidth,$imgHeight);
$colorB = imagecolorallocate($img,$colorBorder[0],$colorBorder[1],$colorBorder[2]);
$colorRGB = makeGradient($fromRGB,$toRGB,$imgHeight);
for($x=0;$x<$imgHeight;$x++){
    $r = $colorRGB['r'][$x];
    $g = $colorRGB['g'][$x];
    $b = $colorRGB['b'][$x];
    $color = imagecolorallocate($img,$r,$g,$b);
    imageline($img,0,$x,$imgWidth,$x,$color);
}


putenv('GDFONTPATH=' . realpath('.'));
$grey = imagecolorallocate($img, 128, 128, 128);
$font = 'font.otf';
$text = RandomString(16);

$_SESSION['captchatext'] = $text;
$_SESSION['captchatime'] = time();
list($left,, $right) = imageftbbox( $size, 0, $font, $text);
$off = ($imgWidth/2 - $right/2);
imagettftext($img, $size, 0, $off, 40,$grey, $font , $text);
#imagestring($img, 100, 0, 0, RandomString(10), 0xffffff);

$time_end = microtime(true);
$time = $time_end - $time_start;

$a = array();
for ($i = 0; $i < $imgHeight; $i++) 
{
	array_push($a, $i);
}
shuffle($a);

for ($i = 0; $i < $imgHeight; $i++) 
{
	imagecopy($imgout, $img, 0, $i, 0, $a[$i], $imgWidth, 1);
}
#imagestring($img, 1 , 0, $imgHeight-10, ($time*1000)."ms to create" , 0);
ImagePNG($imgout);
imagedestroy($img);
imagedestroy($imgout);


?>
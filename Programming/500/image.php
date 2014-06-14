<?php
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Content-type: image/png");
function RandomString($len)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $len; $i++) {
        $x = rand(0, strlen($characters)-1);
        
        #echo $x."-".$characters[$x]."\n";
        $randstring .= $characters[$x];
    }
    return $randstring;
}

$time_start = microtime(true);

// Schriftgröße
$size = 15;

//Bildgroesse
$imgWidth = 175;//200
$imgHeight = 50;//80


/* Bild erstellen */
$img = ImageCreateTrueColor($imgWidth,$imgHeight);




$grey[] = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
$grey[] = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
$grey[] = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
$grey[] = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
$type = rand(0,9);
putenv('GDFONTPATH=' . realpath('./data/'.$type.'/'));
$font = 'font.ttf';
$text = RandomString(4);

$_SESSION['captchatext'] = $text;
$_SESSION['captchatime'] = time();

for ($i =0; $i < strlen($text); $i++)
{
    $angle = rand(-25,25);
    list($left,, $right) = imageftbbox( $size, 0, $font, $text[$i]);
    $off = ($imgWidth/4*$i + $imgWidth/8);
    imagettftext($img, $size, $angle, $off, 35,$grey[$i], $font , $text[$i]);
}
#imagestring($img, 100, 0, 0, RandomString(10), 0xffffff);

$time_end = microtime(true);
$time = $time_end - $time_start;
imagestring($img, 1 , 0, 0, "font ".$type , 0xffffff);
imagestring($img, 1 , 0, $imgHeight-10, ($time*1000)."ms to create" , 0);
ImagePNG($img);
imagedestroy($img);



?>

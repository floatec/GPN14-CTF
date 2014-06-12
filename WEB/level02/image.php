<?php


  $url = $_GET["url"];

  if(!preg_match("/.jpg/i", $url)){
    header("Content-Type: text/html");
    echo "Only JPGs allowed!";
  } else {
    if(preg_match("/^http:/i", $url)) {
      header("Content-Type: image/jpeg");
      readfile($url);
    } else {
      header("Content-Type: text/html");
      echo "Only 'http:' URLs are allowed";
    }
  }
?>

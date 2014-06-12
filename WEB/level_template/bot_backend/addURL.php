<?php
require("conn.php");
function saveURL($url, $mysqli) {
  $stmt = $mysqli->prepare("INSERT INTO urls(`url`, `id`) VALUES(?,0)");
  
  $stmt->bind_param("s", $url);

  $stmt->execute();
}


?>

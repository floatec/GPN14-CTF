<?php

require("conn.php");

$no = 5;

if (isset($_GET["no"])) {
  $no = $_GET["no"];
}

$stmt   = $mysqli->prepare("SELECT * FROM urls WHERE visited = 0 LIMIT ?");
$upstmt = $mysqli->prepare("UPDATE urls SET visited = 1 WHERE id = ?"); 

$stmt->bind_param("i", $no);
$stmt->execute();
$res = $stmt->get_result();

$result = array();
$count = 0;
while(($row = $res->fetch_assoc()) != null ) {
  $result[$count] = $row["url"];
  $count++;
  
  $upstmt->bind_param("i", $row[id]);
  $upstmt->execute();
}


$stmt->close();
$upstmt->close();

echo json_encode($result);
?>

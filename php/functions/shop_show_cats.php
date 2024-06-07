<?php
$path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
include(  $path_config);

$sql = "SELECT * FROM category LIMIT 8";
$result = $conn->query($sql);


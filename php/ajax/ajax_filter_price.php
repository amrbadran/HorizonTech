<?php
$path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
include(  $path_config);

$price = 0;
if(isset($_POST['price']) && !empty($_POST['price'])){

    $price = (int)$_POST['price'];

}

?>

<?php
$path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
include(  $path_config);
include ($_SERVER['DOCUMENT_ROOT'].'/HorizonTech/php/functions/shop_show_products.php');

$id = isset($_GET['id']) ? $_GET['id'] : 1;

$sql = "SELECT * FROM product WHERE id = $id";
$result = $conn->query($sql);

$images = get_images_product($id);


function get_category_by_id($id){
    global $conn;
    $sql = "SELECT * FROM category WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['name'];
}

function show_related_products($id){
    global $conn;
    $sql = "SELECT * FROM product WHERE cat_id = $id LIMIT 4";
    $result = $conn->query($sql);
    return $result;
}



?>
<?php
$path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
include(  $path_config);

function get_orders(){

    $usr_id = $_SESSION['user_id'];
    global $conn;
    $sql = "SELECT * FROM orders,order_product WHERE orders.id=order_product.order_id AND user_id=$usr_id";
    $result = $conn->query($sql);

    return $result;

}

function get_price_order(){

}
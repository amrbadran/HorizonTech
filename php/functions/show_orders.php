<?php
$path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
include(  $path_config);

function get_orders(){

    $usr_id = $_SESSION['user_id'];
    global $conn;
    $sql = "SELECT * FROM orders WHERE usr_id=$usr_id";
    $result = $conn->query($sql);

    return $result;

}

function get_price_product($id){
    global $conn;
    $sql = "SELECT * FROM product WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['price'];
}
function get_order_products($id){
    $sql = "SELECT * FROM order_product WHERE order_id=$id";
    global $conn;
    $result = $conn->query($sql);
    return $result;

}
function get_category_by_id($id){
    global $conn;
    $sql = "SELECT * FROM category WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['name'];
}
function get_product_info($id){
    global $conn;
    $sql = "SELECT * FROM product WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
}
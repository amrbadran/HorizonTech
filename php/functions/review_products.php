<?php
$path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
include(  $path_config);
function can_review($usr_id , $product_id){

    if(is_reviewed($usr_id,$product_id)) return false;
    $sql = "SELECT * FROM orders,order_product WHERE orders.id=order_product.order_id AND usr_id=$usr_id AND product_id=$product_id AND DATEDIFF(NOW(), date_order) > 2";
    global $conn;
    $r = $conn->query($sql);
    return ($r->num_rows > 0);
}

function is_reviewed($usr_id , $product_id){

    global $conn;
    $sql = "SELECT * FROM review WHERE usr_id=$usr_id AND product_id=$product_id";
    $r = $conn->query($sql);
    return ($r->num_rows > 0);


}

function average_count_reviews($product_id){
    $sql = "SELECT AVG(rate) as average_rating, COUNT(rate) as rating_count FROM review WHERE product_id = $product_id";
    global $conn;
    $r = $conn->query($sql);
    if($r->num_rows == 0) return array(0,0);
    $row = $r->fetch_assoc();

    $result = array($row['average_rating'],$row['rating_count']);
    return $result;
}
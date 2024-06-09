<?php
$path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
include(  $path_config);
include('../functions/review_products.php');

$usr_id = $_POST['user_id'];
$product_id = $_POST['product_id'];
$rate = $_POST['rate'];


if(can_review($usr_id,$product_id)){

    $sql = "INSERT INTO review(usr_id,product_id,rate) VALUES($usr_id,$product_id,$rate)";
    global $conn;
    $conn->query($sql);

    echo 'success';


}
else{
    echo 'cant reviewd';
}


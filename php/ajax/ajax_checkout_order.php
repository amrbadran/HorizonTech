<?php
session_start();
$path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
include(  $path_config);
$user_id = $_SESSION['user_id'];
$address = $_POST['streetAddress'];
$sql = "INSERT INTO orders(usr_id,address) VALUES ($user_id,$address);";


$dataCart = $_POST['dataCart'];
if(empty($dataCart)) {echo 'Your Cart is Empty';exit();}
$dataCart = rtrim($dataCart, ',');

$pairs = explode(',', $dataCart);

$result = array();

foreach ($pairs as $pair) {

    $values = explode('+', $pair);
    $result[] = $values;
}



if($conn->query($sql)){
    $or = $conn->insert_id;
    $flag = true;
    foreach ($pairs as $pair) {

        $values = explode('+', $pair);
        $result[] = $values;

        $id = $values[0];
        $quantity = $values[1];

        $sql = "UPDATE product SET quantity_aval = quantity_aval - $quantity WHERE id = $id";

        try{
            $conn->query($sql);
        }
        catch (Exception $e) {

            if (strpos($e->getMessage(), 'check constraint')) {

                echo "E$id";
                $flag = false;
                break;
            } else {
                echo "Error: " . $e->getMessage();
            }
        }

    }

    if($flag) {
        foreach ($pairs as $pair) {

            $values = explode('+', $pair);
            $result[] = $values;

            $product_id = $values[0];
            $quantity = $values[1];
            $usr_id = $user_id;
            $order_id = $or;

            $sql = "INSERT INTO order_product(order_id,product_id,quantity,user_id) VALUES($order_id,$product_id,$quantity,$usr_id)";
            $conn->query($sql);

            echo 'success';


        }
    }



}
else{
    echo 'error has happend';
}

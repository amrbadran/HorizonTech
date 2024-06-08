<?php
$path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
include(  $path_config);
include('../functions/shop_show_products.php');
function get_category_by_id($id){
    global $conn;
    $sql = "SELECT * FROM category WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['name'];
}
$id = $_POST['id'];
$quantity = $_POST['quantity'];

$sql = "SELECT * FROM product WHERE id=$id";
$result=$conn->query($sql);

while($row = $result->fetch_assoc()){
    $images = get_images_product($id);
    $default_path_image = "images/keyboards/2.jpg";
    $image_path = count($images) > 0 ? 'images/'.$images[0] : $default_path_image;
    ?>


        <div class="image-cart-product">
            <img src="<?php echo $image_path; ?>" width="100" height="120" alt="">
        </div>
        <input type="hidden" value="<?php echo $id;?>"/>
        <div class="product-cart-info h-75">
            <p class="product-cart-cats"><?php echo get_category_by_id($row['cat_id']); ?></p>
            <h5><a href=""><?php echo $row['name']; ?></a></h5>
            <p class="product-cart-tags"><?php echo $row['tag']; ?></p>
        </div>
        <form class='mt-lg-4 mx-lg-5' action="">
            <input type="number" value='<?php echo $quantity; ?>' min="1" width="30">
        </form>
        <h5 class="product-cart-price mt-lg-4 pt-lg-2 mx-lg-5">
            <?php echo number_format($row['price'],2).'$'; ?>
        </h5>
        <span class="position-absolute"><i class="fa fa-trash"></i></span>

    <?php


}



?>

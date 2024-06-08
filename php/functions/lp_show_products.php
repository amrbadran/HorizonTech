<?php
$path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
include(  $path_config);
include ($_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/functions/shop_show_products.php');

function get_lp_products($cat_id){
    $default_path_image = "images/keyboards/2.jpg";
    $sql = "SELECT * From product WHERE cat_id=$cat_id";
    global $conn;
    $res = $conn->query($sql);
    while($row = $res->fetch_assoc()){
        $images = get_images_product($row['id']);
        $image_path = count($images) > 0 ? 'images/'.$images[0] : $default_path_image;
        ?>
        <div class="col-lg-4">
            <div class="w-75 h-100" width="80" height="80">
                <img src="<?php echo $image_path; ?>" width="100%" height="100%" alt="">
            </div>
            <div class="product-overlay">
                <h5><?php echo implode(' ', array_slice(explode(' ', $row['name']), 0, 2)); ?></h5>
                <p><?php echo number_format($row['price'],2) . '$'; ?></p>
                <a href="product.php?id=<?php echo $row['id'] ?>">Go to Product</a>
            </div>
        </div>
        <?php
    }
}

<?php
include('php/header.php');
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<section class="branch-wlc">

    <div>
        <p class="w-100"><a class="link-page" href="">HOME</a> / <span>Order</span></p>
        <h1 class="w-100">ORDERS </h1>
    </div>
    <div class="overlay"></div>
</section>
<div class="container orders mt-3 mt-md-5">

    <div class="row">


        <?php
        include('php/functions/show_orders.php');
        include('php/functions/shop_show_products.php');
        $result = get_orders();

        while ($row = $result->fetch_assoc()) {

            ?>
            <div class="col-12">
                <div class="list-group mb-5">
                    <div class="list-group-item p-3"
                         style="position: relative;background:var(--main-color-low-opacity);border:none;">
                        <div class="row w-100 no-gutters">
                            <div class="col-6 col-md">
                                <h6 class="text-charcoal mb-0 w-100">Order Number</h6>
                                <p href=""
                                   class="text-pebble mb-0 w-100 mb-2 mb-md-0"><?php echo $row['id']; ?></p>
                            </div>
                            <div class="col-6 col-md">
                                <h6 class="text-charcoal mb-0 w-100">Date</h6>
                                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0"><?php echo $row['date_order']; ?></p>
                            </div>
                            <div class="col-6 col-md">
                                <h6 class="text-charcoal mb-0 w-100">Total</h6>
                                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">

                                    <?php

                                    $orderId = $row['id'];
                                    $result2 = get_order_products($orderId);
                                    $price = 0;
                                    while ($row_price = $result2->fetch_assoc()) {

                                        $price = $price + get_price_product($row_price['product_id']) * $row_price['quantity'];

                                    }
                                    echo $price;
                                    ?>

                                </p>
                            </div>
                            <div class="col-6 col-md">
                                <h6 class="text-charcoal mb-0 w-100">Shipped To</h6>
                                <p class="text-pebble mb-0 w-100 mb-2 mb-md-0"><?php echo isset($row['address']) ? $row['address'] : ""; ?></p>
                            </div>

                        </div>

                    </div>
                    <div class="list-group-item p-3" style="">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-9 pr-0 pr-md-3 mb-3">
                                <div class="alert p-2 alert-success w-100 mb-0"
                                     style="background:#222;box-shadow:3px 3px 10px #222;">
                                    <h6 class="text-green mb-0"><b>Shipped</b></h6>
                                    <p class="hidden-sm-down mb-0">Will Be arrived in 48 Hours</p>
                                </div>
                            </div>


                            <?php

                            $default_path_image = "images/keyboards/2.jpg";
                            $result3 = get_order_products($orderId);

                            while ($row2 = $result3->fetch_assoc()) {

                                $productId = $row2['product_id'];
                                $row_product = get_product_info($productId);

                                $images = get_images_product($row_product['id']);

                                $image_path = count($images) > 0 ? 'images/' . $images[0] : $default_path_image;
                                ?>
                                <div class="row no-gutters mt-3">
                                    <div class="col-3 col-md-1">
                                        <img class="img-fluid pr-3"
                                             style="border-radius:50%;border:1px solid var(--main-color-low-opacity);"
                                             src="<?php echo $image_path; ?>" alt="">
                                    </div>
                                    <div class="col-9 col-md-8 pr-0 pr-md-3">
                                        <h6 class="text-charcoal mb-2 ">
                                            <a href="" class="text-charcoal"><?php echo $row_product['name']; ?></a>
                                        </h6>
                                        <h6 style="font-size:14px;color:#ddd;">Category
                                            : <?php echo get_category_by_id($row_product['cat_id']) ?></h6>
                                        <h6 class="mb-0 mb-md-2" style="font-size:14px;color:#ddd;"><b>

                                                <?php
                                                $res_price = $row2['quantity'] * $row_product['price'];
                                                echo $row2['quantity'] . " X " . $row_product['price'] . '$' . " = " . $res_price . '$';


                                                ?>

                                            </b></h6>
                                    </div>

                                </div>

                                <?php

                            }

                            ?>


                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


</div>


<?php include('php/footer.php'); ?>
<script src="js/bootstrap.js"></script>
    <?php include('php/header.php'); ?>
    <section class="branch-wlc">

        <div>
            <p class="w-100"><a class="link-page" href="">HOME</a>  /   <a href="" class="link-page">SHOP</a>  /   <span>Product</span></p>
            <h1 class="w-100">SHOP </h1>
        </div>
        <div class="overlay"></div>
    </section>

    <section class="product-page p-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <?php

                        include('php/functions/show_product_info.php');
                        $default_path_image = "images/keyboards/2.jpg";

                    ?>
                    <div class="image-product">
                        <?php
                            $image_path = count($images) > 0 ? 'images/'.$images[0] : $default_path_image;

                        ?>
                        <img src="<?php echo $image_path; ?>" alt="" class="img-fluid">
                    </div>

                    <div class="product-images d-flex w-100">
                        <?php
                            for($i = 1; $i < count($images); $i++){
                                ?>
                                    <div class="m-3 w-25"><img src="<?php echo 'images/'. $images[$i]; ?>" alt="" class="w-100"></div>
                                <?php
                            }




                        ?>

                    </div>
                </div>
                <div class="col-lg-7">
                    <?php $row = $result->fetch_assoc(); ?>
                    <h2><?php echo $row['name']; ?></h2>
                    <div class="product-rating m-3">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <span class="m-2">(3 Customers Review)</span>
                    </div>
                    <div class="product-price m-3">
                        <h3><?php echo number_format($row['price'],2).'$';?></h3>
                    </div>
                    <p class="description-product m-3">
                        <span>
                            <?php echo $row['description']; ?>
                        </span>
                    </p>
                    <form class='m-3' action="">
                        <input type="number" value='1' width="30">
                        <button><i class="fa fa-shopping-cart"></i> Add to cart</button>
                        <button><i class="fa fa-money"></i> Buy Now</button>
                    </form>
                    <div class="progress m-3">
                        <?php
                            $quantity = $row['quantity'];
                            $quantity_aval = $row['quantity_aval'];
                            $sold = (($quantity - $quantity_aval)/$quantity) *100;
                            $sold = (int)$sold;

                        ?>
                        <div class="progress-bar" role="progressbar" style="width: <?php echo $sold; ?>%" aria-valuenow="<?php echo $sold;?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="m-3 progress-values">Available: <span style="color:#ccc;margin-right:10px;" ><?php echo $quantity_aval; ?></span> Sold: <span style="color:#ccc;"><?php echo $quantity - $quantity_aval; ?></span></p>

                    <div class="info-product m-3">
                        <p><b>Category: </b><?php echo get_category_by_id($row['cat_id']);?></p>
                        <p><b>Tags: </b> <?php echo $row['tag']; ?></p>
                        <p><b>Manufacturer:</b> <?php echo $row['manufacturer']; ?></p>
                        <p><b>SKU: </b>NT-002345-01-12</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container related-products">
            <h2>Related Products</h2>
        <div class="row w-100">

                <?php

                    $result = show_related_products($row['cat_id']);
                    while($row = $result->fetch_assoc()){
                        $images = get_images_product($row['id']);
                        $image_path = count($images) > 0 ? 'images/'.$images[0] : $default_path_image;
                        ?>
                        <div class="col-lg-3">
                            <div class="card-shop-product text-center">
                                <img src="<?php echo $image_path;  ?>" class="w-100" alt="" class="">
                                <h3><?php echo $row['name']; ?></h3>
                                <p><?php echo number_format($row['price'],2).'$';?></p>
                                <div class="product-icons" align="center">
                                    <i class="fa fa-cart-plus"></i>
                                    <a href="product.php?id=<?php echo $row['id']; ?>"><i class="fa fa-eye"></i></a>

                                </div>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>


                        <?php

                    }
                ?>
        </div>
        </div>
    </section>
    <?php include('php/footer.php'); ?>
    <script src="js/product.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
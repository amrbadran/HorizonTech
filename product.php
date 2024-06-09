<?php include('php/header.php'); ?>
<section class="branch-wlc">

    <div>
        <p class="w-100"><a class="link-page" href="">HOME</a> / <a href="" class="link-page">SHOP</a> /
            <span>Product</span></p>
        <h1 class="w-100">SHOP </h1>
    </div>
    <div class="overlay"></div>
</section>
<?php

include('php/functions/show_product_info.php');
if ($result->num_rows == 0) header("Location: index.php");
?>


<?php

include('php/functions/review_products.php');
if (isset($_SESSION['user_id']) && can_review( $_SESSION['user_id'] , $id)) {
    ?>
    <div id="ratingOverlay" class="overlay" style="position:fixed;z-index:1500;"></div>
    <div class="" id="ratingProduct" style="z-index:1501;">
        <h3 style="width:100%;">How Do You Rate This Product?</h3>
        <br>
        <input type="hidden" id="ratingProductID" value="<?php echo $id; ?>"/>
        <input type="hidden" id="ratingUsrID" value="<?php echo $_SESSION['user_id']; ?>"/>
        <div class="rate d-flex justify-content-center">
            <input type="checkbox" id="star5" name="rate" value="5"/>
            <label for="star5" title="text" style="order:5;">5 stars</label>
            <input type="checkbox" id="star4" name="rate" value="4"/>
            <label for="star4" title="text" style="order:4;">4 stars</label>
            <input type="checkbox" id="star3" name="rate" value="3"/>
            <label for="star3" title="text" style="order:3;">3 stars</label>
            <input type="checkbox" id="star2" name="rate" value="2"/>
            <label for="star2" title="text" style="order:2;">2 stars</label>
            <input type="checkbox" id="star1" name="rate" value="1"/>
            <label for="star1" title="text" style="order:1;">1 star</label>
        </div>
        <i id="closeRating" class="fa fa-close"></i>
    </div>
    <?php
}
?>

<section class="product-page p-5">
    <?php


    if (isset($_GET['error']) && $_GET['error'] == "qaError") {
        ?>
        <div class="text-center" style="color:#f00">You Have Exceed the limit value of Quantity Available !!</div>
        <?php
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <?php

                $default_path_image = "images/keyboards/2.jpg";

                ?>
                <div class="image-product">
                    <?php
                    $image_path = count($images) > 0 ? 'images/' . $images[0] : $default_path_image;

                    ?>
                    <img src="<?php echo $image_path; ?>" alt="" class="img-fluid">
                </div>

                <div class="product-images d-flex w-100">
                    <?php
                    for ($i = 0; $i < count($images); $i++) {
                        ?>
                        <div class="m-3 w-25"><img src="<?php echo 'images/' . $images[$i]; ?>" alt="" class="w-100">
                        </div>
                        <?php
                    }


                    ?>

                </div>
            </div>
            <div class="col-lg-7">
                <?php $row = $result->fetch_assoc(); ?>
                <h2><?php echo $row['name']; ?></h2>
                <div class="product-rating m-3">
                    <?php

                        $rating_result = average_count_reviews($id);
                        for($i = 0 ; $i < (int)$rating_result[0] ; $i++){
                            ?>
                            <i class="fa fa-star"></i>
                            <?php
                        }
                    ?>
                    <span class="m-2">(<?php echo $rating_result[1]; ?> Customers Review)</span>
                </div>
                <div class="product-price m-3">
                    <h3><?php echo number_format($row['price'], 2) . '$'; ?></h3>
                </div>
                <p class="description-product m-3">
                        <span>
                            <?php echo $row['description']; ?>
                        </span>
                </p>
                <?php
                $quantity_aval = $row['quantity_aval'];
                ?>
                <form class='m-3'>
                    <input type="number" value='1' min="1" max="<?php echo $quantity_aval; ?>" width="30"
                           id="quantityCart">
                    <input type="hidden" id="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" id="username_logged_in"
                           value="<?php if (isset($_SESSION['username'])) echo $_SESSION['username']; ?>">
                    <button id="buttonAddCart"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                    <button><i class="fa fa-money"></i> Buy Now</button>
                </form>
                <input id='maxQuantity' type="hidden" value="<?php echo $row['quantity_aval']; ?>">
                <label for="" id="error-msg-max-cart" class="ms-3 " style="color:#f00;display: none;">Maximmum 15
                    products in Shopping cart</label>
                <div class="progress m-3">
                    <?php
                    $quantity = $row['quantity'];

                    $sold = (($quantity - $quantity_aval) / $quantity) * 100;
                    $sold = (int)$sold;

                    ?>
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $sold; ?>%"
                         aria-valuenow="<?php echo $sold; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="m-3 progress-values">Available: <span
                            style="color:#ccc;margin-right:10px;"><?php echo $quantity_aval; ?></span> Sold: <span
                            style="color:#ccc;"><?php echo $quantity - $quantity_aval; ?></span></p>

                <div class="info-product m-3">
                    <p><b>Category: </b><?php echo get_category_by_id($row['cat_id']); ?></p>
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



            while ($row = $result->fetch_assoc()) {
                $images = get_images_product($row['id']);
                $image_path = count($images) > 0 ? 'images/' . $images[0] : $default_path_image;
                ?>



                <div class="col-lg-3">


                    <input type="hidden" id="maxQuantity<?php echo $row['id'];?>" value="<?php echo $row['quantity_aval']; ?>">
                    <input type="hidden" id="productQuantity<?php echo $row['id']; ?>" value="0">
                    <input type="hidden" id="productTitle<?php echo $row['id'];?>" value="<?php echo $row['name']; ?>"/>
                    <input type="hidden" id="productCategoryCart<?php echo $row['id'];?>" value="<?php echo get_category_by_id($row['cat_id']); ?>"/>
                    <input type="hidden" id="productTagCart<?php echo $row['id'];?>" value="<?php echo $row['tag']; ?>"/>
                    <input type="hidden" id="productImageCart<?php echo $row['id'];?>" value="<?php echo $image_path; ?>"/>
                    <input type="hidden" id="productPriceCart<?php echo $row['id'];?>" value="<?php echo number_format($row['price'], 2) . '$'; ?>"/>
                    <div class="card-shop-product text-center">
                        <img src="<?php echo $image_path; ?>" class="w-100" alt="" class="">
                        <h3><?php echo $row['name']; ?> </h3>
                        <p><?php  echo number_format($row['price'],2) . '$'; ?></p>
                        <div class="product-icons" align="center">

                            <i class="fa fa-cart-plus"></i>
                            <input id="productId" type="hidden" value="<?php echo $row['id']; ?>"/>
                            <input id="productTitle" type="hidden" value="<?php echo $row['name']; ?>"/>
                            <a href="product.php?id=<?php echo $row['id'];?>"><i class="fa fa-eye"></i></a>
                            <label for="" id="error-msg-max-cart<?php echo $row['id'];?>" class="ms-3 " style="color:#f00;display: none;">Maximmum 15 products in Shopping cart</label>
                            <label for="" id="error-msg-max-cart" class="ms-3 " style="color:#f00;display: none;"></label>

                        </div>
                        <div class="product-rating">
                            <?php

                            $avg_rating = average_count_reviews($row['id'])[0];
                            for($i = 0;$i < (int)$avg_rating ; $i++){
                                ?>
                                <i class="fa fa-star"></i>
                                <?php

                            }

                            ?>


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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="js/product.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
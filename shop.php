    <?php include('php/header.php'); ?>

    <?php
        $default_path_image = "images/keyboards/2.jpg";
    ?>
    <section class="branch-wlc">

        <div>
            <p class="w-100"><a class="link-page" href="">HOME</a> / <span>SHOP</span></p>
            <h1 class="w-100">SHOP</h1>
        </div>
        <div class="overlay"></div>
    </section>

    <section class="shop-products">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="products-title-dropdown">
                        <?php include('php/functions/shop_show_products.php');?>
                        <?php


                            show_products();

                        ?>
                        <span class="">Showing 1-9 of <?php echo $total_results; ?> Results</span>
                        <form action="shop.php" method="post" class="float-lg-end mt-lg-0 mt-sm-3 select-form">
                            <select class='w-lg-100 ' name="select_sort" id="select_sort">
                                <option value="l" <?php if(isset($_POST['select_sort']) && $_POST['select_sort'] =='l'){echo "selected";} ?> >Sort By Latest</option>
                                <option value="lh" <?php if(isset($_POST['select_sort']) && $_POST['select_sort']=='lh'){echo "selected";} ?>>Sort By Low to High Price</option>
                                <option value="hl" <?php if(isset($_POST['select_sort']) && $_POST['select_sort']=='hl'){echo "selected";} ?>>Sort By High to Low Price</option>
                                <option value="r" <?php if(isset($_POST['select_sort']) && $_POST['select_sort']=='r'){echo "selected";} ?>>Sort By Rating</option>


                            </select>

                        </form>

                    </div>
                    <div class="row w-100">
                        <?php

                            while($row = $result->fetch_assoc()){
                                $images = get_images_product($row['id']);
                                $image_path = count($images) > 0 ? 'images/'.$images[0] : $default_path_image;
                                ?>
                                <div class="col-lg-4">
                                    <div class="card-shop-product text-center">
                                        <img src="<?php echo $image_path; ?>" class="w-100" alt="" class="">
                                        <h3><?php echo $row['name']; ?> </h3>
                                        <p><?php  echo number_format($row['price'],2) . '$'; ?></p>
                                        <div class="product-icons" align="center">
                                            <i class="fa fa-cart-plus"></i>
                                            <i class="fa fa-eye"></i>
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
                    <div class="products-pagination text-center">
                        <ul class="pagination">

                            <?php
                                $cur_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                if ($cur_page  < 1) $cur_page  = 1;
                                $cur_page_back = $cur_page <= 1 ? 1 : $cur_page - 1;
                                $cur_page_forward = $cur_page <= $total_pages ? $total_pages : $cur_page + 1;
                                $url = "shop.php";
                                if(isset($_GET['search'])){
                                    $url = $url . "?search=". $_GET['search'] . '&page=';
                                }
                                else{
                                    $url = $url . "?page=";
                                }
                                ?>
                                <li class="page-item"><a class="page-link" href="<?php echo $url . $cur_page_back; ?>"><i class="fa fa-arrow-left"></i></a></li>
                                <?php
                                $pagesMax = $total_pages > 3 ? 3 : $total_pages;

                                for($i=1 ; $i<= $pagesMax ; $i++){

                                    if ($i == $cur_page ){
                                        ?>
                                        <li class="page-item active"><a class="page-link" href="<?php echo $url . $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <li class="page-item"><a class="page-link" href="<?php echo $url . $i; ?>"><?php echo $i; ?></a></li>
                                    <?php
                                    }

                                }

                            ?>

                            <li class="page-item"><a class="page-link" href="<?php echo $url . $cur_page_forward; ?>"><i class="fa fa-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="product-search">
                        <form action="shop.php" method="get">
                            <input id="search-product" type="text" class="w-lg-100" placeholder="Search..." name="search">
                        </form>

                    </div>
                    <div class="filter-price text-center">
                        <h4 class="text-start">Filter By Price</h4>
                        <input class='range-slider' type="range" min="1" max="100" value="50" ><br>
                        <div class="text-end position-relative">
                            <span id="price-to-filter" class="position-absolute">20$</span>
                            <input id="filter-price" type="button" value="Filter">
                        </div>
                    </div>
                    <div class="product-cats">
                        <h4>Categories</h4>
                        <ul class="list-unstyled">
                            <?php
                                include('php/functions/shop_show_cats.php');
                                while($row = $result->fetch_assoc()){

                                    ?>
                                    <li><a href=""><?php echo $row['name']; ?></a></li>
                                    <?php

                                }
                            ?>
                        </ul>
                    </div>
                    <div class="latest-products">
                        <h4>Latest Products</h4>
                        <?php

                        $result = get_latest_products();
                        while($row = $result->fetch_assoc()){
                            $images = get_images_product($row['id']);
                            $image_path = count($images) > 0 ? 'images/'.$images[0] : $default_path_image;
                            ?>
                            <div class="latest-product">
                                <a href="javascript:void(0);"><img src="<?php echo $image_path; ?>" width="50" class="float-end" alt=""></a>
                                <h5><a href="javascript:void(0);"><?php echo implode(' ', array_slice(explode(' ', $row['name']), 0, 2)); ?></a></h5>
                                <p><?php echo number_format($row['price'],2) . '$'; ?></p>
                            </div>

                            <?php
                        }

                        ?>


                    </div>
                </div>
            </div>
        </div>
    </section>
   <?php include('php/footer.php'); ?>
    <script src="js/shop.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    </body>
    </html>

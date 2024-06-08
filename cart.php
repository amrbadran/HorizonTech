    <?php include('php/header.php');?>
    <section class="branch-wlc">

        <div>
            <p class="w-100"><a class="link-page" href="">HOME</a> /  <span>CART</span></p>
            <h1 class="w-100">SHOPPING CART </h1>
        </div>
        <div class="overlay"></div>
    </section>

    <section class="shopping-cart-page pb-5">
        <div class="container">
            <h6 style="">There are <span id="no-items-in-cart">3</span> Items in Your Cart</h6>
            <div class="row">
                <div class="col-lg-9" id="containerProducts">

                </div>
                <div class="col-lg-3">
                    <div>
                        <h4>Summary</h4>
                        <p class="mt-2 mb-3">
                            <span >Subtotal</span> <span id="shopping-cart-subtotal">$60.00</span>
                        </p>

                        <p class="mt-2 mb-3">
                            <span >Taxes</span> <span >$3.00</span>
                        </p>
                        <p class='mt-1 pt-3 fw-bold' style="border-top:1px solid #343434;">
                            <span >Total</span> <span id="shopping-cart-total">$63.00</span>
                        </p>
                        <div class="button-checkout">
                            <button class="w-100" onclick="window.location.href='payment.php'">Check out</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include('php/footer.php') ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="js/cart.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
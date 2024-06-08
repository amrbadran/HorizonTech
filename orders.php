<?php
include ('php/header.php');
?>
<section class="branch-wlc">

    <div>
        <p class="w-100"><a class="link-page" href="">HOME</a>  /   <span>Order</span></p>
        <h1 class="w-100">ORDERS </h1>
    </div>
    <div class="overlay"></div>
</section>
<div class="container orders mt-3 mt-md-5">

  <div class="row">


      <?php
        include('php/functions/show_orders.php');
        $result = get_orders();

        while($row = $result->fetch_assoc()){
            ?>
      <div class="col-12">
          <div class="list-group mb-5">
              <div class="list-group-item p-3" style="position: relative;background:var(--main-color-low-opacity);border:none;">
                  <div class="row w-100 no-gutters">
                      <div class="col-6 col-md">
                          <h6 class="text-charcoal mb-0 w-100">Order Number</h6>
                          <p href="" class="text-pebble mb-0 w-100 mb-2 mb-md-0"><?php echo $row['order_id']; ?></p>
                      </div>
                      <div class="col-6 col-md">
                          <h6 class="text-charcoal mb-0 w-100">Date</h6>
                          <p class="text-pebble mb-0 w-100 mb-2 mb-md-0"><?php echo $row['date_order']; ?></p>
                      </div>
                      <div class="col-6 col-md">
                          <h6 class="text-charcoal mb-0 w-100">Total</h6>
                          <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">

                              <?php



                              ?>

                          </p>
                      </div>
                      <div class="col-6 col-md">
                          <h6 class="text-charcoal mb-0 w-100">Shipped To</h6>
                          <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">Late M. Night</p>
                      </div>

                  </div>

              </div>
              <div class="list-group-item p-3" style="">
                  <div class="row no-gutters">
                      <div class="col-12 col-md-9 pr-0 pr-md-3 mb-3">
                          <div class="alert p-2 alert-success w-100 mb-0" style="background:#222;box-shadow:3px 3px 10px #222;">
                              <h6 class="text-green mb-0"><b>Shipped</b></h6>
                              <p class="hidden-sm-down mb-0">Est. delivery between Aug 5 – Aug 9th, 2017</p>
                          </div>
                      </div>

                      <div class="row no-gutters mt-3">
                          <div class="col-3 col-md-1">
                              <img class="img-fluid pr-3" style="border-radius:50%;border:1px solid var(--main-color-low-opacity);" src="images/keyboards/2.jpg" alt="">
                          </div>
                          <div class="col-9 col-md-8 pr-0 pr-md-3">
                              <h6 class="text-charcoal mb-2 ">
                                  <a href="" class="text-charcoal">1 x URGE Basics iPhone 6/iPhone 6 Plus Magnetic Wallet Case</a>
                              </h6>
                              <h6 style="font-size:14px;color:#ddd;">Category : Keyboards</h6>
                              <h6 class="mb-0 mb-md-2" style="font-size:14px;color:#ddd;"><b>$19.54</b></h6>
                          </div>

                      </div>


                  </div>
              </div>
          </div>
      </div>
  </div>
            <?php
        }

      ?>





  </div>
</div>

<?php include('php/footer.php');?>
<script src="js/bootstrap.js"></script>
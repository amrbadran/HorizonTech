<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/font-awesome.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Horizon Tech</title>
    <style>


        .carousel-item{
            transition: transform .6s ease-in-out !important;
        }
        .carousel-indicators [data-bs-target]{
            transition: opacity .6s ease !important;
        }
    </style>
</head>
<body>
<header class="landing-header fixed-top">
    <nav class="navbar align-items-center navbar-expand-lg ">
        <div class="container">
            <a href="index.php" class="navbar-brand">HorizonTech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNav">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <div class="collapse navbar-collapse" id="collapseNav">
                <ul class="navbar-nav  ms-auto mt-2">
                    <li class="navbar-item"><a href="index.php#" class="navbar-link">Home</a></li>
                    <li class="navbar-item"><a href="index.php#section-services" class="navbar-link">Services</a></li>
                    <li class="navbar-item"><a href="index.php#section-products" class="navbar-link">Shop</a></li>
                    <li class="navbar-item"><a href="index.php#section-contact" class="navbar-link">Contact</a></li>
                    <li class="navbar-item ms-md-5 shopping-cart-icon"><a href="cart.php" class="navbar-link"><i class="fa fa-shopping-cart">
                                <span>0</span>
                            </i></a></li>
                    <?php
                    if(isset($_SESSION['username'])){
                        ?>
                        <li class="nav-item dropdown justify-content-center" style="margin-left:50px;bottom:5px;">
                            <button class="btn btn-dark dropdown-toggle" style="background-color:var(--second-color);" data-bs-toggle="dropdown" aria-expanded="">
                                <i class="fa fa-user-circle-o"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" style="background-color:var(--fourth-color);left:-50px;">
                                <li class="text-center">Hello, <?php echo $_SESSION['username'];?></a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="orders.php"><i class="fa fa-first-order" style="margin-right:5px;"></i>Orders</a></li>
                                <li><a class="dropdown-item" href="php/logout.php"><i class="fa fa-sign-out" style="margin-right:5px;"></i>Logout</a></li>

                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                </ul>


            </div>
        </div>
    </nav>
</header>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/Dashboard.css">
    <link rel="stylesheet"
          href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="./css/font-awesome.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .profile-img {
            height: 80px;
            width: 80px;
            display: inline-block;
            margin: 0 auto .5rem auto;
            border: 3px solid hsl(0, 0%, 9%);;
        }

        .profile-img img {
            height: 80px;
            width: 80px;
            border-radius: 50%;
            margin: 0 auto .5rem auto;
            background-color: white;
        }
    </style>


</head>
<body>
<input type="checkbox" id="menu-toggle">
<div class="sidebar">
    <div class="side-header">
        <h3>H<span>orizonTech</span></h3>
    </div>

    <div class="side-content">
        <div class="profile">
            <div class="profile-img">
                <img src="images/corporate-user-icon.png" alt="User Icon">
            </div>
            <?php
            session_start();
            if (isset($_SESSION['username'])) {
                echo "<h4>" . htmlspecialchars($_SESSION['username']) . "</h4>";
            }
            ?>
            <small>Admin</small>
        </div>

        <div class="side-menu">
            <ul>
                <li>
                    <a href="Dashboard.php" class="active">
                        <span class="las la-home"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                    <a href="Products.php">
                        <span><i class="fa fa-product-hunt" aria-hidden="true"></i></span>
                        <small>Products</small>
                    </a>
                </li>
                <li>
                    <a href="Category.php">
                        <span><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
                        <small>Categories</small>
                    </a>
                </li>
                <li>
                    <a href="Customers.php">
                        <span><i class="fa fa-users" aria-hidden="true"></i></span>
                        <small>Customers</small>
                    </a>
                </li>
                <li>
                    <a href="Order.php">
                        <span><i class="fa fa-list" aria-hidden="true"></i></span>
                        <small>Orders</small>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="main-content">

    <header>
        <div class="header-content">
            <label for="menu-toggle">
                <span class="las la-bars"></span>
            </label>

            <div class="header-menu">
                <label>
                    <span class="las la-search"></span>
                </label>

                <div class="notify-icon">
                    <span class="las la-envelope"></span>
                    <span class="notify">4</span>
                </div>

                <div class="notify-icon">
                    <span class="las la-bell"></span>
                    <span class="notify">3</span>
                </div>

                <div class="user">
                    <div class="bg-img" style="background-image: url(images/corporate-user-icon.png)"></div>
                    <a href="php/logout.php">
                        <span class="las la-power-off"></span>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </header>


    <main>

        <div class="page-header">
            <h1>Dashboard</h1>
            <small>Home / Dashboard</small>
        </div>

        <div class="page-content">

            <div class="analytics">

                <div class="card">
                    <div class="card-head">
                        <h2>107,200</h2>
                        <span class="las la-user-friends"></span>
                    </div>
                    <div class="card-progress">
                        <small>User activity this month</small>
                        <div class="card-indicator">
                            <div class="indicator one" style="width: 60%"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <h2>340,230</h2>
                        <span class="las la-eye"></span>
                    </div>
                    <div class="card-progress">
                        <small>Page views</small>
                        <div class="card-indicator">
                            <div class="indicator two" style="width: 80%"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <h2>$653,200</h2>
                        <span class="las la-shopping-cart"></span>
                    </div>
                    <div class="card-progress">
                        <small>Monthly revenue growth</small>
                        <div class="card-indicator">
                            <div class="indicator three" style="width: 65%"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <h2>47,500</h2>
                        <span class="las la-envelope"></span>
                    </div>
                    <div class="card-progress">
                        <small>New E-mails received</small>
                        <div class="card-indicator">
                            <div class="indicator four" style="width: 90%"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="chart-container">
                <canvas id="myChart"></canvas>
            </div>
        </div>

    </main>

</div>

<script>
    const xValues = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];

    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                borderColor: "red",
                fill: false
            }, {
                data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000],
                borderColor: "green",
                fill: false
            }, {
                data: [300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100],
                borderColor: "blue",
                fill: false
            }]
        },
        options: {
            legend: {display: false}
        }
    });
</script>

</body>
</html>
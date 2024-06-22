
<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    if ($username != "admin") {
        header("Location: index.php");
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Modern Admin Dashboard</title>
    <link rel="stylesheet" href="css/ProductCat.css">
    <link rel="stylesheet"
          href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="./css/font-awesome.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

        .page-header {
            background-color: hsl(0, 0%, 9%);;
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

            if (isset($_SESSION['username'])) {
                echo "<h4>" . htmlspecialchars($_SESSION['username']) . "</h4>";
            }
            ?>
            <small>Admin</small>
        </div>

        <div class="side-menu">
            <ul>
                <li>
                    <a href="Dashboard.php">
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
                    <a href="Orders.php" class="active">
                        <span><i class="fa fa-list" aria-hidden="true"></i></span>
                        <small>Orders</small>
                    </a>
                </li>


            </ul>
        </div>
    </div>
</div>

<div class="main-content">

    <header class="headed">
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
                    <div class="bg-img"></div>
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
            <small>Home / Customers</small>
        </div>

        <div class="page-content">

            <section class="section-contact">
                <div class="container">
                    <form method="post" action="Order.php" class="form-controler">
                        <input type="text" placeholder="Search" name="search_id" class="form-control"
                               style="width: 35%">
                        <input type="submit" name="submit" id="addProductbtn" value="Submit">
                        <label class="label5" for="addProductbtn" style="width: 35%; margin-left:10px ">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            Search
                        </label>
                    </form>
                </div>
            </section>

            <div>
                <table width="100%">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Completed</th>
                        <th>Date</th>
                        <th>Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include("php/config.php");
                    if (isset($_POST['submit'])) {
                        $search_id = $_POST['search_id'];

                        $sql = "SELECT * FROM orders WHERE id = '$search_id'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["usr_id"] . "</td>";
                                echo "<td>" . $row["is_complete"] . "</td>";
                                echo "<td>" . $row["date_order"] . "</td>";
                                echo "<td>" . $row["address"] . "</td>";
                                // Add more columns as needed
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>0 results</td></tr>";
                        }
                    } else {
                        $sql = "SELECT * FROM orders";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["usr_id"] . "</td>";
                                echo "<td>" . $row["is_complete"] . "</td>";
                                echo "<td>" . $row["date_order"] . "</td>";
                                echo "<td>" . $row["address"] . "</td>";
                                // Add more columns as needed
                                echo "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                    }
                    // Close the connection
                    $conn->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</div>
</body>
</html>
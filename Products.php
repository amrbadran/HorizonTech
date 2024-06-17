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
                    <a href="Dashboard.php" >
                        <span class="las la-home"></span>
                        <small>Dashboard</small>
                    </a>
                </li>
                <li>
                    <a href="products.php" class="active">
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
            <small>Home / Dashboard</small>
        </div>

        <div class="page-content">

            <section class="section-contact">
                <div class="container">
                    <form action="" class="form-controler">
                        <div class="form-group mt-2 d-flex">
                            <input type="text" placeholder="ID" class="form-control">
                            <input type="email" placeholder="Name" class="form-control">
                            <input type="email" placeholder="Category" class="form-control">
                            <input type="email" placeholder="Manufacturer" class="form-control">
                            <input type="email" placeholder="Price" class="form-control">
                            <input type="email" placeholder="Description" class="form-control">
                            <div class="uploadfile">
                                <div>
                                    <input type="file" id="btn">
                                    <label class="label5" for="btn">
                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                        Upload Image
                                    </label>
                                </div>
                                <div>
                                    <button id="addProductbtn"></button>
                                    <label class="label5" for="addProductbtn">
                                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                        Add Product
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <div>
                <table width="100%">
                    <thead>
                    <tr>
                        <th> ID</th>
                        <th> Name</th>
                        <th> Price</th>
                        <th> Manufacturer</th>
                        <th> Category ID</th>
                        <th> Added Date </th>
                        <th> Tag </th>
                        <th> quantity </th>
                        <th> quantity available </th>
                        <th> Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include ("php/config.php");
                    $sql = "SELECT * FROM product";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                            echo "<td>" . $row["manufacturer"] . "</td>";
                            echo "<td>" . $row["cat_id"] . "</td>";
                            echo "<td>" . $row["date_added"] . "</td>";
                            echo "<td>" . $row["tag"] . "</td>";
                            echo "<td>" . $row["quantity"] . "</td>";
                            echo "<td>" . $row["quantity_aval"] . "</td>";
                            echo '<td>
                                    <div class="actions">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </div>
                                   </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
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
<?php
session_start();
include("php/config.php");

// Function to validate input
function validateInput($data, $type, $fieldName) {
    // Implement validation logic as needed
    return $data; // For this example, simply return the data
}

if (isset($_POST['submit'])) {
    // Validate input
    $name = validateInput($_POST['name'], 'string', 'Name');
    $description = validateInput($_POST['description'], 'string', 'Description');

    // Insert into the category table
    $sql = "INSERT INTO category (name, description) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);

    // Check for errors in preparing the statement
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ss", $name, $description);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Dashboard</title>
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

        .actions .fa-trash:hover {
            color: red;
        !important;
        }

        .actions .fa-pencil:hover {
            color: blue;
        !important;
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
                    <a href="Category.php" class="active">
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
                    <form action="Category.php" method="post" class="form-controler">
                        <div class="form-group mt-2 d-flex">
                            <input type="text" name="name"placeholder="Name" class="form-control"required>
                            <input type="text" name="description" placeholder="Description" class="form-control" required>
                            <input type="submit" name="submit" id="addProductbtn" value="Submit">
                            <label class="label5" for="addProductbtn">
                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                Add Category
                            </label>
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
                        <th> Description</th>
                        <th> Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include ("php/config.php");
                    if (isset($_GET['id'])) {
                        // Sanitize the 'id' parameter to prevent SQL injection
                        $id = intval($_GET['id']);

                        // Prepare SQL statement to delete the row with the specified id
                        $sql = "DELETE FROM category WHERE id = ?";

                        // Prepare the statement
                        $stmt = $conn->prepare($sql);

                        // Bind the parameter
                        $stmt->bind_param("i", $id);

                        // Execute the statement
                        if ($stmt->execute()) {
                            echo "Category deleted successfully.";
                        } else {
                            echo "Error deleting record: " . $conn->error;
                        }

                        // Close the statement
                        $stmt->close();
                    }

                    $sql = "SELECT * FROM category";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo '<td>
                                    <div class="actions">
                                        <a href="Category.php?id=' . $row["id"] . '">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <a href="Category.php?id=' . $row["id"] . '">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                   </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }
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
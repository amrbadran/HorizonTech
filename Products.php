<?php
session_start();
include("php/config.php");

$errors = []; // Array to store validation errors

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Validate each input
    $name = validateInput($_POST['name'], 'string', 'Name');
    $price = validateInput($_POST['price'], 'double', 'Price');
    $manufacturer = validateInput($_POST['manufacturer'], 'string', 'Manufacturer');
    $description = validateInput($_POST['description'], 'string', 'Description');
    $category = validateInput($_POST['category'], 'string', 'Category', true); // Allow NULL
    $tag = validateInput($_POST['tag'], 'string', 'Tag');
    $quantity = validateInput($_POST['quantity'], 'integer', 'Quantity');
    $quantityA = validateInput($_POST['quantityA'], 'integer', 'Quantity Available');
    $totalFiles = count($_FILES['fileImg']['name']);
    $files = array();

    for ($i = 0; $i < $totalFiles; $i++) {
        $imageName = $_FILES['fileImg']['name'][$i];
        $tempName = $_FILES['fileImg']['tmp_name'][$i];
        $imageExtension = explode('.', $imageName);
        $imageExtension = strtolower(end($imageExtension));
        $newImageName = uniqid() . '.' . $imageExtension;

        // Move the uploaded file to the 'images' directory
        if (move_uploaded_file($tempName, 'images/' . $newImageName)) {
            // Add the new image name to the files array
            $files[] = $newImageName;
        } else {
            echo "Failed to upload file: " . $imageName . "<br>";
        }
    }

    $query = "SELECT MAX(id) AS last_id FROM product";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_product_id = $row['last_id'];
    }

    for ($i = 0; $i < $totalFiles; $i++) {
        // Escape the file path to ensure it's safe for use in the SQL query
        $fileEscaped = $conn->real_escape_string($files[$i]);

        // Construct the query with proper quoting
        $query = "INSERT INTO images_product (path, product_id) VALUES ('$fileEscaped', '$last_product_id')";

        // Execute the query
        if ($conn->query($query) === TRUE) {
            echo "Record inserted successfully for file: " . $files[$i] . "<br>";
        } else {
            echo "Error inserting record for file: " . $files[$i] . " - " . $conn->error . "<br>";
        }
    }

    // Check if there are validation errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } else {
        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO product (name, price, manufacturer, description, cat_id, tag, quantity, quantity_aval)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters to the placeholders
        $stmt->bind_param("sdssssii", $name, $price, $manufacturer, $description, $category, $tag, $quantity, $quantityA);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record inserted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}


// Function to validate input
function validateInput($value, $type, $fieldName, $allowNull = false)
{
    if ($allowNull && empty($value)) {
        return null; // Return null if value is empty and allowNull is true
    }

    if ($type === 'string') {
        $validated = trim($value); // Trim whitespace
        if (empty($validated)) {
            global $errors;
            $errors[] = "$fieldName is required.";
        }
        return $validated;
    } elseif ($type === 'integer') {
        $validated = filter_var($value, FILTER_VALIDATE_INT);
        if ($validated === false) {
            global $errors;
            $errors[] = "$fieldName must be a valid integer.";
        }
        return $validated;
    } elseif ($type === 'double') {
        $validated = filter_var($value, FILTER_VALIDATE_FLOAT);
        if ($validated === false) {
            global $errors;
            $errors[] = "$fieldName must be a valid number.";
        }
        return $validated;
    } else {
        // Handle other types if necessary
        return $value;
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
            <small>Home / Products</small>
        </div>

        <div class="page-content">

            <section class="section-contact">
                <div class="container">
                    <form method="post" enctype="multipart/form-data" action="Products.php" class="form-controler">
                        <div class="form-group mt-2 d-flex">
                            <input type="text" placeholder="Name" name="name" class="form-control" required>
                            <input type="number" placeholder="Price" name="price" class="form-control" required>
                            <input type="text" placeholder="Category" name="category" class="form-control" required>
                            <input type="text" placeholder="Manufacturer" name="manufacturer" class="form-control"
                                   required>
                            <input type="text" placeholder="Tag" name="tag" class="form-control" required>
                            <input type="number" placeholder="Quantity" name="quantity" class="form-control" required>
                            <input type="number" placeholder="Quantity Available" name="quantityA" class="form-control"
                                   required>
                            <input type="text" placeholder="Description" name="description"
                                   class="form-control description" required>
                            <div class="uploadfile">
                                <div>
                                    <input type="file" id="btn" name="fileImg[]" required multiple
                                           accept=".jpg,.jpeg,.png">
                                    <label class="label5" for="btn">
                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                        Upload Image
                                    </label>
                                </div>
                                <div>

                                    <input type="submit" name="submit" id="addProductbtn" value="Submit">
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
                        <th> Added Date</th>
                        <th> Tag</th>
                        <th> quantity</th>
                        <th> quantity available</th>
                        <th> Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_GET['id'])) {
                        // Sanitize the 'id' parameter to prevent SQL injection
                        $id = intval($_GET['id']);

                        // Prepare SQL statement to delete the row with the specified id
                        $sql = "DELETE FROM product WHERE id = ?";

                        // Prepare the statement
                        $stmt = $conn->prepare($sql);

                        // Bind the parameter
                        $stmt->bind_param("i", $id);

                        // Execute the statement
                        if ($stmt->execute()) {
                            echo "Product deleted successfully.";
                        } else {
                            echo "Error deleting record: " . $conn->error;
                        }

                        // Close the statement
                        $stmt->close();
                    }


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
                                        <a href="Products.php?id=' . $row["id"] . '">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <a href="Products.php?id=' . $row["id"] . '">
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
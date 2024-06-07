<?php
    $path_config = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/config.php';
    $path_ajax = $_SERVER['DOCUMENT_ROOT'] . '/HorizonTech/php/ajax/';
    include(  $path_config);
    include($path_ajax . "ajax_filter_price.php");

    function select_sort(){

        if(isset($_POST['select_sort'])){
            $x =$_POST['select_sort'];
            if($x == 'l'){
                return " ORDER BY date_added DESC";
            }
            else if($x == 'lh'){
                return " ORDER BY price ASC";
            }
            else if($x == 'hl'){
                return " ORDER BY price DESC";
            }
            return "";

        }
    }
    function show_products()
    {
        global $conn;
        global $total_results;
        global $result;
        global $total_pages;
        $results_per_page = 9;

        $sql = "SELECT COUNT(id) AS total FROM product WHERE name LIKE ?".select_sort();
        $price = 0;
        $search = isset($_GET['search']) ? $_GET['search'] : "";
        $name_match = "%" . $search .  "%";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $name_match);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $total_results = $row['total'];
        $stmt->close();
        $total_pages = ceil($total_results / $results_per_page);


        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        if ($page > $total_pages) $page = $total_pages;

        $start_from = ($page - 1) * $results_per_page;

        $sql = "SELECT * FROM product WHERE name LIKE ?".select_sort()." LIMIT ?,?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $name_match,$start_from,$results_per_page);
        $stmt->execute();
        $result = $stmt->get_result();

    }

    function get_images_product($id){
       $sql = "SELECT * FROM images_product WHERE product_id = $id";
       global $conn;
       $result = $conn->query($sql);
       $images = array();
       if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $images[] = $row['path'];
            }
        }
       return $images;
    }

    function get_latest_products(){
        $sql = "SELECT * FROM product ORDER BY date_added DESC LIMIT 6";
        global $conn;
        $result = $conn->query($sql);
        return $result;

    }



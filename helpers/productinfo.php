<?php

header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json; charset=utf-8");

include "db_connect.php";

// Return a single product info if product id is specified
if(isset($_REQUEST['productid']) && $_REQUEST['productid'] != "") {

    $productid = trim_input($_REQUEST['productid']);
    // Check for valid product
    $sql = "SELECT * FROM products WHERE product_id ='{$productid}'";
    $result = $conn->query($sql);

    // Check if exactly 1 result exist
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Split the images string into arrays
        // This is needed because retarded mysql cannot store as array
        $row["product_images"] =  explode(" ", $row["product_images"]);
        echo json_encode($row);
        
    }
    else {
        header("HTTP/1.1 404 Invalid Product ID");
        die();
    }
}
else {
    header("HTTP/1.1 404 Product ID not specified");
    die();
}

function trim_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

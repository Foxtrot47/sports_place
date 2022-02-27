<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Credentials: true');
session_start();

$subcat_array = [];
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!isset($_POST["seller_session_token"]) ) {
    header("HTTP/1.1 403 Session Token Missing");
    die();
  }
  $session_token = $_POST["seller_session_token"];

  if (!isset($_POST['mode'])) {
    header("HTTP/1.1 404 Mode Not Specified");
    die();
  }
  $mode = trim_input($_POST['mode']);
  
  $fetch_data = $conn->query(
    "SELECT * FROM sellers WHERE session_token='". $session_token . "'"
  );
  if($fetch_data == false && $fetch_data->num_rows < 1){
    header("HTTP/1.1 403 Session Token Invalid");
    die();
  }
  $seller_data = $fetch_data->fetch_assoc();

  if ($mode == "list_cat") {
      if(isset($_POST['product_maain_category']) && $_POST['product_maain_category'] > 0 ) {
        $category_query_result = $conn->query(
          "SELECT subcatid,catname,subcatname FROM subcategories WHERE catname='" . $_POST['product_maain_category'] . "'"
        );
      }
      else {
      $category_query_result = $conn->query(
        "SELECT catid,catname FROM categories"
      );
    }
      
      while ($category_list = $category_query_result->fetch_assoc()) {
        $cat_array[] = $category_list;
      }
      header("Content-Type: application/json; charset=utf-8");
      echo json_encode($cat_array);
  } 
  elseif ($mode == "list") {

    $listings_query =
      "SELECT product_id,product_main_image,product_full_name,product_price,".
      "product_main_category,product_sub_category," .
      'product_quantity,product_rating FROM products WHERE product_seller_name="' .
      $seller_data["first_name"] . " " .
      $seller_data["last_name"] .'"'.
      " ORDER BY " . $_POST['sort_by'] . ' ' . $_POST['sort_order'];
      
    $listings_query_result = $conn->query($listings_query);
    if ($listings_query_result == false) {
      echo "No Products found";
      die();
    }
    while ($listings = $listings_query_result->fetch_assoc()) {
      $listings_array[] = $listings;
    }

    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($listings_array);
  } 
  elseif ($mode == "view") {

    if($_POST["product_id"] < 1) {
      header("HTTP/1.1 404 Product ID Missing");
      die();
    }

    $product_id = trim_input($_POST["product_id"]);

    $check_q = "SELECT * FROM products  WHERE product_id=" . $product_id;
    $result = $conn->query($check_q);
    if ($result != false && $result->num_rows > 0) {
      while ($products_list = $result->fetch_assoc()) {
        $products_arr[] = $products_list;
      }
      header("Content-Type: application/json; charset=utf-8");
      echo json_encode($products_arr);
    }
    else {
      header("HTTP/1.1 404 Product Not found");
    }
  }
  else if ($mode == "add") {

    $listing_cat = trim_input($_POST["listing_cat"]);
    $listing_subcat = trim_input($_POST["listing_subcat"]);
    $listing_main_image_url = trim_input($_POST["listing_main_image_url"]);
    $listing_images_urls = trim_input($_POST["listing_images_urls"]);
    $listing_feature_url = trim_input($_POST["listing_feature_url"]);
    $listing_price = trim_input($_POST["listing_price"]);
    $listing_status = trim_input($_POST["listing_status"]);
    $listing_model_name = trim_input($_POST["listing_model_name"]);
    $listing_size = trim_input($_POST["listing_size"]);
    $listing_color = trim_input($_POST["listing_color"]);
    $listing_fitfor = trim_input($_POST["listing_for"]);

    $check_q =
        "SELECT * FROM cart  WHERE product_full_name=" . $listing_model_name;
    $result = $conn->query($check_q);
    if ($result == false || $result->num_rows < 1) {
        $add_q =
            "INSERT INTO products ( product_full_name, product_main_category , product_sub_category, product_price,";
        $add_q .=
            "product_seller_name , product_main_image , product_images , product_features , product_quantity) ";
        $add_q .=
            'VALUES ( "' .
            $listing_model_name .
            '",' .
            $listing_cat_id .
            "," .
            $listing_subcat_id .
            "," .
            $listing_price .
            ",";
        $add_q .=
            $_SESSION["first_name"] .
            $_SESSION["last_name"] .
            ', "' .
            $listing_main_image_url .
            '" , "' .
            $listing_images_urls;
        $add_q .= '" , "' . $listing_feature_url . '",' . ", 69  )";
        $result = $conn->query($add_q);
    } elseif (result != false || $result->num_rows > 0) {
        $update_q =
            "UPDATE products SET product_full_name=" .
            $listing_model_name .
            " , product_main_category=" .
            $listing_cat .
            ",product_sub_category, product_price,";
        $update_q .=
            "product_seller_name , product_main_image , product_images , product_features , product_quantity) ";
        $update_q .=
            "VALUES (" .
            $listing_cat_id .
            "," .
            $listing_subcat_id .
            "," .
            $listing_price .
            ",";
        $update_q .=
            $_SESSION["first_name"] .
            $_SESSION["last_name"] .
            ', "' .
            $listing_main_image_url .
            '" , "' .
            $listing_images_urls;
        $update_q .= '" , "' . $listing_feature_url . '",' . ", 69  )";
        $result = $conn->query($update_q);
    }
  }
  elseif ($mode == "delete" && $_POST["product_id"] > 0) {

    $product_id = trim_input($_POST["product_id"]);

    $delete_q =
      "DELETE FROM products WHERE product_id=" .
      $product_id .
      ' AND product_seller_name="' .
      $seller_data["first_name"] .
      " " .
      $seller_data["last_name"] .
      '"';
    $result = $conn->query($delete_q);

    if ($result != false) {
      header("HTTP/1.1 200 Listing Removed");
    } else {
      header("HTTP/1.1 404 Product Not found or It was listed by someone else");
    }
  }
}
// function to trim useless contents from data
function trim_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

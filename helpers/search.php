<?php

header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json; charset=utf-8");

include "db_connect.php";

$cat_id = $subcat_id = $sortby = $sort_col = $filter_q = $page_no = $sort_q = $search_keyword = null;

// Forming SQL query for searching
$base_q = "SELECT product_id , product_full_name , product_price , product_main_image , product_seller_name , product_rating FROM products ";
$filter_q = null;

// Find the subcategory from subcategory ID
if (isset($_REQUEST["subcatid"]) && $_REQUEST["subcatid"] > 0) {
    $subcat_id = trim_input($_REQUEST["subcatid"]);

    // Verifying for valid sucat id
    $sql = "SELECT * FROM subcategories WHERE subcatid ='{$subcat_id}'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        addFilter("product_sub_category", $subcat_id, "equals");
    }
    else {
        header("HTTP/1.1 404 Invalid SubCategory ID");
        die();
    }
}
// Find the category from category ID
else if (isset($_REQUEST["catid"]) && $_REQUEST["catid"] > 0) {
    $cat_id = trim_input($_REQUEST["catid"]);
    $sql = "SELECT * FROM categories WHERE catid ='{$cat_id}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        addFilter("product_main_category", $cat_id, "equals");
    }
    else {
        header("HTTP/1.1 404 Invalid Category ID");
        die();
    }
}
// Get Search keyword , page no and sort values if exist
if (isset($_REQUEST["product_name"]) && $_REQUEST["product_name"] != "") {
    addFilter(
        "product_full_name",
        trim_input($_REQUEST["product_name"]),
        "like"
    );
}
if (isset($_REQUEST["page_no"]) && $_REQUEST["page_no"] > 0) {
    $page_no = trim_input($_REQUEST["page_no"]);
}
if (isset($_REQUEST["sortby"]) && $_REQUEST["sortby"] != "") {
    $sortby = trim_input($_GET["sortby"]);
}

// Calculate Min Price Limit Disregarding user filter
$min_limit_q = "SELECT MIN(product_price) FROM products" . $filter_q;
$limit_list = $conn->query($min_limit_q);
if ($limit_list->num_rows > 0) {
    while ($row = $limit_list->fetch_assoc()) {
        $default_min_limit = $row["MIN(product_price)"];
        if (empty($_GET["min_limit"]) == true) {
            $min_limit = $default_min_limit;
        }
    }
}
// Calculate Max Price Limit Disregarding user filter
$max_limit_q = "SELECT MAX(product_price) FROM products" . $filter_q;
$limit_list = $conn->query($max_limit_q);
if ($limit_list->num_rows > 0) {
    while ($row = $limit_list->fetch_assoc()) {
        $default_max_limit = $row["MAX(product_price)"];
        if (empty($_GET["max_limit"]) == true) {
            $max_limit = $default_max_limit;
        }
    }
}

// No need to seperate max limit check cuz it will be auto submitted as max price of current result
if (isset($_REQUEST["min_limit"]) && $_REQUEST["min_limit"] > 0 ) {
    $min_limit = trim_input($_GET["min_limit"]);
    $max_limit = trim_input($_GET["max_limit"]);
    addFilter("product_price", $min_limit, "range");
    addFilter("product_price", $max_limit, "range_end");
}

function addFilter($filter, $filter_val, $filter_type)
{
    $first_filter = false;
    if (empty($filter_val) == true) {
        return;
    }
    if (is_null($GLOBALS["filter_q"])) {
        $GLOBALS["filter_q"] = " WHERE ";
        $first_filter = true;
    }
    if ($first_filter == false) {
        $GLOBALS["filter_q"] = "{$GLOBALS["filter_q"]} AND ";
    }
    if ($filter_type == "equals") {
        $GLOBALS["filter_q"] =
            "{$GLOBALS["filter_q"]} {$filter} = {$filter_val}";
    } elseif ($filter_type == "like") {
        $GLOBALS["filter_q"] =
            "{$GLOBALS['filter_q']} {$filter} LIKE  '%{$filter_val}%'";
    } elseif ($filter_type == "range") {
        $GLOBALS["filter_q"] =
            "{$GLOBALS["filter_q"]} {$filter} BETWEEN {$filter_val}";
    } else {
        // This is only used for setting 2nd range with BETWEEN AND
        $GLOBALS["filter_q"] = "{$GLOBALS["filter_q"]}  {$filter_val}";
    }
}

// any sort by the user may have choosen
if (!is_null($sortby)) {
    switch ($sortby) {
        case "price_h_l":
            $sort_col = "product_price";
            $sort_order = "DESC";
            break;
        case "price_l_h":
            $sort_col = "product_price";
            $sort_order = "ASC";
            break;
        case "rating":
            $sort_col = "product_rating";
            $sort_order = "DESC";
            break;
        default:
            $sort_col = null;
    }
}
if (!is_null($sort_col)) {
    $sort_q = " ORDER BY  {$sort_col}  {$sort_order} ";
}

// If page no is specified calculate offset = 20 x page no
// Else just limit results by 20
// Page no is basically used for spliting our results into multiple and is show wen you press next or prev buttons
if (!is_null($page_no)) {
    $offset = $page_no * 20 - 1;
    $limit_q = " LIMIT {$offset},20";
} else {
    $limit_q = " LIMIT 20";
}

if ($filter_q == null) {
    header("HTTP/1.1 404 Must provide some criteria");
    die();
}

$final_q = $base_q . $filter_q . $sort_q . $limit_q;
$q_res = $conn->query($final_q);

if($q_res->num_rows <= 0) {
    header("HTTP/1.1 404 No results");
    die();
}
while ($product = $q_res->fetch_assoc()) {
    $products_list[] = $product;
}

// Encoding as object so we can parse with JS
class result {
    public $product_list;
    public $max_limit;
    public $min_limit;
}
$output = new result();
$output->product_list = $products_list;
$output->min_limit = $default_min_limit;
$output->max_limit = $default_max_limit;

echo json_encode($output);
die();

function trim_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

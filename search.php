<?php

include "helpers/db_connect.php";
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
echo '<link rel="stylesheet" href="css/nouislider.css" />';
echo '<script src="js/nouislider.js"></script>';
$cat_id = $subcat_id = $sortby = $sort_col = $filter_q = $page_no = $sort_q = $search_keyword = null;
include "Navbar.php";

// Forming SQL query for searching
$base_q = "SELECT * FROM products ";
$filter_q = null;

// function to trim useless contents from form data
function trim_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (array_key_exists("catid", $_GET) && $_GET["catid"] > 0) {
        $cat_id = trim_input($_GET["catid"]);

        // Find the category from category ID
        $sql = "SELECT * FROM categories WHERE catid =" . $cat_id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($cat_row = $result->fetch_assoc()) {
                $cat_name = $cat_row["catname"];
                addFilter("product_main_category", $cat_name, "equals");
            }
        }
        // Find the subcategory from subcategory ID
        if (array_key_exists("subcatid", $_GET) && $_GET["subcatid"] > 0) {
            $subcat_id = trim_input($_GET["subcatid"]);
            $sql = "SELECT * FROM subcategories WHERE subcatid =" . $subcat_id;
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                while ($sub_row = $result->fetch_assoc()) {
                    $subcat_name = $sub_row["subcatname"];
                    addFilter("product_sub_category", $subcat_name, "equals");
                }
            }
        }
    }
    // Get Search keyword , page no and sort values if exist
    if (array_key_exists("product_name", $_GET)) {
        addFilter(
            "product_full_name",
            trim_input($_GET["product_name"]),
            "like"
        );
    }
    if (array_key_exists("page_no", $_GET)) {
        $page_no = trim_input($_GET["page_no"]);
    }
    if (array_key_exists("sortby", $_GET)) {
        $sortby = trim_input($_GET["sortby"]);
    }
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
if (isset($_GET["min_limit"])) {
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
        $GLOBALS["filter_q"] = $GLOBALS["filter_q"] . " AND ";
    }
    if ($filter_type == "equals") {
        $GLOBALS["filter_q"] =
            $GLOBALS["filter_q"] . $filter . "=" . "\"" . $filter_val . "\"";
    } elseif ($filter_type == "like") {
        $GLOBALS["filter_q"] =
            $GLOBALS["filter_q"] . $filter . ' LIKE  \'%' . $filter_val . '%\'';
    } elseif ($filter_type == "range") {
        $GLOBALS["filter_q"] =
            $GLOBALS["filter_q"] . $filter . " BETWEEN " . $filter_val;
    } else {
        // This is only used for setting 2nd range with BETWEEN AND
        $GLOBALS["filter_q"] = $GLOBALS["filter_q"] . $filter_val;
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
    $sort_q = " ORDER BY " . $sort_col . " " . $sort_order . " ";
}

// If page no is specified calculate offset = 20 x page no
// Else just limit results by 20
// Page no is basically used for spliting our results into multiple and is show wen you press next or prev buttons
if (!is_null($page_no)) {
    $offset = $page_no * 20 - 1;
    $limit_q = " LIMIT " . $offset . ", 20";
} else {
    $limit_q = " LIMIT 20";
}

$final_q = $base_q . $filter_q . $sort_q . $limit_q . ";";
$products_list = $conn->query($final_q);
?>
<div class="flex row">

    <div class="w-80 p-4 flex-none">
        <form name='filters' id="filters" action="<?php echo htmlspecialchars(
            $_SERVER["PHP_SELF"]
        ); ?>">
            <div class="pb-3">

                <!-- Hidden input field to hold the value for Category and Sub category -->
                <input type='number' class='hidden' name="catid" value="<?php echo !is_null(
                    $cat_id
                )
                    ? $cat_id
                    : "0"; ?>" />
                <input type='number' class='hidden' name='subcatid' value="<?php echo !is_null(
                    $subcat_id
                )
                    ? $subcat_id
                    : "0"; ?>" />
                
                    <?php if (!is_null($cat_id)) {
                        echo '<button type="button" onclick="updatefilter(`subcatid`, 0)" class="font-bold text-xl">';
                        echo $cat_name;
                    } else {
                        echo '<button type="button" class="font-bold text-xl">';
                        echo "Categories";
                    } ?>
                </button>
                <span class='font-bold text-xl'>
                <?php if (!is_null($subcat_id)) {
                    echo "/ ";
                    echo $subcat_name;
                } ?>
                </span> <br />
                        <?php if (!is_null($cat_id) && is_null($subcat_id)) {
                            $rows_q =
                                "SELECT * FROM subcategories WHERE catid=" .
                                $cat_id;
                            $subcat_list = $conn->query($rows_q);
                            if ($subcat_list->num_rows > 0) {
                                while ($row = $subcat_list->fetch_assoc()) {
                                    echo '<button type="button" onclick=updatefilter("subcatid",' .
                                        $row["subcatid"] .
                                        ")>";
                                    echo '<span class="pl-4 font-lg">';
                                    echo $row["subcatname"];
                                    echo "</button>";
                                    echo "</span>";
                                    echo "<br>";
                                }
                            }
                        } elseif (is_null($cat_id)) {
                            $rows_q = "SELECT * FROM categories";
                            $cat_list = $conn->query($rows_q);
                            if ($cat_list->num_rows > 0) {
                                while ($row = $cat_list->fetch_assoc()) {
                                    echo '<span class="pl-4 font-lg">';
                                    echo '<button type="button" onclick="updatefilter( `catid` , ' .
                                        $row["catid"] .
                                        ' )" >';
                                    echo $row["catname"];
                                    echo "</button>";
                                    echo "</span>";
                                    echo "<br>";
                                }
                            }
                        } ?>
                <hr class="mt-4 border border-gray-200 w-full">
            </div>

            <div class="flex flex-col">
                <div>
                    <button 
                        type="button" 
                        class="w-full text-xl font-semibold text-left border-none accordion pb-2"
                    >
                        Sort By
                    </button>
                    <div class="panel">
                        <input 
                            type="radio" 
                            id="price_h_l_b" 
                            name="sortby" 
                            value="price_h_l" 
                            <?php if ($sortby == "price_h_l") {
                                echo "checked";
                            } ?> 
                            class='inline rounded'
                            onchange="this.form.submit();"
                        />
                        <label 
                            for="price_h_l_b"
                        >
                            Price (High to Low)
                        </label> 
                        <br/>
                        <input type="radio" id="price_l_h_b" name="sortby" value="price_l_h" <?php if (
                            $sortby == "price_l_h"
                        ) {
                            echo "checked";
                        } ?> class='inline' onchange="this.form.submit();"/>
                        <label for="price_l_h_b">Price (High to Low)</label><br>
                        <input type="radio" id="rating_b" name="sortby" value="rating" <?php if (
                            $sortby == "rating"
                        ) {
                            echo "checked";
                        } ?> class='inline' onchange="this.form.submit();"/>
                        <label for="rating_b">Rating</label>
                    </div>
                    <hr class="mt-4 border border-gray-200 w-full">
                </div>
                <div>
                    <button 
                        type="button" 
                        class="w-full text-xl font-semibold text-left border-none accordion pb-2"
                    >
                        Price
                    </button>
                    <div class="panel">
                        <div class="mt-6 mb-2" id="price_range"></div>
                        <div class="flex flex-row w-full justify-between">
                            <input 
                                type='text' 
                                name='min_limit' 
                                value="<?php echo isset($min_limit)
                                    ? $min_limit
                                    : ""; ?>" 
                                class="text-black w-10 border-none focus:outline-none" 
                                readonly 
                            />
                            <input 
                                type='text' 
                                name='max_limit' 
                                value="<?php echo isset($max_limit)
                                    ? $max_limit
                                    : ""; ?>" 
                                class="text-black w-10 border-none focus:outline-none" 
                                readonly 
                            />
                        </div>
                    </div>
                    <hr class="mt-4 border border-gray-200 w-full">
                </div>
            </div>
        </form>
    </div>
    <div class='py-2 pr-2 w-full'>
        <p class='text-4xl pl-2 pt-3 pb-2'>
            <?php echo is_null($cat_id) ? "Search" : $cat_name; ?>
        </p>
        <hr class='border-gray-200 w-full'>

        <div class="grid grid-cols-4 gap-4 pt-2">
            <?php if ($products_list->num_rows > 0) {
                while ($row = $products_list->fetch_assoc()) { ?>
                        <div 
                            class='w-full' 
                            onclick=location.href="product.php?productid=<?php echo $row[
                                "product_id"
                            ]; ?>"
                        >
                            <img src="<?php echo $row[
                                "product_main_image"
                            ]; ?>">
                            <div class="pt-5">
                                <p 
                                    class='text-md font-semibold block hover:text-blue-500'
                                >
                                    <?php echo $row["product_full_name"]; ?>
                                </p>
                                <?php
                                for (
                                    $i = 0;
                                    $i < $row["product_rating"];
                                    $i++
                                ) {
                                    echo '<span class="fa fa-star text-blue-500"></span>';
                                }
                                for (
                                    $i = $row["product_rating"];
                                    $i < 5;
                                    $i++
                                ) {
                                    echo '<span class="fa fa-star"></span>';
                                }
                                ?>
                                <p class="text-xl">$<?php echo $row[
                                    "product_price"
                                ]; ?></p>
                            </div>
                    </div> 
            <?php }
            } ?>
        </div>

    </div>



</div>
<script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                /* Toggle between adding and removing the "active" class,
                to highlight the button that controls the panel */
                this.classList.toggle("active");

                /* Toggle between hiding and showing the active panel */
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
                } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }

        // Creating Price Slider
        var price_slider = document.getElementById('price_range');

        noUiSlider.create(price_slider, {
        start: [<?php echo $min_limit; ?>,<?php echo $max_limit; ?>],
        connect: [false,true,false],
        range: {
            'min': [<?php echo $default_min_limit; ?>],
            'max': [<?php echo $default_max_limit; ?>]
        }
    });

    function updatefilter(filter, val) {
        document.getElementsByName(filter)[0].value = val;
        document.getElementById('filters').submit();
    }
    function updateLimits (values) {
        document.getElementsByName('min_limit')[0].value = values[0];
        document.getElementsByName('max_limit')[0].value = values[1];
        document.getElementById('filters').submit();
    }
    price_slider.noUiSlider.on('set',updateLimits);

</script>

<style>
.accordion {
    transition: 0.4s;
}
.panel {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.1s ease-out;
}
.accordion:after {
  content: '\2b'; /* Unicode character for "plus" sign (+) */
  font-size: 36px;
  color: #777;
  float: right;
  margin-left: 5px;
}
.active:after {
  content: "\2796"; /* Unicode character for "minus" sign (-) */
  font-size:12px;
}
.noUi-target {
    height: 10px;
    border-radius: 99999px;
}
.noUi-handle {
    --tw-bg-opacity: 1;
    background-color: rgba(255, 255, 255, var(--tw-bg-opacity));
    width: 24px !important;
    height: 24px !important;
    top: -8px !important;
    border-radius: 9999px;
    --tw-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
}
.noUi-handle:after {
    display: none;
}
.noUi-handle:before {
    display: none;
}
.noUi-connect {
    --tw-bg-opacity: 1;
background-color: rgba(37, 99, 235, var(--tw-bg-opacity));
}
.noUi-touch-area	
{
    display:none;
}
</style>
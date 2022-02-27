<!doctype html>
<html lang="en">
    <head>
        <title>New Listing | The Sports Place</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        session_start();
        include "style.php";
        include "helpers/db_connect.php";

        $listing_cat_id = $listing_subcat_id = 0;
        $cat_array = $subcat_array = [];

        $category_query_result = $conn->query("SELECT * FROM categories");
        while ($category_list = $category_query_result->fetch_assoc()) {
            $cat_array[] = $category_list;
        }
        ?>
    </head>
    <body class="bg-background overflow-hidden font-roboto">
        <form method="post" action="<?php echo htmlspecialchars(
            $_SERVER["PHP_SELF"]
        ); ?>" name="listing_form" id="listing_form">

            <!-- Space for putting invisible input fields-->
            <input type="number" name="listing_cat_id" id="listing_cat_id" class="hidden"/>
            <input type="number" name="listing_subcat_id" id="listing_subcat_id" class="hidden"/>

            <div class="flex flex-col h-screen">

                <div class="flex-none w-full flex flex-col px-10 py-2 section bg-surface text-on-surface">
                    <div>
                        <span class="text-tertiary pr-1">My Listings</span>
                        &gt;
                        <span class="text-tertiary pr-1">New Listing</span>
                    </div>
                    <div class="pt-2 pb-4">
                        <p class="md-headline-large text-primary">Add a new Listing</p>
                    </div>
                </div>

                <!-- Side Nav Start -->
                <div class="flex flex-row mt-1 h-full">
                    <div class="w-3/12 section px-5 py-4  mr-2 h-full flex flex-col gap-y-6 bg-surface
                                text-on-surface-variant rounded-xl md-label-large text-lg"
                    >
                        <div class="flex flex-row text-lg items-center">
                            <svg
                                    class="mr-2"
                                    width="1.25rem"
                                    height="1.25rem"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="#1c1b1f"
                            >
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path
                                        d="M12 2l-5.5 9h11L12 2zm0 3.84L13.93 9h-3.87L12 5.84zM17.5 13c-2.49 0-4.5 2.01-4.5 4.5s2.01 4.5 4.5 4.5 4.5-2.01 4.5-4.5-2.01-4.5-4.5-4.5zm0 7c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5zM3 21.5h8v-8H3v8zm2-6h4v4H5v-4z"
                                />
                            </svg>
                            <button
                                    class="text-on-surface"
                                    type="button"
                                    id="section_btn1"
                                    onclick="switchsection(1)"
                            >
                                Select Category
                            </button>
                        </div>
                        <hr class="border-top border-gray-300">
                        <div class="flex flex-row items-center">
                            <i class="fas fa-tag mr-2"></i>
                            <button
                                    class="text-on-surface "
                                    disabled
                                    id="section_btn2"
                                    onclick="switchsection(2)"
                                    type="button"
                            >Select Brand
                            </button>
                        </div>
                        <hr class="border-top border-gray-300">
                        <div class="flex flex-row items-center">
                            <i class="fas fa-info mr-4"></i>
                            <button
                                    class="text-on-surface "
                                    disabled
                                    id="section_btn3"
                                    onclick="switchsection(3)"
                                    type="button"
                            >
                                Add Product Info
                            </button>
                        </div>
                        <hr class="border-top border-gray-300">
                    </div>
                    <!-- Side Nav End -->

                    <div
                            class="w-full flex flex-col ml-16 mt-5 gap-y-2 pb-32 opacity-0 transition-opacity ease-in-out hidden"
                            id="section_2"
                    >
                        Work In Progress
                    </div>


                    <!-- Category Selection -->
                    <div
                            class="w-full flex flex-col ml-3 mt-5 gap-y-2 pb-32 opacity-0 opacity-100 transition-opacity ease-in-out"
                            id="section_1">
                        <div class="flex flex-row gap-x-4 h-full">
                                <div class="bg-surface text-on-surface w-46 flex-none mb-16 text-lg overflow-y-auto rounded-xl">
                                    <?php foreach (
                                        $cat_array
                                        as $cat_array_val
                                    ) {
                                        echo '<div class="">';
                                        echo '<button type="button" onclick="selectcategory(false,this)" name="cat_item" id="cat_item_' .
                                            $cat_array_val["catid"] .
                                            '" class="w-full px-4 py-4 hover:bg-blue-400 hover:text-white">' .
                                            $cat_array_val["catname"] .
                                            "</button>";
                                        echo "</div>";
                                    } ?>
                                </div>
                                <div class="bg-surface text-on-surface w-40 flex-none mb-16 text-lg overflow-y-auto rounded-xl"
                                        id="sub_container"
                                >
                                    <p class="md-label-large font-light text-center py-4">Select a subcategory</p>
                                </div>
                                <div class="bg-surface text-on-surface w-full mb-16 mr-5  py-4 flex flex-col gap-y-2 rounded-xl">
                                    <?php
/*
                                    if ($listing_cat_id == 0){
                                        echo '<div class="flex flex-row w-full justify-center place-items-center h-full">';
                                        echo '<p class="md-label-large font-light mb-36 text-on-surface">Select the category you wish to sell</p>';
                                        echo '</div>';
                                    }
                                    else if ($listing_subcat_id == 0){
                                        echo '<div class="flex flex-row w-full justify-center place-items-center h-full">';
                                        echo '<p class="md-label-large font-light mb-36 text-on-surface">Select the subcategory you wish to sell</p>';
                                        echo '</div>';
                                    }
                                    else {
                                    ?>
                                        <div class="flex flex-row">
                                            <p class="md-title-md font-light px-4">Subcategory</p>
                                            <span class="md-title-md"><?php echo $subcat_array[$listing_subcat_id]['subcatname']; ?></span>
                                        </div>
                                        <hr class="border-top border-gray-300 ">
                                        <div class="flex w-full h-full md-label-large p-4"></div>
                                    <?php
                                        }
                                    */
?>
                                </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="w-full flex flex-row gap-x-2 opacity-100 transition-opacity ease-in-out hidden" id="section_3" >
                        <div class="flex flex-col px-6 py-5 bg-surface text-on-surface rounded-xl gap-y-4 w-1/2 h-max">
                                <span class="md-title-large ">Listing Photos</span>
                                <div class="flex flex-col gap-y-2">
                                    <span class="text-sm ">Enter Main Image Url</span>
                                    <textarea placeholder="Enter URL" name="listing_main_image_url" id="listing_main_image_url" required
                                        class="focus:outline-0 border rounded bg-surface border-outline py-2 px-2 w-full h-36"></textarea>
                                </div>
                                <div class="flex flex-col gap-y-2">
                                    <span class="text-sm ">Enter All Images URLs</span>
                                    <textarea  placeholder="Enter URLs seperated by space" name="listing_images_urls" id="listing_images_urls" required
                                        class="focus:outline-0 border rounded bg-surface border-outline py-2 px-2 w-full h-56"></textarea>
                                </div>
                                <div class="flex flex-col gap-y-2">
                                    <span class="text-sm ">Enter Product Feature Image URL</span>
                                    <textarea  placeholder="Enter URL" name="listing_feature_url" id="listing_feature_url" required
                                        class="focus:outline-0 border rounded bg-surface border-outline py-2 px-2 w-full h-36"></textarea>
                                </div>

                        </div>
                        <div class="flex flex-col gap-y-2">
                            <div class="px-4 py-5 bg-surface text-on-surface rounded-xl md-label-large">
                                <div class="flex flex-row items-center pb-4 mb-1">
                                    <span class="md-title-large">Price and Stock</span>
                                </div>
                                <div class="flex flex-row gap-x-4">
                                    <div class="flex flex-col gap-y-1">
                                        <span class="md-label-medium">MRP</span>
                                        <input type="text" name="listing_price" required id="listing_price"
                                            class="focus:outline-0 border rounded bg-surface border-outline py-2 px-2 w-64" />
                                    </div>
                                    <div class="flex flex-col gap-y-1">
                                        <span class="md-label-medium">Listing Status</span>
                                        <select name="listing_status" required id="listing_status"
                                            class="focus:outline-0 border rounded bg-surface border-outline py-2 px-2 w-64">
                                            <option value="instock">In Stock</option>
                                            <option value="outofstock">Out Of Stock</option>
                                            <option value="unavailable">Unavailable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-y-1 mt-5">
                                    <span class="md-label-medium">Stock Quantity</span>
                                    <input type="number" name="listing_quantity" id="listing_quantity" required
                                        class="focus:outline-0 border rounded bg-surface border-outline py-2 px-2 w-64" />
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-surface text-on-surface rounded-xl md-label-large">
                                <div class="flex flex-row items-center pb-4">
                                    <span class="md-title-large">Listing Description</span>
                                </div>
                                <div class="flex flex-row gap-x-4 mb-4">
                                    <div class="flex flex-col gap-y-1">
                                        <span class="md-label-medium">Model Name</span>
                                        <input type="text" name="listing_model_name" id="listing_model_name"
                                            class="focus:outline-0 border rounded bg-surface border-outline py-2 px-2 w-64" required
                                            onkeyup="show_submit_area()"
                                        />
                                    </div>
                                    <div class="flex flex-col gap-y-1">
                                        <span class="md-label-medium">Size</span>
                                        <input required type="number" name="listing_size" id="listing_size"
                                            class="focus:outline-0 border rounded bg-surface border-outline py-2 px-2 w-64" />
                                    </div>
                                </div>
                                <div class="flex flex-row gap-x-4">
                                    <div class="flex flex-col gap-y-1">
                                        <span class="md-label-medium"">Color</span>
                                        <input required type="text" name="listing_color" id="listing_color"
                                                class="focus:outline-0 border rounded bg-surface border-outline py-2 px-2 w-64" />
                                    </div>
                                    <div class="flex flex-col gap-y-1">
                                        <span class="md-label-medium">For</span>
                                        <select required name="listing_for" id="listing_for"
                                                class="focus:outline-0 border rounded bg-surface border-outline py-2 px-2 w-64">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="maf">Male & Female</option>
                                            <option value="kids">Kids</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="flex flex-row justify-between flex-none bg-surface text-on-surface p-6 mt-1 rounded-xl
                            transition-transformn duration-500 ease-in-out translate-y-32  md-label-large text-lg"
                        id="submit_indicator"
                >
                    <div class="flex flex-row align-middle gap-x-2 items-center">
                        <i class="far fa-times-circle text-red-500" id="submit_indicator_icon"></i>
                        <p class="font-light">Product</p>
                        <p id="listing_display_name"></p>
                    </div>
                    <div class="bg-primary">
                        <button type="submit" class="text-on-primary text-xl p-2"
                                onclick="submitproduct()"
                        >Submit</button>
                    </div>

                </div>
            </div>
        </form>
        <script src="js/axios.min.js"></script>
        <script>
            var prev_cat_elem,prev_subcat_elem;
            var editing_mode = false;
            var product_id=0;

            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            try {
                editing_mode = urlParams.get('editing_mode');
                product_id = urlParams.get('product_id');
            }
            catch {
                console.log('Not on editing mode, FIne tho');
            }
            if(editing_mode == 'true' && product_id > 0) {
                console.log('Okey going editing mode');

                window.addEventListener('DOMContentLoaded', (event) => {
                    populate_fields( product_id);
                });
            }


            function selectcategory( issubcat , element) {
                catid = element.id.match(/\d/)[0];
                if(issubcat) {
                    if (prev_subcat_elem) {
                        prev_subcat_elem.classList.toggle('bg-blue-500');
                        prev_subcat_elem.classList.toggle('text-white');
                        prev_subcat_elem.classList.toggle('hover:bg-blue-400');
                    }
                    document.getElementById('listing_subcat_id').value = element.innerHTML;;
                    prev_subcat_elem = element;
                    document.getElementById('section_btn3').disabled = false;
                }
                else {
                    if (prev_cat_elem) {
                        prev_cat_elem.classList.toggle('bg-blue-500');
                        prev_cat_elem.classList.toggle('text-white');
                        prev_cat_elem.classList.toggle('hover:bg-blue-400');
                    }
                    document.getElementById('listing_cat_id').value = element.innerHTML;
                    document.getElementById('listing_subcat_id').value = 0;
                    prev_cat_elem = element;
                    generateElements(catid);

                }

                element.classList.toggle('hover:bg-blue-400');
                element.classList.toggle('bg-blue-500');
                element.classList.toggle('text-white');

            }
            function generateElements(sid) {
                // Queries our listing helper for list of subcategories and then create buttons
                // with values from the JSON and applying our styles
                // Also remove pre existing child eleements from the container

                var sub_container = document.getElementById("sub_container");

                // As long as <div> has a child node, remove it
                while (sub_container.hasChildNodes()) {
                    sub_container.removeChild(sub_container.firstChild);
                }

                axios.get('/sports_place/helpers/listing_helper.php', {
                    params: {
                        mode: 'list_subcat',
                        listing_cat_id: sid
                    }
                })
                .then(function (response) {
                    response.data.forEach(element => {
                        newElem = document.createElement('button');
                        document.getElementById('sub_container').appendChild(newElem);
                        newElem.id="subcat_item_"+element.subcatid;
                        newElem.name="subcat_item";
                        newElem.classList.add('w-full', 'py-4', 'hover:bg-blue-400', 'hover:text-white');
                        newElem.innerHTML=element.subcatname;
                        newElem.type='button';
                        newElem.setAttribute("onclick","selectcategory(true,this)");
                    });

                });
            }
            function switchsection(section_id) {
                for (var i=1;i<4;i++) {
                    var section = 'section_' + i;
                    var section_btn = 'section_btn' + i;
                    if (i == section_id) {
                        document.getElementById(section).classList.remove('hidden');
                        document.getElementById(section).classList.add('opacity-100');
                        continue;
                    }
                    document.getElementById(section).classList.add('hidden');
                    document.getElementById(section).classList.remove('opacity-100');
                }
            }
            function show_submit_area(){
                document.getElementById('listing_display_name').innerHTML = document.getElementById('listing_model_name').value;
                document.getElementById('submit_indicator').classList.remove('hidden');
                setTimeout(function(){
                    document.getElementById('submit_indicator').classList.add('translate-y-0');
                }, 0);

            }
            function submitproduct(){
                    if(document.getElementById('listing_form').checkValidity()) {
                        document.getElementById('submit_indicator_icon').classList.remove('text-red-500','fa-times-circle');
                        document.getElementById('submit_indicator_icon').classList.add('fa-check-circle','text-green-500');
                        document.getElementById('listing_form').submit();
                    }
            }


            function populate_fields (product_id) {
                axios.get('/sports_place/helpers/listing_helper.php', {
                    params: {
                        mode: 'view',
                        product_id: product_id
                    }
                })
                .then(function (response) {
                    if (response.data == null)
                        return;

                    var data = response.data[0];

                    var cat_elements = document.getElementsByName('cat_item');
                    cat_elements.forEach(cat_element => {
                        if(cat_element.innerHTML == data.product_main_category ) {
                            selectcategory( false , cat_element);
                        }
                    });

                    // Wait for some milliseconds before the previous function gets executes
                    // Since selectcategory() needs time to fetch from server , the subcat_itmes won't be populated
                    // If we try to run without a delay
                    // Better way is to use async / await
                    setTimeout(function(){
                        var subcat_elements = document.getElementsByName('subcat_item');

                        subcat_elements.forEach(subcat_element => {
                            if(subcat_element.innerHTML == data.product_sub_category ) {
                                selectcategory( true , subcat_element);
                            }
                        });
                    },200);

                    document.getElementById('listing_main_image_url').value = data.product_main_image;
                    document.getElementById('listing_images_urls').value = data.product_images;
                    document.getElementById('listing_feature_url').value = data.product_features;

                    document.getElementById('listing_price').value = data.product_price;
                    document.getElementById('listing_quantity').value = data.product_quantity;
                    document.getElementById('listing_model_name').value = data.product_full_name;
                    document.forms.listing_form.action = "<?php echo htmlspecialchars(
                        $_SERVER["PHP_SELF"]
                    ); ?>?edit_mode=true"

                });
            }
        </script>
    </body>
    <style>
        .section {
            background-color: #f7f7f7;
        }
        /* width */
        ::-webkit-scrollbar {
        width: 6px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: .75rem;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: .75rem;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #555;
        }

    </style>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $listing_for = trim_input($_POST["listing_for"]);

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
// function to trim useless contents from data
function trim_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>

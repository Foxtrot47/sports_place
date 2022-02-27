<?php
session_start();
include "helpers/db_connect.php";
$productid = $product_name = $product_main_category = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $productid = $_GET["productid"];

    // Check for valid product
    $sql = 'SELECT * FROM products WHERE product_id ="' . $productid . '"';
    $result = $conn->query($sql);

    // Check if exactly 1 result exist
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    }
}
?>

<body class="bg-gray-100">
    <?php include "Navbar.php"; ?>
    <div class="bg-white p-4 pb-1 mt-2 a">
        <div class=" flex flex-row w-full h-5/6">
            <div class="w-1/2 flex-none">
                <div class="">
                    <div class="flex flex-row h-full">
                        <div class="w-24 mr-4 flex flex-none flex-col gap-1 overflow-hidden">

                            <!--- Split the product_images value into individual string seperated by spaces
                                  and make new div elements and images inside them using the splitted string as src
                            -->
                            <?php if ($row["product_images"] != null) {
                                $images = explode(" ", $row["product_images"]);
                                for ($i = 0; $i < count($images); $i++) {
                                    if ($images[$i] != null) { ?>
                                                <img src=" <?php echo $images[
                                                    $i
                                                ]; ?>"/>
                                            <?php }
                                }
                            } ?>
                        </div>
                        <div class=" w-full flex justify-center px-12 p-4">
                            <img src="<?php echo $row[
                                "product_main_image"
                            ]; ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pl-8 p-2 w-full flex flex-col">
                <p class="text-gray-500 text-sm">Home > <span id="product_main_category"><?php echo $row[
                    "product_main_category"
                ]; ?></span> > <span id="product_sub_category"><?php echo $row[
    "product_sub_category"
]; ?></span> > <span id="product_name_small"><?php echo $row[
    "product_full_name"
]; ?></span> </p>
                <p class="text-black text-xl py-2" id="product_name">
                    <?php echo $row["product_full_name"]; ?>
                </p>
                <div class="grid grid-cols-12 w-full">
                    <p class="text-2xl font-bold" id="product_price_currency">$</p>
                    <p class="text-2xl font-bold col-span-10" id="product_price">
                        <?php echo $row["product_price"]; ?>
                    </p>
                    <p class="text-xl text-right">Rating</p>
                </div>
                <hr class="border border-gray-100 w-full my-2">
                <p class="text-red-500 text-xl py-2 hidden" id="oot_indic">Out of stock.</p>
                <div class="grid grid-cols-10 gap-2">
                    <div class="h-12 border border-gray-300 py-2">
                        <p class="text-center" id="quantity">1</p>
                    </div>
                    <div class="h-12 bg-blue-500 py-3 col-span-9 text-center">
                        <button
                                class="text-white w-full h-full"
                                onclick="addItem(<?php echo $row[
                                    "product_id"
                                ]; ?>)"
                        >
                            ADD TO CART
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="bg-gray-300 border-t-2">
    <div
            class="sticky bg-white h-14 w-full top-20-px pr-2 text-xl pt-1.5 drop-shadow-md filter z-30"
    >
        <button class="hover:text-blue-500 pt-2 px-3 align-middle">
            Features
        </button>
        <button class="hover:text-blue-500 pt-2 pr-3 align-middle">
            Reviews
        </button>
        <button class="hover:text-blue-500 pt-2 pr-3 align-middle">
            Product Information
        </button>
        <button
                class="pt-2 bg-blue-500 h-5/6 rounded py-1 px-2 text-white align-middle float-right"
                onclick="addItem(<?php echo $row["product_id"]; ?>)"
        >
            ADD TO CART
        </button>
        <button class="pt-2 pr-3 align-middle float-right">
            <span>$</span>
            <span id="product_price_small">
                <?php echo $row["product_price"]; ?>
            </span>
        </button>
    </div>

    <div class="bg-white pt-10">
        <img src="<?php echo $row["product_features"]; ?>">
    </div>
    <script>
        if(<?php echo $row["product_quantity"]; ?> != 0) {
            document.getElementById("oot_indic").classList.add("hidden");
        }
        function addItem(product_id) {
            if(product_id == null) {
                return;
            }
            // Using axios for sending update cuz using forms/PHP for this purpose causes various other issues
            axios.get('/sports_place/helpers/cart_helper.php', {
                params: {
                product_id,
                product_quantity: document.getElementById('quantity').innerHTML,
                product_price: <?php echo $row["product_price"]; ?> ,
                savelater: 0,
                }
            })
            .then(function (response) {
                window.location.replace("/sports_place/cart.php");
            });
        }

    </script>
    <script src="js/axios.min.js"></script>
</body>

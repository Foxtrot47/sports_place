<?php
include "Navbar.php";

$total_cost = $count = $saved_count = 0;
if (isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] == true) {
    $cart_item_result = $conn->query(
        'SELECT * FROM cart WHERE user_id="' . $_SESSION["user_id"] . '"'
    ); ?>

<body class="bg-gray-100">

    <form method="post" action="<?php echo htmlspecialchars(
        $_SERVER["PHP_SELF"]
    ); ?>">
        <div class="grid grid-cols-8 ml-10 mr-10 gap-x-4 mt-5 ">
            <div class="flex flex-col w-full col-span-6">
                <div class="bg-white shadow-md mb-5">
                    <div class="flex flex-col pt-5">
                        <p class="pl-6 pb-4 font-semibold text-xl">My Cart</p>
                        <hr class="bg-black">
                        <div class="flex flex-col gap-2">

                            <!-- Show only when item count is zero ( set later in JS) -->
                            <p class='pl-5 my-5 text-lg hidden' id="empty_cart_text">Your cart is empty!</p>

                            <!-- Individual Cart Items -->
                            <?php if ($cart_item_result->num_rows > 0) {
                                while (
                                    $cart_item = $cart_item_result->fetch_assoc()
                                ) {
                                    if ($cart_item["save_for_later"] == false) {
                                        $product_result = $conn->query(
                                            'SELECT * FROM products WHERE product_id="' .
                                                $cart_item["product_id"] .
                                                '"'
                                        );
                                        if ($product_result->num_rows > 0) {
                                            while (
                                                $product = $product_result->fetch_assoc()
                                            ) {

                                                $total_cost =
                                                    $total_cost +
                                                    $product["product_price"] *
                                                        $cart_item["quantity"];
                                                $count =
                                                    $count +
                                                    $cart_item["quantity"];
                                                ?>
                            <div class="pl-6 flex flex-row gap-x-2">
                                <div class="flex flex-col w-44">
                                    <img src="<?php echo explode(
                                        " ",
                                        $product["product_images"]
                                    )[0]; ?>" >
                                    <div class="flex flex-row ml-2 mt-4">
                                        <button type="button" class="border border-gray-300 bg-white rounded-full h-8 w-8" 
                                        onclick="updateItem(<?php echo $product[
                                            "product_id"
                                        ]; ?>,<?php echo $cart_item[
    "quantity"
]; ?>,-1,false )">
                                        -</button>  
                                        <input type="text" class="mx-3 px-2 border w-16 text-center" value=<?php echo $cart_item[
                                            "quantity"
                                        ]; ?>>
                                        <button type="button" class="border border-gray-300 bg-white rounded-full h-8 w-8"
                                        onclick="updateItem(<?php echo $product[
                                            "product_id"
                                        ]; ?>,<?php echo $cart_item[
    "quantity"
]; ?>,1,false )">+</button>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-xl font-medium overflow-hidden"><?php echo $product[
                                        "product_full_name"
                                    ]; ?></p>
                                    <p class="font-light">Seller:</p>
                                    <p class="text-2xl font-bold mt-5"><?php echo $product[
                                        "product_price"
                                    ]; ?></p>
                                    <div class="flex flex-row mt-12 gap-x-4">
                                        <button type="button" class="font-semibold"
                                        onclick="updateItem(<?php echo $product[
                                            "product_id"
                                        ]; ?>,<?php echo $cart_item[
    "quantity"
]; ?>,0,true )">
                                        SAVE FOR LATER
                                    </button>
                                        <button type="button" class="font-semibold" 
                                        onclick="updateItem(<?php echo $product[
                                            "product_id"
                                        ]; ?>,<?php echo $cart_item[
    "quantity"
]; ?>,-2 , false )"
                                        >REMOVE</button>
                                    </div>
                                </div>
                            </div>
                            <?php
                                            }
                                        }
                                    }
                                }
                            } ?>
                            <!-- End of Individual Cart Items -->

                            <div class="w-full flex justify-end py-3 <?php if (
                                $count < 1
                            ) {
                                echo "hidden";
                            } ?> " style="box-shadow: 0 -2px 10px 0 rgb(0 0 0 / 10%);">
                                <span style="background-color:#fb641b;" class="px-6 py-3 mr-3 text-white align-middle filter drop-shadow-lg">
                                    PLACE ORDER
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-md mb-5" id="saved_sec">
                    <div class="flex flex-col pt-5">
                        <p class="pl-6 pb-4 font-semibold text-xl">Saved for later</p>
                        <hr class="bg-gray-100">
                        <div class="pl-6 py-4 flex flex-col gap-2">
                            <!-- Individual Saved for later Items -->
                            <?php
                            $cart_item_result = $conn->query(
                                'SELECT * FROM cart WHERE user_id="' .
                                    $_SESSION["user_id"] .
                                    '"'
                            );
                            if ($cart_item_result->num_rows > 0) {
                                while (
                                    $cart_item = mysqli_fetch_assoc(
                                        $cart_item_result
                                    )
                                ) {
                                    if ($cart_item["save_for_later"] == 1) {
                                        $product_result = $conn->query(
                                            'SELECT * FROM products WHERE product_id="' .
                                                $cart_item["product_id"] .
                                                '"'
                                        );
                                        if ($product_result->num_rows > 0) {
                                            while (
                                                $product = mysqli_fetch_assoc(
                                                    $product_result
                                                )
                                            ) {
                                                $saved_count++; ?>
                            <div class="flex flex-row gap-x-2">
                                <div class="flex flex-col w-44">
                                    <img src="<?php echo explode(
                                        " ",
                                        $product["product_images"]
                                    )[0]; ?>" >
                                    <div class="flex flex-row ml-2 mt-4">
                                        <button type="button" class="border border-gray-300 bg-white rounded-full h-8 w-8" 
                                        onclick="updateItem(<?php echo $product[
                                            "product_id"
                                        ]; ?>,<?php echo $cart_item[
    "quantity"
]; ?>,-1,false )">
                                        -</button>  
                                        <input type="text" class="mx-3 px-2 border w-16 text-center" value=<?php echo $cart_item[
                                            "quantity"
                                        ]; ?>>
                                        <button type="button" class="border border-gray-300 bg-white rounded-full h-8 w-8"
                                        onclick="updateItem(<?php echo $product[
                                            "product_id"
                                        ]; ?>,<?php echo $cart_item[
    "quantity"
]; ?>,1,false )">+</button>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-xl font-medium overflow-hidden"><?php echo $product[
                                        "product_full_name"
                                    ]; ?></p>
                                    <p class="font-light">Seller:</p>
                                    <p class="text-2xl font-bold mt-5"><?php echo $product[
                                        "product_price"
                                    ]; ?></p>
                                    <div class="flex flex-row mt-12 gap-x-4">
                                        <button type="button" class="font-semibold"
                                        onclick="updateItem(<?php echo $product[
                                            "product_id"
                                        ]; ?>,<?php echo $cart_item[
    "quantity"
]; ?>,0,0 )">
                                        ADD TO CART
                                    </button>
                                        <button type="button" class="font-semibold" 
                                        onclick="updateItem(<?php echo $product[
                                            "product_id"
                                        ]; ?>,<?php echo $cart_item[
    "quantity"
]; ?>, -2 , false )"
                                        >REMOVE</button>
                                    </div>
                                </div>
                            </div>
                            <?php
                                            }
                                        }
                                    }
                                }
                            }

}
?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 <?php if ($count < 1) {
                echo "hidden";
            } ?> ">
                <div class="flex flex-col bg-white py-4  shadow-md">
                    <p class="text-md font-semibold text-gray-500 mb-4 pl-4">PRICE DETAILS</p>
                    <hr class="bg-gray-100">
                    <div class="p-4 flex flex-col gap-4">
                        <div class="flex flex-row w-full justify-between">
                            <p>Price (<?php echo $count; ?> item)</p>
                            <p>$<?php echo $total_cost; ?></p>
                        </div>
                        <div class="flex flex-row w-full justify-between">
                            <p>Discount</p>
                            <p style="color:#388e3c;">N/A</p>
                        </div>
                        <div class="flex flex-row w-full justify-between">
                            <p>Delivery Charges</p>
                            <p style="color:#388e3c;">FREE</p>
                        </div>
                    </div>
                    <hr class="bg-gray-100 mx-4">
                    <div class="p-4 flex flex-row justify-between font-semibold text-lg">
                        <p>TOTAL AMOUNT</p>
                        <p>$<?php echo $total_cost; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

<script>
    function updateItem(product_id , product_quantity , quantity_modifier , savelater) {
        if(product_id == null) {
            return;
        }
        // simple logic to remove item from cart
        if (quantity_modifier == -2) {
            quantity_modifier = -1 * product_quantity;
        }
        // Using axios for sending updation cuz using forms/PHP for this pupose causes various other issues
        axios.get('/sports_place/helpers/cart_helper.php', {
            params: {
            product_id,
            product_quantity: product_quantity + quantity_modifier,
            savelater
            }
        })
        .then(function (response) {
            location.reload();
        });  
    }
    if (<?php echo $saved_count; ?> < 1) {
        try {
            document.getElementById('saved_sec').classList.toggle("hidden");
        }
        catch(err) {
            // do nothing 
        }
    }
    if (<?php echo $count; ?> < 1) {
        document.getElementById('empty_cart_text').classList.toggle("hidden");
    }
</script>

<script src="js/axios.min.js"></script>
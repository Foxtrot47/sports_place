<?php
include "Navbar.php";

$total_cost = $count = $saved_count = 0;
if (isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] == true) {
    $order_item_result = $conn->query(
        'SELECT * FROM orders WHERE user_id="' . $_SESSION["user_id"] . '"'
    );
}
?>

<body class="bg-gray-100">

    <div class="flex flex-row m-4 mx-16 gap-x-8">
        <div class="flex flex-col w-60 bg-white filter drop-shadow-sm p-4">
            <p class="font-semibold text-2xl">Filters</p>
            <p class="font-semibold text-xl pt-1 pb-1">ORDER TIME</p>
            <div class="flex flex-row gap-x-2 items-center mt-2">
                <input class="inline" type="checkbox" name="order_time_filter" value="last_30">
                <span >Last 30 Days</span>
            </div>
            <div class="flex flex-row gap-x-2 items-center mt-2">
                <input class="inline" type="checkbox" name="order_time_filter" value="2020">
                <span >2020</span>
            </div>
            <div class="flex flex-row gap-x-2 items-center mt-2">
                <input class="inline" type="checkbox" name="order_time_filter" value="2019">
                <span >2019</span>
            </div> 
        </div>
        <div class="flex flex-col w-full">

            <div class="bg-white flex flex-row w-5/6 h-10 border border-gray-300 ">
                <div class="w-5/6 py-2 px-5">
                <input type="text" placeholder="Search your Orders">
                </div>
                
                <div class="w-1/6 bg-blue-500 px-3 py-2 align-middle">
                    <button class="text-white w-full flex flex-row">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF" class="mr-2">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        Search Orders
                    </button>
                </div>
            </div>
            <div class="mt-4 filter drop-shadow-sm flex flex-col gap-y-4 w-full h-full pr-10">
                
                <?php if ($order_item_result->num_rows > 0) {
                    while ($order_item = $order_item_result->fetch_assoc()) {
                        $product_result = $conn->query(
                            'SELECT * FROM products WHERE product_id="' .
                                $order_item["product_id"] .
                                '"'
                        );
                        if ($product_result->num_rows > 0) {
                            while (
                                $product = $product_result->fetch_assoc()
                            ) { ?>
                <div class="w-full bg-white flex flex-row gap-x-4 px-10 py-4">
                    <img 
                        src=<?php echo $product["product_main_image"]; ?>
                        class="w-24"
                    >
                    <div class="flex flex-col gap-y-2 ml-4 w-96">
                        <p class="text-2xl font-semibold truncate "><?php echo $product[
                            "product_full_name"
                        ]; ?></p>
                        <p class="font-light text-md"><?php echo $product[
                            "product_seller_name"
                        ]; ?></p>
                    </div>

                    <div class="flex flex-row justify-around w-full">
                        <p >$<?php echo $order_item["order_price"]; ?></p>
                        <div class="flex flex-col gap-y-2">
                            <p class="font-semibold">Delivered on <?php echo date(
                                "M d",
                                strtotime($order_item["order_date"])
                            ); ?></p>
                            <p class="text-sm">Your item has been Delivered </p>
                        </div>
                    </div>
                </div>
                <?php }
                        }
                    }
                } ?>

            </div>
        </div>
    </div>
</body>
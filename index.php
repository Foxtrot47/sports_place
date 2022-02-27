<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body class="bg-gray-100">
    <?php
    session_start();
    include "Navbar.php";

    $featured_list = $conn->query(
        "SELECT * FROM products ORDER BY RAND() LIMIT 6"
    );
    ?>
        <div class="py-2 flex flex-col gap-2">
            <div class="bg-white">
                <div class="pt-4 px-4 ">
                    <p class="text-2xl font-bold uppercase align-bottom pb-5">Random Items</p>
                </div>
                <div class="grid grid-cols-6 gap-x-10 pt-2 px-5 pb-5">
                <?php if ($featured_list->num_rows > 0) {
                    while ($row = $featured_list->fetch_assoc()) { ?>
                            <div class='w-full' onclick=location.href="product.php?productid=<?php echo $row[
                                "product_id"
                            ]; ?>">
                                <img src="<?php echo $row[
                                    "product_main_image"
                                ]; ?>">
                                <div class="pt-5">
                                    <p class='text-md font-semibold block hover:text-blue-500 truncate'><?php echo $row[
                                        "product_full_name"
                                    ]; ?></p>
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
            <div class="bg-white">
                <div class="pt-4 px-4 "><p class="text-2xl font-bold uppercase align-bottom">Categories</p></div>
                <div class="flex flex-row h-56">
                    <?php
                    $list_q = "SELECT * FROM subcategories LIMIT 4";
                    $products_list = $conn->query($list_q);

                    if ($products_list->num_rows > 0) {
                        while ($row = $products_list->fetch_assoc()) { ?>
                                <div class="p-2 w-26">
                                    <img src=<?php echo $row["subcat_pic"]; ?> >
                                </div>
                                <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

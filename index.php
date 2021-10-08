<body class="bg-gray-100">
    <?php
    include "Navbar.php";
    ?>

    <div class="py-2 flex flex-col gap-2">
        <div class="bg-white">
            <div class="pt-4 px-4 "><p class="text-2xl font-bold uppercase align-bottom">Categories</p></div>
            <div class="flex flex-row">
                <div class="p-3">
                    <img src="https://cdn.shopify.com/s/files/1/1330/6287/files/Fall_home_page_collection_480x640.jpg?v=1631318514"/>
                    <p class="text-xl font-bold py-2">Some Description</p>
                </div>
                <div class="p-3">
                    <img src="https://cdn.shopify.com/s/files/1/1330/6287/files/Fall_home_page_collection3_480x640.jpg?v=1631318540"/>
                </div>
                <div class="p-3">
                    <img src="https://cdn.shopify.com/s/files/1/1330/6287/files/Fall_home_page_collection2_480x640.jpg?v=1631318585"/>
                </div>
                <div class="p-3">
                    <img src="https://cdn.shopify.com/s/files/1/1330/6287/files/Fall_home_page_collection4_480x640.jpg?v=1631318608"/>
                </div>
            </div>
        </div>
        <div class="bg-white">
            <div class="pt-4 px-4 "><p class="text-2xl font-bold uppercase align-bottom">Categories</p></div>
            <div class="flex flex-row h-56">
                <?php 
                    $list_q = 'SELECT * FROM subcategories LIMIT 4';
                    $products_list = $conn->query($list_q);
        
                    if ($products_list->num_rows > 0) {
                        while($row = $products_list->fetch_assoc()) {
                            ?>
                            <div class="p-2 w-26">
                                <img src=<?php echo $row['subcat_pic'] ?> >
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<?php

include 'helpers/db_connect.php';

$productid = $product_name = $product_main_category = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $productid = $_GET['productid'];

        // Check for valid product
        $sql = 'SELECT * FROM products WHERE product_id ="' . $productid . '"';
        $result = $conn->query($sql);
    
        // Check if exactly 1 result exist
        if ($result->num_rows == 1) {
            while($row = $result->fetch_assoc()) {
                $product_name = $row["product_full_name"];
                $product_main_category = $row["product_main_category"];
                $product_sub_category = $row["product_sub_category"];
                $product_price = $row["product_price"];
                $product_images = $row["product_images"];
                $product_main_image = $row["product_main_image"];
                $product_quantity = $row["product_quantity"];
            }
        }
}

?>

<body class="bg-gray-100">
    <?php
    include "Navbar.php";
    ?>
    <div class="bg-white p-4 pb-1 mt-2 a">
        <div class=" flex flex-row w-full h-5/6">
            <div class="w-1/2 flex-none">
                <div class="border border-gray-100">
                    <div class="flex flex-row h-full">
                        <div class="w-20 flex flex-none flex-col gap-1">

                            <!--- Split the product_images value into individual string seperated by spaces
                                  and make new div elements and images inside them using the splitted string as src
                            -->
                            <?php
                                if($product_images != NULL) {
                                    $images = explode(" ",$product_images);
                                    for($i=0;$i<count($images);$i++){
                                        if($images[$i] != NULL){
                                            ?>
                                            <div>
                                                <img src=" <?php echo $images[$i] ?>"/>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                            ?> 
                        </div>
                        <div class="border border-gray-200 w-full flex justify-center px-12 p-4">
                            <img src="<?php echo $product_main_image ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pl-8 p-2 w-full flex flex-col">
                <p class="text-gray-500 text-sm">Home > <span id="product_main_category"> </span> > <span id="product_sub_category"></span> > <span id="product_name_small"> </span> </p>
                <p class="text-black text-xl py-2" id="product_name">Product</p>
                <div class="grid grid-cols-12 w-full">
                    <p class="text-2xl font-bold" id="product_price_currency">$</p>
                    <p class="text-2xl font-bold col-span-10" id="product_price">Price</p>
                    <p class="text-xl text-right">Rating</p>
                </div>
                <hr class="border border-gray-100 w-full my-2">
                <p class="text-red-500 text-xl py-2" id="oot_indic">Out of stock.</p>
                <div class="grid grid-cols-10 gap-2">
                    <div class="h-12 border border-gray-300 py-2">
                        <p class="text-center">1</p>
                    </div>
                    <div class="h-12 bg-blue-500 py-3 col-span-9">
                        <p class="text-center text-white">ADD TO CART</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky bg-white h-14 w-full top-16 pr-2 text-xl pt-1.5">
        <button class="hover:text-blue-500 pt-2 px-3 align-middle">
            Features
        </button>
        <button class="hover:text-blue-500 pt-2 pr-3 align-middle">
            Reviews
        </button>
        <button class="hover:text-blue-500 pt-2 pr-3 align-middle">
            Product Information
        </button>
        <button class="hover:text-blue-500 pt-2 bg-blue-500 h-5/6 rounded py-1 px-2 text-white align-middle float-right">
            ADD TO CART
        </button>
        <button class="hover:text-blue-500 pt-2 pr-3 align-middle float-right">
            <span>$</span>
            <span id="product_price_small"></span>
        </button>
    </div>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum facilisis leo vel fringilla est ullamcorper. Nunc sed velit dignissim sodales ut eu. Urna porttitor rhoncus dolor purus. Augue ut lectus arcu bibendum at. Integer eget aliquet nibh praesent. Aliquet nec ullamcorper sit amet risus. Venenatis tellus in metus vulputate eu scelerisque felis imperdiet. Eget dolor morbi non arcu risus. Pharetra convallis posuere morbi leo urna molestie. Sit amet commodo nulla facilisi. Venenatis tellus in metus vulputate eu.
    Pretium fusce id velit ut tortor pretium viverra suspendisse potenti. Congue nisi vitae suscipit tellus mauris a diam. Mattis rhoncus urna neque viverra. Auctor eu augue ut lectus arcu bibendum at varius. Quam id leo in vitae. Dictumst vestibulum rhoncus est pellentesque. Elementum nisi quis eleifend quam adipiscing vitae proin sagittis. Pellentesque nec nam aliquam sem et tortor consequat id porta. Eros donec ac odio tempor orci. Aenean vel elit scelerisque mauris. Aliquam purus sit amet luctus. Sollicitudin aliquam ultrices sagittis orci a scelerisque purus semper eget. Vitae ultricies leo integer malesuada.
    Laoreet non curabitur gravida arcu ac tortor dignissim convallis aenean. Vel eros donec ac odio. Netus et malesuada fames ac turpis egestas integer. Eu nisl nunc mi ipsum faucibus vitae aliquet nec. Turpis massa tincidunt dui ut ornare lectus sit amet est. Vel pretium lectus quam id leo in vitae turpis massa. Ac felis donec et odio pellentesque diam volutpat. Arcu bibendum at varius vel pharetra vel turpis nunc eget. Quis commodo odio aenean sed adipiscing diam. Scelerisque viverra mauris in aliquam sem fringilla ut morbi tincidunt. Nulla facilisi morbi tempus iaculis urna id. Placerat orci nulla pellentesque dignissim. Augue neque gravida in fermentum et sollicitudin. Maecenas pharetra convallis posuere morbi. Et sollicitudin ac orci phasellus egestas tellus. Elit duis tristique sollicitudin nibh sit. Lectus sit amet est placerat. Faucibus et molestie ac feugiat sed. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus. Morbi tincidunt ornare massa eget egestas purus.
    Magna fermentum iaculis eu non diam phasellus vestibulum. Augue neque gravida in fermentum et sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames. Quam elementum pulvinar etiam non quam lacus suspendisse. Faucibus ornare suspendisse sed nisi lacus sed viverra tellus in. Arcu felis bibendum ut tristique et egestas quis ipsum suspendisse. Nisl vel pretium lectus quam id leo in. Aliquam id diam maecenas ultricies mi eget. Felis bibendum ut tristique et egestas quis ipsum suspendisse ultrices. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
    Id velit ut tortor pretium viverra. Dictum varius duis at consectetur lorem donec. Orci dapibus ultrices in iaculis nunc sed. Tristique nulla aliquet enim tortor at auctor. Iaculis eu non diam phasellus vestibulum. Adipiscing enim eu turpis egestas pretium aenean pharetra magna ac. Vulputate dignissim suspendisse in est ante. Scelerisque eu ultrices vitae auctor eu augue ut lectus. Cum sociis natoque penatibus et magnis dis parturient. Condimentum lacinia quis vel eros donec ac odio tempor orci.
    Volutpat est velit egestas dui id ornare arcu odio ut. Dictumst quisque sagittis purus sit amet. Sit amet risus nullam eget felis eget nunc lobortis mattis. Pellentesque habitant morbi tristique senectus. Amet massa vitae tortor condimentum lacinia quis. Dignissim convallis aenean et tortor at risus viverra adipiscing at. Netus et malesuada fames ac turpis. Maecenas accumsan lacus vel facilisis volutpat est velit egestas dui. Nunc sed velit dignissim sodales ut eu sem. Mauris augue neque gravida in fermentum. Mauris sit amet massa vitae tortor condimentum. Orci eu lobortis elementum nibh. In nisl nisi scelerisque eu ultrices vitae auctor. In fermentum et sollicitudin ac orci phasellus egestas tellus rutrum. Tempor nec feugiat nisl pretium fusce id velit ut tortor. Condimentum lacinia quis vel eros donec ac. Ullamcorper dignissim cras tincidunt lobortis feugiat vivamus. Bibendum est ultricies integer quis auctor elit.
    Habitant morbi tristique senectus et netus et malesuada fames ac. Vitae sapien pellentesque habitant morbi. Pulvinar pellentesque habitant morbi tristique senectus et netus. Phasellus faucibus scelerisque eleifend donec pretium. Tempor commodo ullamcorper a lacus vestibulum sed. Tristique senectus et netus et malesuada fames ac. Id consectetur purus ut faucibus pulvinar. Urna nunc id cursus metus aliquam. Viverra suspendisse potenti nullam ac tortor vitae purus. Massa ultricies mi quis hendrerit dolor magna. Dui nunc mattis enim ut tellus. Pellentesque habitant morbi tristique senectus et. Erat imperdiet sed euismod nisi porta lorem mollis. Nunc congue nisi vitae suscipit tellus. Morbi quis commodo odio aenean sed adipiscing diam. Turpis tincidunt id aliquet risus feugiat in ante metus dictum. Augue neque gravida in fermentum et sollicitudin ac.
    Diam ut venenatis tellus in metus vulputate eu scelerisque. Sit amet tellus cras adipiscing enim eu turpis egestas. Rhoncus mattis rhoncus urna neque viverra justo nec ultrices. Tellus in metus vulputate eu. Et ligula ullamcorper malesuada proin libero. Iaculis at erat pellentesque adipiscing. Ultrices dui sapien eget mi. Ornare suspendisse sed nisi lacus sed viverra tellus in. Nunc vel risus commodo viverra maecenas. In mollis nunc sed id semper risus in hendrerit gravida. Vitae turpis massa sed elementum tempus egestas sed sed. Pharetra et ultrices neque ornare. Lorem ipsum dolor sit amet consectetur adipiscing elit ut. Orci phasellus egestas tellus rutrum tellus pellentesque. Tortor aliquam nulla facilisi cras fermentum odio eu feugiat. Est placerat in egestas erat imperdiet sed euismod nisi. Tempus quam pellentesque nec nam. Felis donec et odio pellentesque diam volutpat commodo sed egestas. Euismod lacinia at quis risus sed vulputate odio ut enim. Enim nec dui nunc mattis enim ut tellus.
    Nisl suscipit adipiscing bibendum est ultricies integer quis. Et netus et malesuada fames. Ornare quam viverra orci sagittis eu volutpat odio. Enim nulla aliquet porttitor lacus luctus accumsan tortor. Leo in vitae turpis massa sed elementum tempus egestas. Mi quis hendrerit dolor magna eget est lorem. Suspendisse faucibus interdum posuere lorem ipsum. Elementum nisi quis eleifend quam adipiscing vitae proin sagittis nisl. Imperdiet nulla malesuada pellentesque elit. Turpis in eu mi bibendum neque egestas congue quisque. Risus in hendrerit gravida rutrum quisque. Sed risus ultricies tristique nulla aliquet. Fames ac turpis egestas sed.
    Sed euismod nisi porta lorem. Nunc sed blandit libero volutpat sed cras ornare. Blandit aliquam etiam erat velit scelerisque in dictum non consectetur. Eu non diam phasellus vestibulum lorem sed. Mi eget mauris pharetra et. Vel risus commodo viverra maecenas accumsan lacus vel. Amet massa vitae tortor condimentum lacinia quis vel. Quis varius quam quisque id diam vel. Egestas erat imperdiet sed euismod. Nam aliquam sem et tortor. Tristique et egestas quis ipsum suspendisse ultrices gravida dictum fusce.

    <script>
            document.getElementById("product_name").innerHTML = "<?php echo $product_name ?>";
            document.getElementById("product_name_small").innerHTML = "<?php echo $product_name ?>";
            document.getElementById("product_main_category").innerHTML = "<?php echo $product_main_category ?>";
            document.getElementById("product_sub_category").innerHTML = "<?php echo $product_sub_category ?>";
            document.getElementById("product_price").innerHTML = "<?php echo $product_price ?>";
            document.getElementById("product_price_small").innerHTML = "<?php echo $product_price ?>";

            if(<?php echo $product_quantity ?> != 0) {
                document.getElementById("oot_indic").classList.add("hidden");
            }

    </script>

</body>

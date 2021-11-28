<?php
include "Navbar.php";
if(!isset($_SESSION['user_email'])){
    header('Location: '.'Login.php');
}

$sql = "SELECT * FROM addresses WHERE " . "user_id =" . '"' .  $_SESSION['user_id'] . '"';
$result = $conn->query($sql);

// Check if atlest 1 result exist
if ($result->num_rows > 0) {
    $addr_row = $result->fetch_assoc();

}
?>
<body class="bg-gray-100">

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="grid grid-cols-8 ml-10 mr-10 gap-4 mt-5">
            <div class="col-span-2">
                <div class="flex flex-col">
                    <div class="flex flex-row bg-white p-3 items-center shadow-md mb-5">
                        <img src=<?php echo $_SESSION['grav_url'] ?> class="rounded-3xl">
                        <p class="pl-3 font-semibold"> Hello <?php echo $_SESSION['first_name'] ?></p>
                    </div>
                    <div class="flex flex-col bg-white py-4 shadow-md">
                        <div class="flex flex-row pl-6  py-2">
                            <img src="images/shipping_black_24dp.svg">
                            <p class="font-semibold pl-4" style="color:#878787">MY ORDERS</p>
                        </div>
                        <div class="flex flex-row pl-16 py-2">
                                <p class="text-black">Order History</p>
                        </div>
                        <div class="flex flex-row pl-16 py-2">
                            <p class="text-black">Returns</p>
                        </div>
                        <div class="flex flex-row pl-16 py-2">
                            <p class="text-black">Transactions</p>
                        </div>
                        <hr class="bg-black w-full">
                        <div class="flex flex-row pl-6 py-2">
                            <img src="images/person_black_24dp.svg">
                            <p class="font-semibold pl-4" style="color:#878787">ACCOUNT SETTINGS</p>
                        </div>
                        <div class="flex flex-row pl-16 py-2">
                            <a href="profile_info.php"><p class="text-black">Profile Information</p></a>
                        </div>
                        <div class="flex flex-row pl-16 py-2 bg-blue-50">
                            <p class="font-semibold text-blue-500 ">Edit Address</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white col-span-6 shadow-lg mb-5" id="address_info">
                <div class="pl-6 pt-5">
                    <div class="flex flex-col">
                        <div class="pt-4">
                            <div class="flex flex-row items-center">
                                <p class="font-semibold text-2xl">Edit Address</p>
                                <button class="text-white bg-gray-400 ml-20 py-2 px-5 rounded">Cancel</button>
                                <button class="text-white bg-blue-500 ml-2 py-2 px-6 rounded">Edit</button>
                            </div>
                            <div class="py-4 grid grid-cols-8 gap-y-3">
                                    <span>First Name</span>
                                    <div class="col-span-7"><input id="addr_first_name" type="text" class="colspan-5 p-2 ml-3 bg-gray-100 border-gray-300 rounded border w-2/3" disabled value=<?php echo $addr_row['addr_first_name']; ?> > </div>
                                
                                    <span>Last Name</span>
                                    <div class="col-span-7"><input id="addr_last_name" type="text" class="colspan-5 p-2 ml-3 bg-gray-100 border-gray-300 rounded border w-2/3" disabled value=<?php echo $addr_row['addr_last_name']; ?> ></div>
                               
                                
                                    <span>Mobile No</span>
                                    <div class="col-span-7"><input id="addr_numer" type="text" class="colspan-5 p-2 ml-3  bg-gray-100 border-gray-300 rounded border w-2/3" disabled value=<?php echo $addr_row['addr_mobile_num']; ?> ></div>
                               
                                
                                    <span>Street Address</span>
                                    <div class="col-span-7"><input id="addr_street_addr" type="text" class="colspan-5 p-2 ml-3 bg-gray-100 border-gray-300 rounded border w-2/3" disabled value=<?php echo $addr_row['addr_street_addr']; ?> ></div>    
                               
                                
                                    <span>Landmark</span>
                                    <div class="col-span-7"><input id="addr_landmark" type="text" class="colspan-5 p-2 ml-3 bg-gray-100 border-gray-300 rounded border w-2/3" disabled value=<?php echo $addr_row['addr_landmark']; ?> ></div>    
                               
                                
                                    <span>Additional Address</span>
                                    <div class="col-span-7"><input id="addr_additional" type="text" class="colspan-5 p-2 ml-3 bg-gray-100 border-gray-300 rounded border w-2/3" disabled value=<?php echo $addr_row['addr_additional']; ?> ></div>    
                               
                                
                                    <span>City</span>
                                    <div class="col-span-7"><input id="addr_city" type="text" class="colspan-5 p-2 ml-3 bg-gray-100 border-gray-300 rounded border w-2/3" disabled value=<?php echo $addr_row['addr_city']; ?> ></div>    
                               
                                
                                    <span>Pin Code</span>
                                    <div class="col-span-7"><input id="addr_pin" type="text" class="colspan-5 p-2 ml-3 bg-gray-100 border-gray-300 rounded border w-2/3" disabled value=<?php echo $addr_row['addr_pin']; ?> ></div>    
                               
                                
                                    <span>Country</span>
                                    <div class="col-span-7"><input id="addr_country" type="text" class="colspan-5 p-2 ml-3 bg-gray-100 border-gray-300 rounded border w-2/3" disabled value=<?php echo $addr_row['addr_country']; ?> ></div>    
                               
                                
                                    <span>State</span>
                                    <div class="col-span-7"><input id="addr_state" type="text" class="colspan-5 p-2 ml-3 bg-gray-100 border-gray-300 rounded border w-2/3" disabled value=<?php echo $addr_row['addr_state']; ?> ></div>    
            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
    </form>
</body>
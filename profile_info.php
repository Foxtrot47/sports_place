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

$addr_first_name = "Joyal";
$addr_last_name = "Jose";
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
                        <div class="flex flex-row pl-16 bg-blue-50 py-2">
                            <p class="font-semibold text-blue-500">Profile Information</p>
                        </div>
                        <div class="flex flex-row pl-16 py-2">
                            <a href="address_info.php">
                                <p class="text-black">Edit Address</p>
                            </a>
                         </div>
                    </div>
                </div>
            </div>
            <div class="bg-white col-span-6 shadow-lg mb-5" id="personal_info">
                <div class="pl-6 pt-5">
                    <div class="flex flex-col">
                        <div class="pb-4">
                            <p class="font-semibold text-xl">Personal Information</p>
                            <div class="py-4 flex flex-row gap-2">
                                <input type="text" class="p-2 bg-gray-100 border-gray-300 rounded border antialiased" disabled value=<?php echo $_SESSION['first_name']; ?> >
                                <input type="text" class="p-2 bg-gray-100 border-gray-300 rounded border antialiased" disabled value=<?php echo $_SESSION['last_name']; ?> >
                            </div>
                            <p class="text-sm">Your Gender</p>
                            <input type="radio" id="male_radio" name="gender" value="m" disabled>
                            <label class="text-lg px-2" for="male_radio">Male</label>
                            <input type="radio" id="female_radio" name="gender" value="f" disabled>
                            <label class="text-lg px-2" for="female_radio">Female</label>
                            <input type="radio"  id="nonb_radio" name="gender" value="n" disabled>
                            <label class="text-lg px-2" for="nonb_radio">Nonbinary</label>
                        </div>
                        <div class="pt-4">
                            <p class="font-semibold text-xl">Email Address</p>
                            <div class="py-4 flex flex-row gap-2">
                                <input type="text" class="p-2 bg-gray-100 border-gray-300 rounded border antialiased" disabled value=<?php echo $_SESSION['user_email']; ?> >
                            </div>
                        </div>
                        <div class="pt-6">
                            <p class="font-semibold text-xl">Mobile Number</p>
                            <div class="py-4 flex flex-row gap-2">
                                <input type="number" class="p-2 bg-gray-100 border-gray-300 rounded border antialiased" disabled value=<?php echo $addr_row['addr_mobile_num']; ?> >
                            </div>
                        </div>
                        <div class="pt-6">
                            <p class="font-semibold text-xl">Date of Birth</p>
                            <div class="py-4 flex flex-row gap-2">
                                <input type="date" class="p-2 bg-gray-100 border-gray-300 rounded border antialiased" disabled value=<?php echo $addr_row['addr_dob']; ?> >
                            </div>
                        </div>
                        <button class="text-left my-4 text-blue-600 font-semibold" style="width:25%;">Delete Account</button>
                    </div>
                </div>
            </div>
          </div>
    </form>
</body>
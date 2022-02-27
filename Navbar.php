<?php
// Will be used later for autologin
$user_loggedin = false;

include "style.php";
include "helpers/db_connect.php";
include "helpers/autologin.php";
?>

<nav class="bg-white shadow text-black sticky top-0 pr-4 z-40">
        <div class="w-full py-2 mx-2">
            <div class="md:flex md:items-center md:justify-center gap-y-4">
                <div class="flex items-center flex-nowrap ">
                    <div class="text-xl font-semibold text-gray-700">
                        <a class="text-2xl font-bold  lg:text-4xl hover:text-gray-700 dark:hover:text-gray-300" href="index.php">The Sports Place</a>
                    </div>
                    <!-- Mobile menu button -->
                    <div class="flex md:hidden">
                        <button type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                            <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                                <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="w-1/2 h-10 ml-3">
                    <form action="search.php" name="search" method="get">
                        <input type="text" name="product_name" class="outline-none rounded-full bg-gray-200 h-full p-2" style="width:100%" />
                    </form>
                </div>
<?php // Only Show Avatar if user is logged in

if (
  isset($_SESSION["user_loggedin"]) &&
  $_SESSION["user_loggedin"] == true
) { ?>
            <!--
                    <div class="flex items-center mt-4 ml-4 md:mt-0">
                        <button type="button" class="flex items-center focus:outline-none h-14 w-14">
                            <a href="profile_info.php">
                                <img src="<?php echo $_SESSION[
                                  "grav_url"
                                ]; ?>" class="object-cover w-full h-full rounded-full" alt="avatar">
                            </a>
                        </button>
                    </div>
            -->
                    <div @click.away="open = false" class="relative ml-20" x-data="{ open: false }">
                        <button @mouseover="open = !open" class="flex flex-row items-center w-12 h-12 ml-4 rounded-full">
                            <img src="<?php echo $_SESSION[
                              "grav_url"
                            ]; ?>" class="object-cover w-full h-full rounded-full" alt="avatar">
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-64 drop-shadow-lg">
                          <div class="bg-white rounded-md shadow dark-mode:bg-gray-800">
                            <a class="block px-3 py-3 mt-2 text-md text-semibold rounded-md dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="profile_info.php">
                                <svg class="inline" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                My Profile</a>
                            <hr class="bg-gray-100">
                            <a class="block px-3 py-3 mt-2 text-md text-semibold rounded-md dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">
                            <svg class="inline" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zm-.5 1.5l1.96 2.5H17V9.5h2.5zM6 18c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm2.22-3c-.55-.61-1.33-1-2.22-1s-1.67.39-2.22 1H3V6h12v9H8.22zM18 18c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/></svg>
                            My Orders</a>
                            <hr class="bg-gray-100">
                            <a class="block px-3 py-3 mt-2 text-md text-semibold rounded-md dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="helpers/logout.php">
                                <svg class="inline" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><path d="M0,0h24v24H0V0z" fill="none"/></g><g><path d="M17,8l-1.41,1.41L17.17,11H9v2h8.17l-1.58,1.58L17,16l4-4L17,8z M5,5h7V3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h7v-2H5V5z"/></g></svg>
                                Logout</a>
                          </div>
                        </div>
                      </div>
                <?php } else { ?>
                                <div class="flex items-center py-2 -mx-1 md:mx-0">
                                    <a class="block w-1/2 px-3 py-2 mx-1 text-sm font-medium leading-5 text-center text-white transition-colors duration-200 transform bg-gray-500 rounded-md hover:bg-blue-600 md:mx-2 md:w-auto" href="Login.php">Login</a>
                                    <a class="block w-1/2 px-3 py-2 mx-1 text-sm font-medium leading-5 text-center text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-600 md:mx-0 md:w-auto" href="Signup.php">Signup</a>
                                </div>
                <?php } ?>
                <a href="cart.php" class="ml-5 text-2xl align-center relative ">
                    <svg class="inline w-10 h-10" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                    Cart
                    <?php if (
                      isset($_SESSION["user_loggedin"]) &&
                      $_SESSION["user_loggedin"] == true
                    ) {
                      $cart_items_result = $conn->query(
                        'SELECT * FROM cart WHERE user_id="' .
                          $_SESSION["user_id"] .
                          '"'
                      );
                      if ($cart_items_result->num_rows > 0) { ?>
                                <span class="items-center justify-center px-1 text-xs
                                            text-red-100 bg-red-600 rounded-full absolute left-0">
                                    <?php echo $cart_items_result->num_rows; ?>
                                </span>
                    <?php }
                    } ?>
                </a>
            </div>
        </div>
    </div>
</nav>

<script
  src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
  defer
></script>


<?php
// Will be used later for autologin
$user_loggedin = false;

include 'style.php';
include 'helpers/db_connect.php';
include 'helpers/autologin.php';
?>

<nav class="bg-white shadow dark:bg-gray-800 sticky top-0 pr-4">
        <div class="w-full py-2 mx-2">
            <div class="md:flex md:items-center md:justify-center">
                <div class="flex items-center flex-nowrap ">
                    <div class="text-xl font-semibold text-gray-700">
                        <a class="text-2xl font-bold text-gray-800 dark:text-white lg:text-4xl hover:text-gray-700 dark:hover:text-gray-300" href="index.php">The Sports Place</a>
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
<?php
    // Only Show Avatar if user is logged in
    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin'] == true) {
?>
                    <div class="flex items-center mt-4 md:mt-0">
                        <button type="button" class="flex items-center focus:outline-none" aria-label="toggle profile dropdown">
                            <div class="ml-5 h-16 w-16 overflow-hidden border-2 rounded-full">
                                <a href="profile_info.php">
                                    <img src="<?php echo $_SESSION['grav_url']; ?>" class="object-cover w-full h-full" alt="avatar">
                                </a>
                            </div>

                            <h3 class="mx-2 text-sm font-medium text-gray-700 dark:text-gray-200 md:hidden">Khatab wedaa</h3>
                        </button>
                    </div>
<?php
    }
    else {
        // Else show login / Signup Button
?>
                <div class="flex items-center py-2 -mx-1 md:mx-0">
                    <a class="block w-1/2 px-3 py-2 mx-1 text-sm font-medium leading-5 text-center text-white transition-colors duration-200 transform bg-gray-500 rounded-md hover:bg-blue-600 md:mx-2 md:w-auto" href="Login.php">Login</a>
                    <a class="block w-1/2 px-3 py-2 mx-1 text-sm font-medium leading-5 text-center text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-600 md:mx-0 md:w-auto" href="Signup.php">Signup</a>
                </div>
<?php
    }
?>
            </div>
        </div>
    </div>
</nav>
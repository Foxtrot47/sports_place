<?php
ob_start();
include "style.php";
include "helpers/db_connect.php";
// define variables and set to empty values
$email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["reg_success"]) && $_GET["reg_success"] == true) { ?>
        <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('success_auth_alert').classList.toggle('translate-y-32');
            return;
        });

        </script>
        <?php }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim_input($_POST["auth_email"]);
    $password = trim_input($_POST["auth_pass"]);

    // has joined username and password
    $hashed_pass = sha1($email . $password);

    // Get the hashed password of user
    $sql = 'SELECT * FROM users WHERE user_email="' . $email . '"';
    $result = $conn->query($sql);

    // Check if atlest 1 result exist
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Compare our hash with saved hash
        if ($hashed_pass == $row["user_password"]) {
            // Clear both cookie and session vars
            unset($_COOKIE["local_token"]);
            if (isset($_SESSION["session_id"])) {
                session_destroy();
            }
            // Hash email , password and current date and store as local token
            $local_token = sha1($email . $password . time() . rand(10, 100));
            $browser_info = get_browser(null, true);
            $platform_name = $browser_info["platform"];
            $browser_name = $browser_info["browser"];
            // add hashed platform name and browser to local token and update session token on sql record
            $session_token =
                $local_token . sha1($platform_name . $browser_name);

            $insert_q =
                'UPDATE users SET session_token ="' .
                $session_token .
                '" WHERE user_email="' .
                $email .
                '"';
            $result = $conn->query($insert_q);
            setcookie("local_token", $local_token, time() + 86400 * 120, "/");
            header("Location: " . "index.php");
        } else {
             ?>
            <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                document.getElementById('failed_auth_alert').classList.toggle('translate-y-32');
            });

            </script>
            <?php
        }
    } else {
         ?>
        <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('failed_auth_alert').classList.toggle('translate-y-32');
        });

        </script>
        <?php
    }
}

// function to trim useless contents from form data
function trim_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div>
    <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md
                dark:bg-gray-800 transform transition duration-500 ease-in-out"
        style="z-index:1;position:absolute;top:-10%;left:35%;" id="failed_auth_alert"
    >
        <div class="flex items-center justify-center w-12 bg-red-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"/>
            </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-red-500 dark:text-red-400">Error</span>
                <p class="text-sm text-gray-600 dark:text-gray-200">You typed wrong email or password</p>
            </div>
        </div>
    </div>

    <!-- Registration Success Alert -->
    <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md
                dark:bg-gray-800 transform transition duration-500 ease-in-out"
        style="z-index:1;position:absolute;top:-13%;left:35%;" id="success_auth_alert"
    >
        <div class="flex items-center justify-center w-12 bg-green-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"/>
            </svg>
        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-green-500 dark:text-green-400">Success</span>
                <p class="text-sm text-gray-600 dark:text-gray-200">Your account was registered!</p>
            </div>
        </div>
    </div>

    <div class="flex h-screen justify-center items-center">
        <div class="flex max-w-sm overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl w-full">
            <div class="hidden bg-cover lg:block lg:w-1/2" style="background-image:url('https://media.timeout.com/images/100479313/image.jpg')"></div>

            <div class="w-full px-6 py-8 md:px-8 lg:w-1/2">
                <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-white">The Sports Place</h2>

                <p class="text-xl text-center text-gray-600 dark:text-gray-200">Welcome back!</p>

                <form method="post" action="<?php echo htmlspecialchars(
                    $_SERVER["PHP_SELF"]
                ); ?>">

                    <div class="flex items-center justify-between mt-4">
                        <span class="w-1/5 border-b dark:border-gray-600 lg:w-1/4"></span>

                        <a class="text-xs text-center text-gray-500 uppercase dark:text-gray-400 ">Sign in with email</a>

                        <span class="w-1/5 border-b dark:border-gray-400 lg:w-1/4"></span>
                    </div>

                    <div class="mt-4">
                        <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200" for="auth_email">Email Address</label>
                        <input id="auth_email" name="auth_email" class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300
                                    rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500
                                    dark:focus:border-blue-500 focus:outline-none focus:ring" type="email"
                                onchange="validate()"
                        >
                        <p id="auth_email_error" class="text-red-500 text-sm"></p>
                    </div>

                    <div class="mt-4">
                        <div class="flex justify-between">
                            <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200" for="auth_pass">Password</label>
                            <!-- Dummy Since i don't have any mail service -->
                            <a href="#" class="text-xs text-gray-500 dark:text-gray-300 hover:underline">Forgot Password?</a>
                        </div>

                        <input id="auth_pass" name="auth_pass"
                            class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md
                                    dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500
                                    dark:focus:border-blue-500 focus:outline-none focus:ring" type="password"
                                onchange="validate()" >
                                <p id="auth_pass_error" class="text-red-500 text-sm"></p>
                    </div>

                    <div class="mt-8">
                        <button class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-gray-700
                                        rounded hover:bg-gray-600 focus:outline-none focus:bg-gray-600"
                                id="submit_button" disabled
                        >
                            Login
                        </button>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>

                        <a href="Signup.php" class="text-xs text-gray-500 uppercase dark:text-gray-400 hover:underline">or sign up</a>

                        <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function validate(){
        var email = document.getElementById('auth_email').value;
        var email_error = document.getElementById('auth_email_error');

        var password = document.getElementById('auth_pass').value;
        var pass_error = document.getElementById('auth_pass_error');

        var errorcount = 0;
        var password_regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
        var email_regex = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;

        if (email == "" || email == null) {
            email_error.innerHTML = "Email ID missing";
            errorcount++;
        }
        else if (email_regex.test(email) == false) {
            email_error.innerHTML = "Email ID invalid";
            errorcount++;
        }
        if (password == "" || password == null) {
            pass_error.innerHTML = "Password missing";
            errorcount++;
        }
        /*
        else if ((password.length < 7) || (password.length > 15)) {
            pass_error.innerHTML = "The password must be in between 8 - 15 digits. \n";
            errorcount++;
        }
        else if (password_regex.test(password) == false) {
            pass_error.innerHTML ="Password must contain at least one letter, one number and one special character";
            errorcount++;
        }
        */
        if (errorcount < 1) {
            email_error.innerHTML = pass_error.innerHTML = "";
            document.getElementById('submit_button').disabled = false;
        }
        else {
            document.getElementById('submit_button').disabled = true;
        }
    }
</script>


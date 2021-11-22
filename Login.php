<?php
include 'style.php';
include 'helpers/db_connect.php';

?>

<br><br >
<div class="flex max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl">
        <div class="hidden bg-cover lg:block lg:w-1/2" style="background-image:url('https://media.timeout.com/images/100479313/image.jpg')"></div>
        
        <div class="w-full px-6 py-8 md:px-8 lg:w-1/2">
            <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-white">The Sports Place</h2>

            <p class="text-xl text-center text-gray-600 dark:text-gray-200">Welcome back!</p>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <div class="flex items-center justify-between mt-4">
                    <span class="w-1/5 border-b dark:border-gray-600 lg:w-1/4"></span>

                    <a class="text-xs text-center text-gray-500 uppercase dark:text-gray-400 ">Sign in with email</a>

                    <span class="w-1/5 border-b dark:border-gray-400 lg:w-1/4"></span>
                </div>

                <div class="mt-4">
                    <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200" for="LoggingEmailAddress">Email Address</label>
                    <input id="auth_email" name="auth_email" class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" type="email">
                </div>

                <div class="mt-4">
                    <div class="flex justify-between">
                        <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200" for="auth_pass">Password</label>
                        <!-- Dummy Since i don't have any mail service -->
                        <a href="#" class="text-xs text-gray-500 dark:text-gray-300 hover:underline">Forgot Password?</a>
                    </div>

                    <input id="auth_pass" name="auth_pass" class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" type="password">
                </div>

                <div class="mt-8">
                    <button class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-gray-700 rounded hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
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

<?php
// define variables and set to empty values
$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim_input($_POST["auth_email"]);
    $password = trim_input($_POST["auth_pass"]);
    
    // has joined username and password
    $hashed_pass = sha1($email.$password);

    // Get the hashed password of user
    $sql = 'SELECT * FROM users WHERE user_email="' . $email . '"';
    $result = $conn->query($sql);

    // Check if atlest 1 result exist
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Compare our hash with saved hash
        if ( $hashed_pass == $row['user_password'] ) {
            // Currently Im just saving hash as cookie for autologin , This is very bad and ill fix it
            // TODO: Find a better way
            $_COOKIE['session_id'] = $hashed_pass;

            session_start();
            $_SESSION['user_email'] = $email;

            $user_loggedin = true;
        }
        else{
            die("Bad Creds");
        }
    }

}

// function to trim useless contents from form data
function trim_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

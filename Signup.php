<?php

include "style.php";
include 'helpers/db_connect.php';

?>

<br/><br/><br/>
<div class="flex max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl">
        <div class="hidden bg-cover lg:block lg:w-1/2" style="background-image:url('https://media.timeout.com/images/100479313/image.jpg')"></div>
        
        <div class="w-full px-6 py-3 md:px-4 lg:w-1/2">
            <h2 class="text-2xl font-semibold text-center text-gray-700 dark:text-white">The Sports Place</h2>

            <p class="text-xl text-center text-gray-600 dark:text-gray-200">Create your Account </p>
            <br/>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="mt-4 space-x-2">

                    <input name="signup_first_name" class="w-48 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                        type="text" placeholder="First name">

                    <input name="signup_last_name" style="width:210px;" class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                        type="text" placeholder="Last name">
                    <p id="signup_name_error" class="text-red-500 text-sm"></p>

                </div>
                <br/>

                <div class="mt-4">
                    <input name="signup_email" class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" 
                        type="email" placeholder="Enter Email">
                    <p id="signup_email_error" class="text-red-500 text-sm"></p>
                </div>
        
                <br/>

                <div class="mt-4 space-x-2">

                    <input name="signup_pass" class="w-48 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                        type="text" placeholder="Password">

                    <input name="signup_confirm_pass" class="w-48 px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                        type="text" placeholder="Confirm Password">
                    <p id="signup_pass_error" class="text-red-500 text-sm"></p>

                </div>
                <br/>
                <div class="mt-8">
                    <button class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-gray-700 rounded hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                        Signup
                    </button>
                </div>
                
                <div class="flex items-center justify-between mt-4">
                    <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>

                    <a href="Login.php" class="text-xs text-gray-500 uppercase dark:text-gray-400 hover:underline">or sign in</a>
                    
                    <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>
                </div>
            </form>
        </div>
</div>

<?php
// define variables and set to empty values
$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim_input($_POST["signup_email"]);
    $password = trim_input($_POST["signup_pass"]);
    
    $first_name = trim_input($_POST["signup_first_name"]);
    $last_name = trim_input($_POST["signup_last_name"]);

    // Check for duplicate mail
    $sql = 'SELECT * FROM users WHERE user_email="' . $email . '"';
    $result = $conn->query($sql);

    // Check if atlest 1 result exist
    if ($result->num_rows > 0) {

        ?>
        <script type="javascript">
            document.getElementById("signup_email_error").innerHTML = "
            An account with that email already exist. Please login or use diffrent email";
        </script>
        <?php
    }
    else {

        // hash of joined username and password
        $hashed_pass = sha1($email.$password);

        // Add entry to users table
        $sql = "INSERT INTO users (user_email , first_name , last_name , user_password) VALUES ( '$email','$first_name' , '$last_name' , '$hashed_pass' )";
        $result = $conn->query($sql);
        if ( $result > 0) {

            header("Location:login.php");
            exit();
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

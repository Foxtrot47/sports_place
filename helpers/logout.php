<?php
setcookie("local_token", null, -1, "/");
setcookie("PHPSESSID", null, -1, "/");
//unset($_COOKIE['local_token']);
if (isset($_SESSION["session_id"])) {
    $_SESSION["user_loggedin"] = false;
    session_destroy();
}
header("Location: " . "..\index.php");
?>

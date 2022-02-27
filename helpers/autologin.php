<?php
include "db_connect.php";
$user_loggedin = false;

if (
    isset($_COOKIE["local_token"]) &&
    !is_null($_COOKIE["local_token"]) &&
    !isset($_SESSION["session_id"])
) {
    $browser_info = get_browser(null, true);
    $platform_name = $browser_info["platform"];
    $browser_name = $browser_info["browser"];
    $local_token = $_COOKIE["local_token"];
    $session_token = $local_token . sha1($platform_name . $browser_name);

    $sql = 'SELECT * FROM users WHERE session_token="' . $session_token . '"';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["user_email"] = $row["user_email"];
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["first_name"] = $row["first_name"];
        $_SESSION["last_name"] = $row["last_name"];
        $_SESSION["session_id"] = $session_token;
        $_SESSION["user_loggedin"] = true;
        // Get user avatar
        $defaultimg =
            "https://static-assets-web.flixcart.com/www/linchpin/fk-cp-zion/img/profile-pic-male_4811a1.svg";
        $grav_size = 50;
        $_SESSION["grav_url"] =
            "https://www.gravatar.com/avatar/" .
            md5(strtolower(trim($_SESSION["user_email"]))) .
            "?d=" .
            "&s=" .
            $grav_size;
    }
}

?>

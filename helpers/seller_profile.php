<?php

// Enable CORS requests for our cleint side
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Credentials: true');

include "db_connect.php";

// Only take POST requests as GET is insecure
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("HTTP/1.1 403 Use POST to send requests");
    die();
  }

if (!isset($_POST["seller_session_token"]) || $_POST["seller_session_token"] == "" ) {
  header("HTTP/1.1 403 Session Token Missing");
  die();
}

$session_token = $_POST["seller_session_token"];

if (!isset($_POST['mode'])) {
  header("HTTP/1.1 404 Mode Not Specified");
  die();
}
$mode = trim_input($_POST['mode']);
$fetch_data = $conn->query(
    "SELECT * FROM sellers WHERE session_token='". $session_token . "'"
  );
if($fetch_data == false || $fetch_data->num_rows < 1){
  header("HTTP/1.1 403 Session Token Invalid");
  die();
}
if($mode == "view") {

    // To change email we need to rehash our combined email + password
    // So instead of asking password for changing only email
    // Ask by default, its not gonna hurt

    if(!isset($_POST['seller_password']) || $_POST['seller_password'] == "" ) {
        header("HTTP/1.1 403 Password Missing");
        die();
    }
    $seller_password = trim_input($_POST['seller_password']);
    while ($row = $fetch_data->fetch_assoc()) {
        $hashed_pass = sha1($row['seller_email'] . $seller_password);
        if($hashed_pass != $row['seller_password']){
            header("HTTP/1.1 403 Wrong Password");
            die();
        }
    }
    
    $seller_first_name = trim_input($_POST['seller_first_name']);
    $seller_last_name = trim_input($_POST['seller_last_name']);
    $seller_email = trim_input($_POST['seller_first_name']);
    $seller_gender = trim_input($_POST['seller_gender']);
    $seller_password_hash = sha1($seller_email . $seller_password );
    $update_data = $conn->query(
        "UPDATE sellers SET ". 
        "seller_first_name='". $seller_first_name . "', " .
        "seller_last_name='". $seller_last_name . "', " .
        "seller_email='". $seller_email . "', " .
        "seller_gender='". $seller_gender . "', " .
        "seller_password='". $seller_password_hash . "' "
      );
    if($update_data == false){
      header("HTTP/1.1 500 Something went wrong");
      die();
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
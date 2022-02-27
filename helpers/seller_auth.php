<?php

// Enable CORS requests for our cleint side
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Credentials: true');

include "db_connect.php";

// define variables and set to empty values
$email = $password = "";

// Only take POST requests as GET is insecure
if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("HTTP/1.1 403 Use POST to send requests");
  die();
}

// check for email and password
if(!isset($_POST["auth_email"]) || $_POST["auth_email"] == "" || !isset($_POST["auth_pass"]) || $_POST["auth_pass"] == "" ) {
  header("HTTP/1.1 403 Email and Password missing");
  die();
}

$email = trim_input($_POST["auth_email"]);
$password = trim_input($_POST["auth_pass"]);

// Hash joined username and password
$hashed_pass = sha1($email . $password);

// Check for rows in table with same email
$sql = 'SELECT * FROM sellers WHERE seller_email="' . $email . '"';
$res = $conn->query($sql);

// Check if atlest 1 result exist
if ($res->num_rows > 0) {

  // If we are signing in , send error
  if($_POST['sign_in'] === "false") {
    header("HTTP/1.1 403 Email is already used");
    die();
  }
  // Else take the result row
  $row = $res->fetch_assoc();
  
  // Compare our hash with saved hash
  if ($hashed_pass != $row["seller_password"]) {
    header("HTTP/1.1 403 Wrong Password");
    die();
  }
  // Check if seller is actually verified
  if ($row["verified"] != 1) {
    header("HTTP/1.1 403 Seller Not verified");
    die();
  }
  // For sellers we aren't implementing autologin , we will just make a session for this
  //Generate a random string.
  $token = openssl_random_pseudo_bytes(16);
  //Convert the binary data into hexadecimal representation.
  $token = bin2hex($token);
  //Store it in db
  $sql2 =
    'UPDATE sellers SET session_token ="' .
    $token .
    '" WHERE seller_email="' .
    $email .
    '"';
  $conn->query($sql2);

  $res = $conn->query($sql);
  // Doesn't fail cuz im sending the query again
  while ($row = $res->fetch_assoc()) {
    // Send all data to client side , so that they don't need to always make another request
    $out = array('seller_id'=> $row["seller_id"] ,'seller_email'=> $row["seller_email"],'first_name'=> $row["first_name"],'last_name'=> $row["last_name"],'seller_session_token'=> $token) ;

    // Send all the data as JSON for easier parsing with clientside
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($out);
    die();
  }
}
else if ($_POST['sign_in'] == 'true') {
  header("HTTP/1.1 403 Email does not exist in records");
}
// If user is trying to make a new account
else{
  
  $first_name = trim_input($_POST['auth_first_name']);
  $last_name = trim_input($_POST['auth_last_name']);
  $seller_org = trim_input($_POST['auth_org_name']);
  
  // Add entry to users table
  $sql = "INSERT INTO sellers (seller_email,first_name,last_name,seller_org,seller_password) 
          VALUES ( '$email','$first_name','$last_name' , '$seller_org', '$hashed_pass' )";
  $result = $conn->query($sql);
  if ($result == true) {
    header("HTTP/1.1 200 User successfully registered");
    
  } else {
  // Error 500 is Server Internal Error
    header("HTTP/1.1 500 Something went wrong");
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
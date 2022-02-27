<?php

header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json; charset=utf-8");

include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["session_token"]) ) {
      header("HTTP/1.1 403 Session Token Missing");
      die();
    }
    $session_token = $_POST["session_token"];
    
    $fetch_data = $conn->query(
      "SELECT * FROM users WHERE session_token='{$session_token}'"
    );
    if($fetch_data == false || $fetch_data->num_rows < 1){
      header("HTTP/1.1 403 Session Token Invalid");
      die();
    }
    $row = $fetch_data->fetch_assoc();
    $userid = $row['user_id'];

    $fetch_data = $conn->query(
        "SELECT * FROM orders WHERE user_id='{$userid}'"
    );
    if($fetch_data == false || $fetch_data->num_rows < 1){
      header("HTTP/1.1 404 No orders");
      die();
    }
    while ($order_list = $fetch_data->fetch_assoc()) {
      $order_array[] = $order_list;
    }
    echo json_encode($order_array);
}
else {
  header("HTTP/1.1 404 Use POST");
  die();
}

function trim_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

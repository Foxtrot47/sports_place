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
    $session_token = trim_input($_POST["session_token"]);
  
    if (!isset($_POST['mode'])) {
      header("HTTP/1.1 404 Mode Not Specified");
      die();
    }
    $mode = trim_input($_POST['mode']);
    
    $fetch_data = $conn->query(
      "SELECT * FROM users WHERE session_token='{$session_token}'"
    );
    if($fetch_data == false || $fetch_data->num_rows < 1){
      header("HTTP/1.1 403 Session Token Invalid");
      die();
    }
    $row = $fetch_data->fetch_assoc();
    $userid = $row['user_id'];

    if ($_POST['mode'] == "list") {
      $fetch_data = $conn->query(
          "SELECT * FROM cart WHERE user_id='{$userid}'"
      );
      if($fetch_data == false || $fetch_data->num_rows < 1){
        header("HTTP/1.1 404 No orders");
        die();
      }
      $total = 0;
      while ($order_list = $fetch_data->fetch_assoc()) {
        $order_array[] = $order_list;
        $total += (float)$order_list['total_price'] * $order_list['quantity'];
      }
      $order_array += array('total_price' => $total);
      echo json_encode($order_array);

    }
    else if ($_POST['mode'] == "update") {
      $productid = trim_input($_POST['productid']);
      $quantity = trim_input($_POST['quantity']);
      $save_for_later = trim_input($_POST['save_for_later']);
      $fetch_data = $conn->query(
        "SELECT * FROM cart WHERE user_id='{$userid}' AND product_id='{$productid}'"
      );
      if($fetch_data == false || $fetch_data->num_rows < 1){
        header("HTTP/1.1 403 Invalid Product id");
        die();
      }
      if ($quantity < 1)
        $update_data = $conn->query(
          "DELETE from cart WHERE product_id=${productid}"
        );
      else
      $update_data = $conn->query(
        "UPDATE cart SET quantity={$quantity}, save_for_later={$save_for_later} WHERE product_id=${productid}"
      );
      if ($update_data == false) {
        header("HTTP/1.1 500 Can't update db");
        die();
      }
      $fetch_data = $conn->query(
        "SELECT * FROM cart WHERE user_id='{$userid}'"
      );
      if($fetch_data == false || $fetch_data->num_rows < 1){
        header("HTTP/1.1 404 No orders");
        die();
      }
      $total = 0;
      while ($order_list = $fetch_data->fetch_assoc()) {
        $order_array[] = $order_list;
        $total += (float)$order_list['total_price'] * $order_list['quantity'];
      }
      $order_array += array('total_price' => $total);
      echo json_encode($order_array);
      }
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

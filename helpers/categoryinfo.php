<?php

header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json; charset=utf-8");

include "db_connect.php";

// Return all categories and subcategory info all at once
$res = [];
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
// Making sure the tables and rows still exist
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
    $res['categories'][] = $row;
    }
    $sql = "SELECT * FROM subcategories";
    $result = $conn->query($sql);
    // Making sure the tables and rows still exist
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $res['subcategories'][] = $row;
        }
        echo json_encode($res);
    }
    else {
        header("HTTP/1.1 500 Table Data Missing");
        die();
    }
}
else {
    header("HTTP/1.1 500 Table Data Missing");
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

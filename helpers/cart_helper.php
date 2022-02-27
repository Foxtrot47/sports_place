<?php
include "autologin.php";

if (!isset($_SESSION["user_loggedin"]) || !$_SESSION["user_loggedin"] == true) {
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $product_id = trim_input($_GET["product_id"]);
    $product_quantity = trim_input($_GET["product_quantity"]);
    $product_price = trim_input($_GET["product_quantity"]);
    $savelater = trim_input($_GET["savelater"]);

    $check_q = "SELECT * FROM cart  WHERE product_id=" . $product_id;
    $result = $conn->query($check_q);
    if ($result->num_rows < 1) {
        $add_q =
            'INSERT INTO cart ( user_id, product_id, quantity, price_per_unit, save_for_later) 
                  VALUES (' .
            $_SESSION["user_id"] .
            "," .
            $product_id .
            "," .
            $product_quantity .
            "," .
            $product_price .
            ",0)";
        $result = $conn->query($add_q);
    } else {
        if ($product_quantity < 1) {
            $sql = "DELETE FROM cart WHERE product_id=" . $product_id;
            $result = $conn->query($sql);
        }

        $sql =
            "UPDATE cart SET quantity =" .
            $product_quantity .
            " , save_for_later=" .
            $savelater .
            " WHERE product_id=" .
            $product_id;
        $result = $conn->query($sql);
        if ($product_quantity < 1) {
            $sql = "DELETE FROM cart WHERE product_id=" . $product_id;
            $result = $conn->query($sql);
        }
    }
}
// function to trim useless contents from data
function trim_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

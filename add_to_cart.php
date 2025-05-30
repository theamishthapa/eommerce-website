<?php
include_once 'db.php';
session_start();
if(!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
  }

  $product_id = $_GET['id'];

  $result = Query("SELECT * FROM orders where user_id = ".$_SESSION['id'] . " AND " . "product_id = ".$_GET['id']);

  $quantity = $result ? $result[0]['quantity']+1 : 1;


// Insert into cart
if($result) {
  $sql = "UPDATE orders SET quantity = ? WHERE user_id = ? AND product_id= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iii", $quantity, $_SESSION['id'], $product_id);
}
else{
  $sql = "INSERT INTO orders(user_id,product_id, quantity) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iii", $_SESSION['id'], $product_id, $quantity);
}


if($stmt->execute()) {
    header("Location: cart.php");
} else {
    echo "Error adding product to cart: " . $conn->error;
}

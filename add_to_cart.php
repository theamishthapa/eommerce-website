<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "ecommerce");

// Check for errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Read POST data
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'] ?? 1;

// Insert into cart
$sql = "INSERT INTO cart (product_id, quantity) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $product_id, $quantity);
$stmt->execute();

echo json_encode(["success" => true]);
?>

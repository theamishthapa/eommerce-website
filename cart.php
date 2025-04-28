<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ecom.css">
</head>
<body>
    

<?php
include_once 'db.php';
$result = Query("SELECT * FROM orders");


foreach($result as $row) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];

    // Fetch product details
    $product_result = Query("SELECT * FROM products WHERE id = ".$product_id);
    if($product_result) {
        $product = $product_result[0];
    ?>
    <div class="cart-item">
    <div class="cart-item-image">
        <img src="./images/<?php echo $product['image_url'] ?>" alt="heels">
    </div>
    <div class="cart-item-details">
        <span class="product-name"><?php echo $product['name'] ?></span>
        <span class="product-quantity">Quantity: <?php echo $quantity ?> </span>
        <span class="product-amount">Amount: <?php echo $quantity*$product['price'] ?> </span>
        <a href="removeitem.php?id=<?php echo $product['id'] ?>" class="remove-link">Remove</a>
    </div>
</div>
    <?php
    }
}
?>

</body>
</html>
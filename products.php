<div class="product-grid">
<?php
$result = Query("SELECT * FROM products");
?>
<?php
foreach($result as $row) {
?>
<div
  class="product-card"
  onclick="showProductDetail(<?php 
  echo '\'' . $row['name'] . '\', \'./images/' . $row['image_url'] . '\', \'' . $row['description'] . '\', \'add_to_cart.php?id=' . $row['id'] . '\'';
  ?>)"
  >
  <img src="./images/<?php echo $row['image_url'] ?> " alt="<?php echo $row['image_url'] ?>" />
  <h4><?php echo $row['name'] ?></h4>
  <a class="add-btn" href="add_to_cart.php?id=<?php echo $row['id'] ?>">
    Add to Cart
  </a>
</div>
<?php    
}
?>
  </div>

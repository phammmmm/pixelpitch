<?php
require_once 'config.php';
require_once '../Server/ProductController.php';
$db_handle = new ProductController();

$product = $db_handle->getProductById($_GET["product_id"]);
if (! empty($product)) {
?>  
      <div class="preview-image">
        <img src="<?php echo URLROOT."/../".$product["product_image"] ; ?>" />
      </div>
      <div class="product-info">
          <div class="product-title"><?php echo $product["product_title"] ; ?></div>
          <div class="product-category"><?php echo $product["category"] ; ?></div>
          <div class="product-desc"><?php echo $product["product_description"] ; ?></div>
          <div>$<?php echo $product["product_price"] ; ?></div>
      </div>      
<?php
}
?>
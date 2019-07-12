<?php
include 'dbcontroller.php';
$db_handle = new DBController();
$query = "select product_id,product_title,c.cat_title as category, product_description,product_quantity,product_price,product_image from products p,categories c where p.product_category_id=c.cat_id and product_id='". $_GET["product_id"]."'";
$result = $db_handle->runQuery($query);
if (! empty($result)) {
?>  
      <div class="preview-image">
        <img src="<?php echo $result[0]["product_image"] ; ?>" />
      </div>
      <div class="product-info">
          <div class="product-title"><?php echo $result[0]["product_title"] ; ?></div>
          <div class="product-category"><?php echo $result[0]["category"] ; ?></div>
          <div class="product-desc"><?php echo $result[0]["product_description"] ; ?></div>
          <div><?php echo $result[0]["product_price"] ; ?> USD</div>
      </div>      
<?php
}
?>
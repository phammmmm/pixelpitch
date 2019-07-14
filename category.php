<?php
include 'dbcontroller.php';
$db_handle = new DBController();
$query = "select * from products where product_category_id = '". $_GET["cat_id"]."'";

$product_array = $db_handle->runQuery($query);
if (!empty($product_array)) { 
	foreach($product_array as $key=>$value){
?>
		<div class="product-item">
			<form method="post" action="products.php?action=add&product_id=<?php echo $product_array[$key]["product_id"]; ?>">
				<div class="product-image"><img src="<?php echo $product_array[$key]["product_image"]; ?>"></div>
				<div class="product-tile-footer">
				<div class="product-title"><?php echo $product_array[$key]["product_title"]; ?></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["product_price"]; ?></div>
				<div class="cart-action">
					<?php 
						if($product_array[$key]["product_quantity"]>0){
							?>
							<input type="number" class="product-quantity" name="quantity" value="1" min="1" max="<?php echo $product_array[$key]["product_quantity"];?>" />
							<input type="submit" value="Add to Cart" class="btnAddAction" />
							<?php
						}else{
							?>
							<input type="button" value="Out of Stock" class="btnAddAction" />
							<?php
							
						}
							?>
				</div>
				</div>
			</form>
			<button class="quick_look" data-id="<?php echo $product_array[$key]["product_id"];  ?>">View Details</button>
		</div>
<?php
  }
}
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/product.js"></script>
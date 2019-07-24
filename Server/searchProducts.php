<?php
require_once("../Server/ProductController.php");
$controller = new ProductController();
$keyword = "";
if(!empty($_GET["keyword"])) {
	$keyword = $_GET['keyword'];
}
$product_array = $controller->searchProducts($keyword);
if (!empty($product_array)) { 
	foreach($product_array as $key=>$value){
?>
		<div class="product-item">
			<form method="post" action="products.php?action=add&product_id=<?php echo $product_array[$key]["product_id"]; ?>">
				<div class="product-image"><img src="<?php echo "../".$product_array[$key]["product_image"]; ?>"></div>
				<div class="product-tile-footer">
				<div class="product-title"><?php echo $product_array[$key]["product_title"]; ?></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["product_price"]; ?></div>
				<div class="cart-action">
					<?php 
						if($product_array[$key]["product_quantity"]>0){
							?>
							<input type="number" class="product-quantity" id="qty_<?php echo $product_array[$key]["product_id"]; ?>" name="quantity" value="1" min="1" max="<?php echo $product_array[$key]["product_quantity"];?>" />
							<input type="button" value="Buy Now" class="btnAddAction" onClick = "cartAction('add','<?php echo $product_array[$key]["product_id"]; ?>')"/>
			
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
			<button class="quick_look" data-id="<?php echo $product_array[$key]["product_id"];  ?>">Quick Look</button>
		</div>
<?php
  }
}
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/product.js"></script>
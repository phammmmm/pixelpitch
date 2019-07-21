<?php require 'header.php'; ?>
<?php
require_once("../Server/ProductController.php");
$controller = new ProductController();
if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
			if(!empty($_POST["quantity"])) {
				
				$product = $controller->getProductById($_GET["product_id"] );


				$itemArray = array($product["product_id"]=>array('product_id'=>$product["product_id"],'name'=>$product["product_title"], 'category'=>$product["category"], 'quantity'=>$_POST["quantity"], 'price'=>$product["product_price"], 'image'=>$product["product_image"]));
			
				if(!empty($_SESSION["cart_item"])) {
					
					if(in_array($product["product_id"],array_keys($_SESSION["cart_item"]))) {
						foreach($_SESSION["cart_item"] as $k => $v) {
								if($product["product_id"] == $v["product_id"]) {
									if(empty($_SESSION["cart_item"][$k]["quantity"])) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
								}
						}
					} else {
						$_SESSION["cart_item"] = $_SESSION["cart_item"]+$itemArray;
						header("location: cart.php");
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
					header("location: cart.php");
				}
			}
		break;
	}
}

?>
<div id="product_preview"></div>
<div id="product-grid">
	<div id="menu">
		<div class="txt-heading">Products</div>
		<div class="search">
			<form action="products.php" method="POST">
					<input type="text" name="keyword" placeholder="Search tee">
					<button type="submit" value="search">Search</button>
			</form>
		</div>
		<div class="txt-heading">Categories</div>
		<div id="vertical-menu">
		<ul class="nav nav-pills flex-column">
  	
				<?php
				$query = "select cat_id, cat_title from categories";
				$catArray = $controller->runQuery($query);
				if (! empty($catArray)) {
					foreach($catArray as $key=>$value) {
				?>  
						<li class="nav-item">
							<a class="nav-link cat_button" data-id="<?php echo $catArray[$key]["cat_id"];  ?>">
								<?php echo $catArray[$key]["cat_title"]; ?>
							</a>
						</li>
				<?php
					}
				}
				?>
				</ul>
		</div>
	</div>
	<div id="product-list">
	<?php
	$keyword="";
	if(!empty($_POST["keyword"])) {
		$keyword = $_POST['keyword'];
	}
	$product_array = $controller->searchProducts($keyword);
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="products.php?action=add&product_id=<?php echo $product_array[$key]["product_id"]; ?>">
				<div class="product-image"><img src="<?php echo URLROOT."/../".$product_array[$key]["product_image"]; ?>"></div>
				<div class="product-title"><?php echo $product_array[$key]["product_title"]; ?></div>
				<div class="product-tile-footer">
				<div class="product-price"><?php echo "$".$product_array[$key]["product_price"]; ?></div>
				<div class="cart-action">
					<?php 
						if($product_array[$key]["product_quantity"]>0){
							?>
							<input type="number" class="product-quantity" name="quantity" value="1" min="1" max="<?php echo $product_array[$key]["product_quantity"];?>" />
							<input type="submit" value="Add to cart" class="btnAddAction" />
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
	</div>
</div>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/product.js"></script>
<?php require 'footer.php'; ?>
<?php require 'header.php'; ?>
<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
			if(!empty($_POST["quantity"])) {
				
				$productById = $db_handle->runQuery("select product_id,product_title,c.cat_title as category,product_quantity,product_price,product_image from products p,categories c where p.product_category_id=c.cat_id and product_id='" . $_GET["product_id"] . "'");


				$itemArray = array($productById[0]["product_id"]=>array('product_id'=>$productById[0]["product_id"],'name'=>$productById[0]["product_title"], 'category'=>$productById[0]["category"], 'quantity'=>$_POST["quantity"], 'price'=>$productById[0]["product_price"], 'image'=>$productById[0]["product_image"]));
			
				if(!empty($_SESSION["cart_item"])) {
					
					if(in_array($productById[0]["product_id"],array_keys($_SESSION["cart_item"]))) {
						foreach($_SESSION["cart_item"] as $k => $v) {
								if($productById[0]["product_id"] == $v["product_id"]) {
									if(empty($_SESSION["cart_item"][$k]["quantity"])) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
								}
						}
					} else {
						$_SESSION["cart_item"] = $_SESSION["cart_item"]+$itemArray;
						print("Item added to cart");
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
					print("Item added to cart");
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
		<div class="categories">
				<?php
				require_once("dbcontroller.php");
				$db_handle = new DBController();
				$query = "select cat_id, cat_title from categories";
				$catArray = $db_handle->runQuery($query);
				if (! empty($catArray)) {
					foreach($catArray as $key=>$value) {
				?>  
							<div>
								<button class="cat_button" data-id="<?php echo $catArray[$key]["cat_id"];  ?>">
							<?php echo $catArray[$key]["cat_title"]; ?>
								</button>
							</div>
							
				<?php
					}
				}
				?>
		</div>
	</div>
	<div id="product-list">
	<?php
	$query="SELECT * FROM products ORDER BY product_id ASC";
	if(!empty($_POST["keyword"])) {
		$keyword = $_POST['keyword'];
		$query = "SELECT * FROM `products` WHERE product_description LIKE '%".$keyword."%' OR product_title LIKE '%".$keyword."%'";
	}
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
					<input type="number" class="product-quantity" name="quantity" value="1" min="1" max="100" />
					<input type="submit" value="Add to Cart" class="btnAddAction" /></div>
				</div>
			</form>
			<button class="quick_look" data-id="<?php echo $product_array[$key]["product_id"];  ?>">View Details</button>
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
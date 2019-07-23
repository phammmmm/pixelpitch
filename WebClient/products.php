<?php require 'header.php'; ?>
<script>

</script>
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
				<input type="text" id="keyword" class ="searchBox" name="keyword" placeholder="Search Tee...">
				<button id="searchTee" onclick="searchTee();">Search</button>
		</div>
		<div class="txt-heading">Categories</div>
		<div id="vertical-menu">
		<ul class="nav nav-pills flex-column">
  	
				<?php
				
				$catArray = $controller->findCategories();
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
	
	</div>
</div>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/product.js"></script>
<script>
	searchTee();
</script>
<?php require 'footer.php'; ?>
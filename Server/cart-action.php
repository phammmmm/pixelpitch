<?php
if(!isset($_SESSION)){
  session_start();
}
require_once("../Server/ProductController.php");
$controller = new ProductController();
if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
			if(!empty($_GET["quantity"])) {
				
				$product = $controller->getProductById($_GET["product_id"] );


				$itemArray = array($product["product_id"]=>array('product_id'=>$product["product_id"],'name'=>$product["product_title"], 'category'=>$product["category"], 'quantity'=>$_GET["quantity"], 'price'=>$product["product_price"], 'image'=>$product["product_image"]));
				if(!empty($_SESSION["cart_item"])) {
					
					if(in_array($product["product_id"],array_keys($_SESSION["cart_item"]))) {
						foreach($_SESSION["cart_item"] as $k => $v) {
								if($product["product_id"] == $v["product_id"]) {
									if(empty($_SESSION["cart_item"][$k]["quantity"])) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $_GET["quantity"];
								}
            }
            
					} else {
						$_SESSION["cart_item"] = $_SESSION["cart_item"]+$itemArray;
						
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
        }
			}
      break;
    case "remove":
			if (!empty($_SESSION["cart_item"])) {

				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($_GET["product_id"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if (empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
				}
			}
			break;
		case "empty":
			unset($_SESSION["cart_item"]);
			break;

		case "checkout":
			if (isset($_SESSION["customer_id"])) {
				header("location: checkout.php");
			} else {
				header("location: login.php");
			}
			break;
	}
}
?>
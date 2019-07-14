<?php
require_once 'DBController.php';
class ProductController extends DBController{
  	//Product Functions
	function getProductById($productId){
		$query = "select product_id,product_title,c.cat_title as category, product_description,product_quantity,product_price,product_image from products p,categories c where p.product_category_id=c.cat_id and product_id='". $productId."'";
		return $this->singleResult($query);
	}
}
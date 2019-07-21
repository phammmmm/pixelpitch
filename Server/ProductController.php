<?php
require_once 'DBController.php';
class ProductController extends DBController{
  	//Product Functions
	function getProductById($productId){
		$query = "select product_id,product_title,c.cat_title as category, product_description,product_quantity,product_price,product_image from products p,categories c where p.product_category_id=c.cat_id and product_id='". $productId."'";
		return $this->singleResult($query);
	}
	function findProductsByCategory($categoryId){
		$query = "select * from products where product_category_id =". $categoryId;
		return $this->runQuery($query);
	}
	function searchProducts($keyword){
		$query="SELECT * FROM products ORDER BY product_id ASC";
		if(!empty($keyword)) {
			$query = "SELECT * FROM `products` WHERE product_description LIKE '%".$keyword."%' OR product_title LIKE '%".$keyword."%'";
		}
		return $this->runQuery($query);
	}
	function findCategories(){
		$query = "select cat_id, cat_title from categories";
		return $this->runQuery($query);
	}
}
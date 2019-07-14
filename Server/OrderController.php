<?php
require_once 'DBController.php';
class OrderController extends DBController{
	//Orders Functions
	function getOrdersByCustomerId($customerId){
		$sql = "Select * from orders where customer_id=".$customerId;
		return $this->runQuery($sql);
	}
	function getOrderDetailsByOrderno($orderNo){
		$get_orderDetails = "select p.product_title , od.product_price , od.product_quantity  from orderDetails od left join products p on od.product_id = p.product_id where order_no=".$orderNo;
		return $this->runQuery($get_orderDetails);
	}
	function createNewOrder($cust_id,$total_price){
		$insert_order = "INSERT INTO orders (customer_id, order_amount) VALUES ('".$cust_id."','".$total_price."')";
		if($this->executeUpdate($insert_order)){
			return mysqli_insert_id($this->getConnection());
		}else{
			return 0;
		}
	}

	function fillOrderDetails($order_no,$product_id,$price,$quantity){
		$insert_orderDetails = "INSERT INTO orderDetails (order_no,product_id, product_price, product_quantity) VALUES ('".$order_no."','".$product_id."','".$price."','".$quantity."')";
    //Insert Order Details
    $this->executeUpdate($insert_orderDetails);
    //Update Products table, deduct quanity
    $update_products_quantity = "UPDATE products set product_quantity=product_quantity- ".$quantity." where product_id=".$product_id;
    $this->executeUpdate($update_products_quantity);
	}
}
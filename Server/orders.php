<?php
require_once("../Server/OrderController.php");
$controller = new OrderController();
if(!isset($_SESSION)){
  session_start();
}
if (!isset($_SESSION["customer_id"])) {
  header("location: login.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (!empty($_SESSION["cart_item"])) {
    $total_price = 0;
    foreach ($_SESSION["cart_item"] as $item) {
			$total_price += ($item["price"] * $item["quantity"]);
    }
    $cust_id=$_SESSION["customer_id"];

    // Insert Order
    if($order_no =$controller->createNewOrder($cust_id,$total_price)){
      foreach ($_SESSION["cart_item"] as $item) {
				$controller->fillOrderDetails($order_no,$item["product_id"],$item["price"],$item["quantity"]);
      }
      unset($_SESSION["cart_item"]);
      echo "<h3>Thank you for your purchase.</h3>";
      echo "<p>Your order has been processed.</p>";
    } else{
        echo "Something went wrong. Please try again later.";
    }
  }
}

?>
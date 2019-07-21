<?php require 'header.php'; ?>
<?php
if (!isset($_SESSION["customer_id"])) {
  header("location: login.php");
}
require_once("../Server/OrderController.php");
$controller = new OrderController();
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
      header("location: receipt.php");
    } else{
        echo "Something went wrong. Please try again later.";
    }
  }
}

?>

<h1>Checkout</h1>
<div class="txt-heading">Shipping Information</div>
<p> Name: <?php echo $_SESSION["customer_firstName"]." ".$_SESSION["customer_lastName"]; ?></p>
<p> Contact: <?php echo $_SESSION["customer_contact"]; ?></p>
<p> Address: <?php echo $_SESSION["customer_address"]; ?></p>
<p> Email: <?php echo $_SESSION["customer_email"]; ?></p>

<div class="txt-heading">Order Details</div>
<?php
	if (isset($_SESSION["cart_item"])) {
		$total_quantity = 0;
		$total_price = 0;
    ?>
    <form id="orderForm" action="checkout.php" method="POST">
    <div class="table">
				<div class="theader">
					<div class="table_header">Name</div>
					<div class="table_header">Category</div>
					<div class="table_header">Quantity</div>
					<div class="table_header">Unit Price</div>
					<div class="table_header">Price</div>
				</div>
				<?php
				foreach ($_SESSION["cart_item"] as $item) {
					$item_price = $item["quantity"] * $item["price"];
					?>
					<div class='table_row'>
						<div class='table_small'>
							<div class='table_cell'>Name</div>
							<div class='table_cell'><img src="<?php echo URLROOT."/../".$item["image"]; ?>" class="cart-item-image" /><br><?php echo $item["name"]; ?></div>
						</div>
						
						<div class='table_small'>
							<div class='table_cell'>Category</div>
							<div class='table_cell'><?php echo $item["category"]; ?></div>
						</div>
						<div class='table_small'>
							<div class='table_cell'>Quantity</div>
							<div class='table_cell'><?php echo $item["quantity"]; ?></div>
						</div>
						<div class='table_small'>
							<div class='table_cell'>Unit Price</div>
							<div class='table_cell'><?php echo "$ " . $item["price"]; ?></div>
						</div>
						<div class='table_small'>
							<div class='table_cell'>Price</div>
							<div class='table_cell'><?php echo "$ " . number_format($item_price, 2); ?></div>
						</div>
				</div>
					<?php
					$total_quantity += $item["quantity"];
					$total_price += ($item["price"] * $item["quantity"]);
				}
				?>
				<div class='table_row'>

					<div class='table_small'>
						<div class='table_cell'></div>
						<div class='table_cell'>Total:</div>
					</div>
					<div class='table_small'>
							<div class='table_cell'></div>
							<div class='table_cell'></div>
					</div>
					<div class='table_small'>
						<div class='table_cell'>Total Quantity</div>
						<div class='table_cell'><?php echo $total_quantity; ?></div>
					</div>
					<div class='table_small'>
							<div class='table_cell'></div>
							<div class='table_cell'></div>
					</div>
					<div class='table_small'>
						<div class='table_cell'>Total Price</div>	
						<div class='table_cell'><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></div>
					</div>
					<div class='table_small'>
							<div class='table_cell'></div>
							<div class='table_cell'></div>
					</div>
			</div>

		</div>

		<div class="txt-heading"><input type="submit" class="btnCheck" value="Confirm Order"></div>
    </form>
<?php
	} else {
		?>
		<div class="no-records">No Item</div>
	<?php
  }
	?>
<?php require 'footer.php'; ?>
<?php require 'header.php'; ?>

<?php
if (!empty($_GET["action"])) {
	switch ($_GET["action"]) {
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


<div id="shopping-cart">
	<div class="txt-heading">Shopping Cart</div>

	<a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
	<?php
	if (isset($_SESSION["cart_item"])) {
		$total_quantity = 0;
		$total_price = 0;
		?>
		<div class="table">
			<div class="theader">
				<div class="table_header">Name</div>
				<div class="table_header">Category</div>
				<div class="table_header">Quantity</div>
				<div class="table_header">Unit Price</div>
				<div class="table_header">Price</div>
				<div class="table_header">Remove</div>
			</div>	

				<?php
				foreach ($_SESSION["cart_item"] as $item) {
					$item_price = $item["quantity"] * $item["price"];
					?>
					<div class='table_row'>
					<div class='table_small'>
						<div class='table_cell'>Name</div>
						<div class='table_cell'><img src="<?php echo URLROOT."/../".$item["image"]; ?>" class="cart-item-image" /><br><?php echo $item["name"]; ?>
						</div>
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
					<div class='table_small'>
						<div class='table_cell'>Remove</div>
						<div class='table_cell'><a href="cart.php?action=remove&product_id=<?php echo $item["product_id"]; ?>" class="btnRemoveAction"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
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
		<div class="txt-heading">
			<a id="btnCheckout" class="btnCheck" href="cart.php?action=checkout">Place Order</a>
		</div>
	<?php
	} else {
		?>
		<div class="no-records">Your Cart is Empty</div>
	<?php
	}
	?>
</div>
<?php require 'footer.php'; ?>
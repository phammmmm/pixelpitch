<?php require 'header.php'; ?>

<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
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
		<table class="tbl-cart" cellpadding="10" cellspacing="1">
			<tbody>
				<tr>
					<th>Name</th>
					<th>Category</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Price</th>
					<th>Remove</th>
				</tr>
				<?php
				foreach ($_SESSION["cart_item"] as $item) {
					$item_price = $item["quantity"] * $item["price"];
					?>
					<tr>
						<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
						<td><?php echo $item["category"]; ?></td>
						<td><?php echo $item["quantity"]; ?></td>
						<td><?php echo "$ " . $item["price"]; ?></td>
						<td><?php echo "$ " . number_format($item_price, 2); ?></td>
						<td><a href="cart.php?action=remove&product_id=<?php echo $item["product_id"]; ?>" class="btnRemoveAction"><img src="img/icon-delete.png" alt="Remove Item" /></a></td>
					</tr>
					<?php
					$total_quantity += $item["quantity"];
					$total_price += ($item["price"] * $item["quantity"]);
				}
				?>

				<tr>
					<td colspan="2" >Total:</td>
					<td><?php echo $total_quantity; ?></td>
					<td colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
					<td></td>
				</tr>
			</tbody>
		</table>

		<a id="btnCheckout" class="btnCheck" href="cart.php?action=checkout">Place Order</a>

	<?php
	} else {
		?>
		<div class="no-records">Your Cart is Empty</div>
	<?php
	}
	?>
</div>
<?php require 'footer.php'; ?>
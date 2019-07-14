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
    <table class="tbl-cart" cellpadding="10" cellspacing="1">
			<tbody>
				<tr>
					<th>Name</th>
					<th>Category</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Price</th>
				</tr>
				<?php
				foreach ($_SESSION["cart_item"] as $item) {
					$item_price = $item["quantity"] * $item["price"];
					?>
					<tr>
						<td><img src="<?php echo URLROOT."/../".$item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
						<td><?php echo $item["category"]; ?></td>
						<td ><?php echo $item["quantity"]; ?></td>
						<td ><?php echo "$ " . $item["price"]; ?></td>
						<td ><?php echo "$ " . number_format($item_price, 2); ?></td>
					</tr>
					<?php
					$total_quantity += $item["quantity"];
					$total_price += ($item["price"] * $item["quantity"]);
				}
				?>

				<tr>
					<td colspan="2">Total:</td>
					<td ><?php echo $total_quantity; ?></td>
					<td colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
					<td></td>
				</tr>
			</tbody>
		</table>
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
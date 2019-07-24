<?php require 'header.php'; ?>
<?php

if (!isset($_SESSION["customer_id"])) {
  header("location: login.php");
}
?>
<div id="checkout">
	<h1>Checkout</h1>
	<div class="txt-heading">Shipping Information</div>
	<p> Name: <?php echo $_SESSION["customer_firstName"]." ".$_SESSION["customer_lastName"]; ?></p>
	<p> Contact: <?php echo $_SESSION["customer_contact"]; ?></p>
	<p> Address: <?php echo $_SESSION["customer_address"]; ?></p>
	<p> Email: <?php echo $_SESSION["customer_email"]; ?></p>

	<div class="txt-heading">Order Details</div>
	<div id="cart-items">
	</div>
	<div class="txt-heading"><a onclick="placeOrder();" class="btnCheck">Confirm Order</a></div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/product.js"></script>
<script>
	populateCart();
</script>
<?php require 'footer.php'; ?>
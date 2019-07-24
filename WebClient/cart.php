<?php require 'header.php'; ?>

<div id="shopping-cart">
	<div class="txt-heading">Shopping Cart</div>

	<a id="btnEmpty" onClick="cartAction('empty','0')">Empty Cart</a>
	<div id="cart-items">
	</div>
	<div class="txt-heading"><a id="btnCheckout" class="btnCheck" href="checkout.php">Place Order</a>
	</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/product.js"></script>
<script>
	populateCart();
</script>
<?php require 'footer.php'; ?>
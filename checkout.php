<?php require 'header.php'; ?>
<?php
if (!isset($_SESSION["customer_id"])) {
  header("location: login.php");
}
require_once("dbcontroller.php");
$db_handle = new DBController();
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (!empty($_SESSION["cart_item"])) {
    $total_price = 0;
    foreach ($_SESSION["cart_item"] as $item) {
			$total_price += ($item["price"] * $item["quantity"]);
    }
    $cust_id=$_SESSION["customer_id"];
          // Prepare an insert statement
    $insert_order = "INSERT INTO orders (customer_id, order_amount) VALUES ('".$cust_id."','".$total_price."')";

    // Insert Order
    if($db_handle->executeUpdate($insert_order)){
      $order_id = mysqli_insert_id($db_handle->getConnection());
      foreach ($_SESSION["cart_item"] as $item) {
        $insert_orderDetails = "INSERT INTO orderDetails (order_no,product_id, product_price, product_quantity) VALUES ('".$order_id."','".$item["product_id"]."','".$item["price"]."','".$item["quantity"]."')";
        //Insert Order Details
        $db_handle->executeUpdate($insert_orderDetails);
        //Update Products table, deduct quanity
        $update_products_quantity = "UPDATE products set product_quantity=product_quantity- ".$item["quantity"]." where product_id=".$item["product_id"];
        $db_handle->executeUpdate($update_products_quantity);
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
					<th style="text-align:left;">Name</th>
					<th style="text-align:left;">Category</th>
					<th style="text-align:right;" width="5%">Quantity</th>
					<th style="text-align:right;" width="10%">Unit Price</th>
					<th style="text-align:right;" width="10%">Price</th>
				</tr>
				<?php
				foreach ($_SESSION["cart_item"] as $item) {
					$item_price = $item["quantity"] * $item["price"];
					?>
					<tr>
						<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
						<td><?php echo $item["category"]; ?></td>
						<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
						<td style="text-align:right;"><?php echo "$ " . $item["price"]; ?></td>
						<td style="text-align:right;"><?php echo "$ " . number_format($item_price, 2); ?></td>
					</tr>
					<?php
					$total_quantity += $item["quantity"];
					$total_price += ($item["price"] * $item["quantity"]);
				}
				?>

				<tr>
					<td colspan="2" align="right">Total:</td>
					<td align="right"><?php echo $total_quantity; ?></td>
					<td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
					<td></td>
				</tr>
			</tbody>
    </table>
    <input type="submit" class="btnCheck" value="Confirm Order">
    </form>
<?php
	} else {
		?>
		<div class="no-records">No Item</div>
	<?php
  }
  ?>
<?php require 'footer.php'; ?>
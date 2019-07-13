<?php require 'header.php'; ?>

<?php
if (!isset($_SESSION["customer_id"])) {
  header("location: login.php");
}
require_once("dbcontroller.php");
$db_handle = new DBController();
$sql = "Select * from orders where customer_id=".$_SESSION["customer_id"];
$result=$db_handle->runQuery($sql);
?>
<div class="txt-heading">Your Past Purchase</div>
<table class="tbl-cart" cellpadding="10" cellspacing="1">
			<tbody>
				<tr>
					<th style="text-align:left;">Order Date</th>
					<th style="text-align:right;" width="10%">Order Amount</th>
				</tr>
<?php
foreach($result as $order){
  ?>
  <tr>
    <td><?php echo $order['order_date'];?></td>
    <td><?php echo $order['order_amount'];?></td>
  </tr>
  <?php
}
?>
<?php require 'footer.php'; ?>
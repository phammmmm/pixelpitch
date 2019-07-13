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
          <th>Order ID</th>
          <th>Order Amount</th>
					<th>Order Date</th>
				</tr>
<?php
if($db_handle->numRows($sql)>0){
  foreach($result as $order){
    ?>
    <tr>
      <td><?php echo $order['order_no'];?></td>
      <td>$<?php echo $order['order_amount'];?></td>
      <td><?php echo $order['order_date'];?></td>
    </tr>
    <?php
  }
}
?>
<?php require 'footer.php'; ?>
<?php require 'header.php'; ?>

<?php
if (!isset($_SESSION["customer_id"])) {
  header("location: login.php");
}
require_once("../Server/OrderController.php");
$controller = new OrderController();
$orders=$controller->getOrdersByCustomerId($_SESSION["customer_id"]);
?>
<div class="txt-heading">Your Past Orders</div>
<table class="tbl-cart" cellpadding="10" cellspacing="1">
			<tbody>
				<tr>
          <th>Order ID</th>
          <th>Order Amount</th>
          <th>Order Date</th>
          <th>Order Details</th>
				</tr>
<?php
if(!empty($orders)){
  foreach($orders as $order){
    ?>
    <tr>
      <td><?php echo $order['order_no'];?></td>
      <td>$<?php echo $order['order_amount'];?></td>
      <td><?php echo $order['order_date'];?></td>
      <td>
      <table class="tbl-cart" cellpadding="10" cellspacing="1">
				<tr>
          <th>Product Title</th>
          <th>Product Quantity</th>
          <th>Product Price</th>
				</tr>
        <?php 

      $orderDetails=$controller->getOrderDetailsByOrderno($order['order_no']);
      foreach($orderDetails as $item){
      ?><tr>
        <td><?php echo $item['product_title'];?></td>
        <td><?php echo $item['product_quantity'];?></td>
        <td>$<?php echo $item['product_price'];?></td>
      </tr>
      <?php
      }
      ?>
      </table>
    
    <?php
  }
  ?>
  </table>
  <?php
}
?>
<?php require 'footer.php'; ?>
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
          <th>Order Details</th>
				</tr>
<?php
if($db_handle->numRows($sql)>0){
  foreach($result as $order){
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
      $get_orderDetails = "select p.product_title , od.product_price , od.product_quantity  from orderDetails od left join products p on od.product_id = p.product_id where order_no=".$order['order_no'];
      $orderDetails=$db_handle->runQuery($get_orderDetails);
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
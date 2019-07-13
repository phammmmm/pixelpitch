<?php require 'header.php'; ?>
<?php 
if (!isset($_SESSION["customer_id"])) {
  header("location: login.php");
}
?>
  <h1>Thank you for your purchase.</h1>
  <p>Your order has been processed.</p>
<?php require 'footer.php'; ?>
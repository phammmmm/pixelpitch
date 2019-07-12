<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
    <a class="navbar-brand" href="#"><?php echo SITENAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/products.php">Products</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/cart.php">Cart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/admin.php">Admin</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">

      <?php if(isset($_SESSION['customer_id'])) : ?>
        <li class="nav-item">  
          <a class="nav-link" href="customerAccount.php">My Profile</a>
        </li>
        <li class="nav-item">  
          <a class="nav-link" href="customerOrders.php">Order History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </li>
      <?php else : ?>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
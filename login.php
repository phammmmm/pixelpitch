<?php require 'header.php'; ?>
<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["customer_loggedin"]) && $_SESSION["customer_loggedin"] === true) {
  header("location: index.php");
  exit;
}



// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter username.";
  } else {
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT id, firstName, lastName, contact, email, address, username, password FROM customers WHERE username = '" . $username . "'";

    if ($db_handle->numRows($sql) == 1) {
      // Retrieve Customer and verify password
      $customer = $db_handle->singleResult($sql);
      if (password_verify($password, $customer['password'])) {
        // Store data in session variables
        $_SESSION["customer_loggedin"] = true;
        $_SESSION["customer_id"] = $customer['id'];
        $_SESSION["customer_firstName"] = $customer['firstName'];
        $_SESSION["customer_lastName"] = $customer['lastName'];
        $_SESSION["customer_contact"] = $customer['contact'];
        $_SESSION["customer_email"] = $customer['email'];
        $_SESSION["customer_address"] = $customer['address'];

        // Redirect user to welcome page
        header("location: index.php");
      } else {
        // Display an error message if password is not valid
        $password_err = "The password you entered was not valid.";
      }
    } else {
      // Display an error message if username doesn't exist
      $username_err = "No account found with that username.";
    }
  }
}
?>


<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Login</h2>
      <p>Please fill in your credentials to login.</p>
      <form action="login.php" method="post">
        <div class="form-group">
          <label>Username:<sup>*</sup></label>
          <input type="text" name="username" class="form-control form-control-lg <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group">
          <label>Password:<sup>*</sup></label>
          <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-row">
          <div class="col">
            <input type="submit" class="btn btn-success btn-block" value="Login">
          </div>
          <div class="col">
            <a href="register.php" class="btn btn-light btn-block">No account? Register</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
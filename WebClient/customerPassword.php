<?php require 'header.php'; ?>
<?php
require_once("../Server/CustomerController.php");
$controller = new CustomerController();

// Define variables and initialize with empty values
$currentpassword = $password = $confirm_password = "";
$currentpassword_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Validate currentpassword
	if (empty(trim($_POST["currentpassword"]))) {
		$currentpassword_err = "Please enter the current password";
	} else {
		$currentpassword = trim($_POST["currentpassword"]);
	}

	// Validate password
	if (empty(trim($_POST["password"]))) {
		$password_err = "Please enter a password.";
	} elseif (strlen(trim($_POST["password"])) < 5) {
		$password_err = "Password must have atleast 5 characters.";
	} else {
		$password = trim($_POST["password"]);
	}

	// Validate confirm password
	if (empty(trim($_POST["confirm_password"]))) {
		$confirm_password_err = "Please confirm password.";
	} else {
		$confirm_password = trim($_POST["confirm_password"]);
		if (empty($password_err) && ($password != $confirm_password)) {
			$confirm_password_err = "Password did not match.";
		}
	}

	// Check input errors before updating password in database
	if (empty($currentpassword_err) && empty($password_err) && empty($confirm_password_err)) {
		$customer = $controller->getCustomerByUsername($_SESSION["customer_username"]);
		$hashed_currentpassword = password_hash($currentpassword, PASSWORD_DEFAULT);
		$hashed_newpassword = password_hash($password,PASSWORD_DEFAULT);
		// Check if current password entered is correct
		if (password_verify($currentpassword, $customer['password'])) {
			// Change new password
			$controller->updateCustomerPassword($_SESSION["customer_username"],$hashed_newpassword);
			echo "Your password has been successfully updated";
		} else {
			echo $password_err="Can't update password. Please try again later.";
		}
	}
}

?>

<div class="row">
	<div class="col-md-6 mx-auto">
		<div class="card card-body bg-light mt-5">
			<h2>Change password</h2>
			<form name ="frmChange" action="customerPassword.php" method="post" onSubmit="return validatePassword()">
				<div class="form-group">
					<label>Current Password:<sup>*</label>
					<input type="password" name="currentpassword" class="form-control form-control-lg <?php echo (!empty($currentpassword_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $currentpassword; ?>">
					<span class="invalid-feedback"><?php echo $currentpassword_err; ?></span>
				</div>
				<div class="form-group">
					<label>New Password:<sup>*</sup></label>
					<input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
					<span class="invalid-feedback"><?php echo $password_err; ?></span>
				</div>
				<div class="form-group">
					<label>Confirm Password:<sup>*</sup></label>
					<input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
					<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
				</div>

				<div class="form-row">
					<div class="col">
						<input type="submit" class="btn btn-success btn-block" value="save">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php require 'footer.php'; ?>
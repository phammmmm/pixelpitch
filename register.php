<?php require 'header.php'; ?>
<?php
	require_once("dbcontroller.php");
	$db_handle = new DBController();

	// Define variables and initialize with empty values
	$firstName = $lastName = $contact = $email = $address = $username = $password = $confirm_password = "";
	$firstName_err = $lastName_err = $contact_err = $email_err = $address_err = $username_err = $password_err = $confirm_password_err = "";
	
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
			// Validate firstName
			if(empty(trim($_POST["firstName"]))){
				$firstName_err = "Please enter an firstName.";
			} else{
				$firstName = trim($_POST["firstName"]);
			}
			// Validate lastName
			if(empty(trim($_POST["lastName"]))){
				$lastName_err = "Please enter an lastName.";
			} else{
				$lastName = trim($_POST["lastName"]);
			}
			// Validate contact
			if(empty(trim($_POST["contact"]))){
				$contact_err = "Please enter an contact.";
			} else{
				$contact = trim($_POST["contact"]);
			}
			// Validate address
			if(empty(trim($_POST["address"]))){
				$address_err = "Please enter an address.";
			} else{
				$address = trim($_POST["address"]);
			}


			// Validate username
			if(empty(trim($_POST["username"]))){
					$username_err = "Please enter an username.";
			} else{
					// Prepare a select statement

					$sql = "SELECT id FROM customers WHERE username = '".trim($_POST["username"])."'";
					echo $db_handle->numRows($sql);
					if($db_handle->numRows($sql)>0){
						$username_err = "This username is already taken.";
					} else{
						$username = trim($_POST["username"]);   
					}
			}
			// Validate email
			if(empty(trim($_POST["email"]))){
					$email_err = "Please enter an email.";
			} else{
					// Prepare a select statement

					$sql = "SELECT id FROM customers WHERE email = '".trim($_POST["email"])."'";
					echo $db_handle->numRows($sql);
					if($db_handle->numRows($sql)>0){
						$username_err = "This email is already taken.";
					} else{
						$email = trim($_POST["email"]);   
					}
			}
			
			// Validate password
			if(empty(trim($_POST["password"]))){
					$password_err = "Please enter a password.";     
			} elseif(strlen(trim($_POST["password"])) < 5){
					$password_err = "Password must have atleast 5 characters.";
			} else{
					$password = trim($_POST["password"]);
			}
			
			// Validate confirm password
			if(empty(trim($_POST["confirm_password"]))){
					$confirm_password_err = "Please confirm password.";     
			} else{
					$confirm_password = trim($_POST["confirm_password"]);
					if(empty($password_err) && ($password != $confirm_password)){
							$confirm_password_err = "Password did not match.";
					}
			}
			
			// Check input errors before inserting in database
			if(empty($firstName_err) && empty($lastName_err) && empty($contact_err) && empty($email_err) && empty($address_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){
					$hashed_password = password_hash($password, PASSWORD_DEFAULT);
					// Prepare an insert statement
					$sql = "INSERT INTO customers (firstName, lastName, contact , email, address, username, password) VALUES ('".$firstName."','".$lastName."','".$contact."','".$email."','".$address."','".$username."','".$hashed_password."')";

					// Attempt to execute the prepared statement
					if($db_handle->executeUpdate($sql)){
							// Redirect to login page
							header("location: login.php");
					} else{
							echo "Something went wrong. Please try again later.";
					}
			}

	}
?>

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Create An Account</h2>
      <p>Please fill this form to register with us</p>
      <form action="register.php" method="post">
        <div class="form-group">
            <label>First Name:<sup>*</label>
            <input type="text" name="firstName" class="form-control form-control-lg <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>">
            <span class="invalid-feedback"><?php echo $firstName_err; ?></span>
				</div> 
				<div class="form-group">
            <label>Last Name:<sup>*</label>
            <input type="text" name="lastName" class="form-control form-control-lg <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>">
            <span class="invalid-feedback"><?php echo $lastName_err; ?></span>
				</div> 
				<div class="form-group">
            <label>Contact:<sup>*</label>
            <input type="text" name="contact" class="form-control form-control-lg <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>">
            <span class="invalid-feedback"><?php echo $contact_err; ?></span>
        </div> 
        <div class="form-group">
            <label>Email Address:<sup>*</sup></label>
            <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
				</div>   
				<div class="form-group">
            <label>Address:<sup>*</label>
            <input type="text" name="address" class="form-control form-control-lg <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">
            <span class="invalid-feedback"><?php echo $address_err; ?></span>
				</div>  
				<div class="form-group">
            <label>Username:<sup>*</label>
            <input type="text" name="username" class="form-control form-control-lg <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>  
        <div class="form-group">
            <label>Password:<sup>*</sup></label>
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
            <input type="submit" class="btn btn-success btn-block" value="Register">
          </div>
          <div class="col">
            <a href="login.php" class="btn btn-light btn-block">Have an account? Login</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  
<?php require 'footer.php'; ?>
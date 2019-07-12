<?php require 'header.php'; ?>
<?php
	require_once("dbcontroller.php");
	$db_handle = new DBController();

	// Define variables and initialize with empty values
	$name = $email = $password = $confirm_password = "";
	$name_err =$email_err = $password_err = $confirm_password_err = "";
	
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
			$name = trim($_POST["name"]);
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
			} elseif(strlen(trim($_POST["password"])) < 6){
					$password_err = "Password must have atleast 6 characters.";
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
			if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){
					$hashed_password = password_hash($password, PASSWORD_DEFAULT);
					// Prepare an insert statement
					$sql = "INSERT INTO customers (name, email, password) VALUES ('".$name."','".$email."','".$hashed_password."')";
					echo $sql;

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
            <label>Name:<sup>*</label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
            <span class="invalid-feedback"><?php echo $name_err; ?></span>
        </div> 
        <div class="form-group">
            <label>Email Address:<sup>*</sup></label>
            <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
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
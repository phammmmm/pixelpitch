<?php require 'header.php'; ?>

<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

// Define variables and initialize with empty values
$name = $email = $password = $confirm_password = "";
$name_err =$email_err = $password_err = $confirm_password_err = "";

	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";
    } else{
        // Prepare a update statement
        $name = trim($_POST["name"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a update statement
        $email = trim($_POST["email"]);
    }
    // Check input errors before inserting in database
    if(empty($email_err) && empty($name_err)){
        $sql = "update customers set name='".$name."', email='".$email."' where id=".$_SESSION['customer_id'];
        $db_handle->executeUpdate($sql);
    }
  }else{
    $query = "SELECT id, name,email  FROM customers where id=".$_SESSION['customer_id'];
    $customer = $db_handle->singleResult($query);
    $name = $customer['name'];
    $email = $customer['email'];
  }

?>



<!--------- Display cust info --------->
<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Manage My Account</h2>
      <form action="customerAccount.php" method="post">
        <div class="form-group">
            <label>Name:<sup>*</label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" require>
            <span class="invalid-feedback"><?php echo $name_err; ?></span>
        </div> 
        <div class="form-group">
            <label>Email Address:<sup>*</sup></label>
            <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" require>
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>    
        
        <div class="form-row">
          <div class="col">
            <input type="submit" class="btn btn-success btn-block" value="Save">
          </div>
        </div>
      </form>
    </div>
  </div>
  <!--------- Display cust info --------->


<?php require 'footer.php';?>
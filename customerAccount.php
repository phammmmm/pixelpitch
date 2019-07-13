<?php require 'header.php'; ?>

<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

	// Define variables and initialize with empty values
	$firstName = $lastName = $contact = $email = $address = "";
	$firstName_err = $lastName_err = $contact_err = $email_err = $address_err = "";

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

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        $email = trim($_POST["email"]);   
    }
    // Check input errors before inserting in database
    if(empty($email_err) && empty($name_err)){
        $sql = "update customers set firstName='".$firstName."', lastName='".$lastName."', contact='".$contact."', email='".$email."', address='".$address."' where id=".$_SESSION['customer_id'];
        $db_handle->executeUpdate($sql);
    }
  }else{
    $query = "SELECT id, firstName, lastName, contact, email, address, username, password  FROM customers where id=".$_SESSION['customer_id'];
    $customer = $db_handle->singleResult($query);
    $firstName = $customer['firstName'];
    $lastName = $customer['lastName'];
    $contact = $customer['contact'];
    $email = $customer['email'];
    $address = $customer['address'];
  }

?>



<!--------- Display cust info --------->
<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2>Manage My Account</h2>
      <form action="customerAccount.php" method="post">
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
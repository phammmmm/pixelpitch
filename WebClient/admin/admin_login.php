<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Affordable and excellent quality t-shirt for gentleman">
    <meta name="author" content="Tio Pei Moon and Pham Binh">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- <link rel="stylesheet" type="text/css" href="adminStyle.css"> -->
    <title>
        PIXEL PITCH | Admin Login
    </title>
    
</head>

<body>
    <?php
    // Initialize the session
    session_start();
    
    // Include config file
    require_once "../../Server/admin/adminConfig.php";
    
    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = "";
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter your username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(!empty(trim($_POST["username"])) && !empty(trim($_POST["password"]))) { 
            
            // username and password sent from form  
            $myusername = mysqli_real_escape_string($conn,$_POST['username']);
            $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 

            $sql_checkUsername = "SELECT adminid FROM admins WHERE username = '$myusername' "; 
            $result_checkUsername = $conn->query($sql_checkUsername);
             
            
            if ($result_checkUsername->num_rows > 0) {
                $sql = "SELECT adminid FROM admins WHERE username = '$myusername' and password = '$mypassword'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
    
                $count = mysqli_num_rows($result);  
                // If result matched $myusername and $mypassword, table row must be 1 row 
                if ($count == 1) {      
                    echo "login ok";
                    $_SESSION['login_user'] = $myusername;
                    header("location: staff_listing.php");
                } else         {
                    // Display an error message saying username/password does not match
                    $username_err = "Username does not match password"; 
                }
            } else {
                // Display an error message if username doesn't exist
                $username_err = "Wrong username"; 
            } 
        }  
    }
?>

    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a href="index.php"><span class="navbar-brand">PixelPitch</span></a>
    </div>
    </nav>
</header>
<div class="container">
<div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Admin Login</h2>
        <p>Please fill in your credentials to login.</p>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Please enter your username" class="form-control form-control-lg" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Please enter your password" class="form-control form-control-lg"></br>
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>

                <div class="form-row">
                    <div class="col">
                        <input type="submit" class="btn btn-success btn-block" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
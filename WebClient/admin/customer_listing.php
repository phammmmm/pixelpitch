<?php

// Include config file
require_once "../../Server/admin/adminSession.php";

// Include config file
require_once "../../Server/admin/adminConfig.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Affordable and excellent quality t-shirt for gentleman">
    <meta name="author" content="Peggy Tio and Pham Binh">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">

    <title>Customer Listing</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
    <span class="navbar-brand">PixelPitch</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="staff_listing.php">Staffs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product_listing.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer_listing.php">Customers</a>
                </li>
                </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin_logout.php"><?php echo $_SESSION['login_user'] ; ?> • Logout</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>
</header>

    <script>
        function confirmDelete (id) {
            if (confirm("Are you sure you want to DELETE customerID " +id+ " ?")) {
                 deleteData(id) ;

            } else {
                // do nothing
            }
        }
        
        function deleteData(id) {
            var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        //document.getElementById("updateResult").innerHTML = this.responseText; 
                        window.location.reload();
                    }
                };
                xmlhttp.open("GET", "customer_deleteDB.php?id=" + id );
                xmlhttp.send();
        }       
    </script>
</head>
<h3 style="padding: 20px">Customer Listing</h3>
<body>
<p>
<span id="updateResult"></span>
</p>

<?php

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
$sql = "SELECT * FROM `customers` order by id";

$result = $conn->query($sql);


if (!empty($result)) {
    // table divs
    echo '<div class="table" id="results">';

    // header divs
    echo '<div class="theader">
        <div class="table_header">Customer ID</div>
        <div class="table_header">First Name</div>
        <div class="table_header">Last Name</div>
        <div class="table_header">Email Address</div>
        <div class="table_header">Address</div>
        <div class="table_header">Password</div>
        <div class="table_header">Contact</div>
    </div>';

      $index = 0;
      $adminId = '';
      while($row = $result->fetch_assoc()) {
        $index++;
        $customerid = $row["id"];
        $firstname = $row["firstName"];
        $lastname = $row["lastName"];
        $email = $row["email"];
        $address = $row["address"];
        $password = $row["password"];
        $contact = $row["contact"];
        
        echo " <div class='table_row'>";

        echo "<div class='table_small'>
        <div class='table_cell'>Customer ID</div>
            <div class='table_cell'>".$customerid."</div>
        </div>";

        echo "<div class='table_small'>
        <div class='table_cell'>First Name</div>
            <div class='table_cell'>".$firstname."</div>
        </div>";

        echo "<div class='table_small'>
        <div class='table_cell'>Last Name</div>
            <div class='table_cell'>".$lastname."</div>
        </div>";

        echo "<div class='table_small'>
        <div class='table_cell'>Email Address</div>
            <div class='table_cell'>".$email."</div>
        </div>";
        echo "<div class='table_small'>
        <div class='table_cell'>Address</div>
            <div class='table_cell'>".$address."</div>
        </div>";
        echo "<div class='table_small'>
        <div class='table_cell'>Password</div>
            <div class='table_cell'>".$password."</div>
        </div>";

        echo "<div class='table_small'>
        <div class='table_cell'>Contact Number</div>
            <div class='table_cell'>".$contact."</div>
        </div>";

        echo "</div>";
        }
        echo '</div>';      
    } else {
        echo "0 results";
    }
        $conn->close();
?>

</body>
</html>
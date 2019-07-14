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
    <title>Staff Listing</title>
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

<p>
<span id="updateResult"></span>
</p>
<h3 style="padding: 20px">Staff Listing</h3>
<body>
    <?php

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "SELECT * FROM `admins` order by adminid";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // table divs
        echo '<div class="table" id="results">';

        // header divs
        echo '<div class="theader">
            <div class="table_header">Admin ID</div>
            <div class="table_header">Username</div>
            <div class="table_header">Password</div>
            <div class="table_header">Email Address</div>
            <div class="table_header">Job Title</div>
            <div class="table_header">Delete</div>
        </div>'; 

        $index = 0;
        $adminId = '';
        while($row = $result->fetch_assoc()) {
            $index++;
            $adminId = $row["adminid"];
            $username = $row["username"];
            $password = $row["password"];
            $mask_password = str_repeat("•", strlen($password) );
            $emailAddress = $row["email"];
            $jobTitle = $row["job_title"];

            echo " <div class='table_row'>";

            echo "<div class='table_small'>
                    <div class='table_cell'>Admin ID</div>
                    <div class='table_cell'><a href='#' onclick='lnkEdit_click(" . $adminId . ", \"".$username."\", \"".$password."\", \"".$emailAddress."\", \"".$jobTitle."\");'>" . $adminId . "</a></div>
                </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Username</div>
                <div class='table_cell'>".$username."</div>
            </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Password</div>
                <div class='table_cell'>".$mask_password."</div>
            </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Email Address</div>
                <div class='table_cell'>".$emailAddress."</div>
            </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Job Title</div>
                <div class='table_cell'>".$jobTitle."</div>
            </div>";

            $logon_username = "";
            if (isset($_SESSION['login_user'])) $logon_username = strval($_SESSION['login_user'])  ;
            if ($username == $logon_username) 
            {
                echo "<div class='table_small'>
                    <div class='table_cell'>Delete</div>
                    <div class='table_cell'>&nbsp;</div>
                </div>";
            } else {
                echo "<div class='table_small'>
                <div class='table_cell'>Delete</div>
                <div class='table_cell'><a href='#' onclick=confirmDelete(".$adminId.");>x</a></div>
            </div>";
            }

            echo "</div>";
        }
        echo '</div>';      
    } else {
        echo "0 results";
    }
        $conn->close();
    ?>

<!-- Trigger/Open The Modal for ADD new staff-->
    </br>
    <span style="padding-left:20px;">
        <button id="myBtn">Add New Staff</button><br/><br/><br/>
    </span>

    <!-- The Modal -->
    <div id="myModal" class="modal">

    <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>

            <!-- Adding Staffs -->
            <table border="0" cellspacing="2" cellpadding="2">
                <tr>
                <td colspan=2><span id=updateResult></span></td>
                </tr>
                <tr>
                    <h2>
                        <span id="spanHeader">Add Staff</span>
                        <input type="hidden" id=staffID>
                    </h2>
                </tr>
                <tr>
                    <td style="vertical-align:top">Username</td>
                    <td><input type=text id=username></td>
                </tr>
                <tr>
                    <td style="vertical-align:top">Password</td>
                    <td><input class= "hidetext" type="password" id=password ></td>
                </tr>
                <tr>
                    <td style="vertical-align:top">Confirm Password</td>
                    <td><input class= "hidetext" type="password" id=confirmPassword ></td>
                </tr>
                </tr>
                <tr><td style="vertical-align:top">Email Address</td>
                    <td><input type=text id=email></td>
                </tr>
                    <tr><td style="vertical-align:top">Job Title</td>
                    <td><input type=text id=job_title></td>
                </tr>
                <tr>
                    <td colspan=2>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=2>
                        <button onclick="confirmSave();">Save</button>
                        <button onclick="clearData();">Clear</button>
                    </td>
                </tr>
            </table>
        </div>
</div>

<!-- Javascript -->
    <script>
         // Get the modal
         var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0]; 

        // When the user clicks the button, open the modal 
        btn.onclick = function() {

            // update Header Text
            document.getElementById("spanHeader").innerHTML = "Add Staff"; 
            
            // clear and populate textboxes 
            clearData();   

            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            }
        }

        // Edit link
        function lnkEdit_click(id, username, password, email, jobtitle) { 
           
            // update Header Text
            document.getElementById("spanHeader").innerHTML = "Edit Staff ID: " + id;
            
            // clear and populate textboxes 
            clearData();
            document.getElementById("staffID").value = id;
            document.getElementById("username").value = username;
            document.getElementById("password").value = password;
            document.getElementById("email").value = email;
            document.getElementById("job_title").value = jobtitle;
            var modal = document.getElementById("myModal");
            modal.style.display = "block";  

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                }
            }
        }

        // Prompt message before deleting staffs
        function confirmDelete (id) {
            if (confirm("Are you sure you want to DELETE adminID " +id+ " ?")) {
                 deleteData(id) ;

            } else {
                // do nothing
            }
        }

        // Delete staffs
        function deleteData(id) {
            var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) { 
                        window.location.reload();
                    }
                };
                xmlhttp.open("GET", "../Server/staff_deleteDB.php?id=" + id );
                xmlhttp.send();
        }

        // clear data
        function clearData() { 
            document.getElementById("username").value = ''; 
            document.getElementById("password").value = ''; 
            document.getElementById("email").value = ''
            document.getElementById("job_title").value = '';  
        }

        function confirmSave() { 
            var modalHeader = document.getElementById("spanHeader").innerHTML; 
            var action = (modalHeader.indexOf("Add Staff")>-1) ? "add" : "edit"; 
            var msg = (action=="add") ? "Are you sure you want to save Staff Details?" : "Are you sure you want to update Staff Details?";

            if (confirm(msg)) {
                saveDB(action);

            } else {
                // do nothing
            } 
        }

        function saveDB(action) {
            var id = document.getElementById("staffID").value; 
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var email = document.getElementById("email").value;
            var job_title = fixQuotes(document.getElementById("job_title").value);

            if (username.length == 0 ||
                password.length == 0 ||
                email.length == 0 ||
                job_title.length == 0) { 
                
                alert("All fields must have data");
                return;

            } else if (!passwordValidate()){
                alert("Passwords do not match.");
                
            } else { 
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) { 
                        document.getElementById("updateResult").innerHTML = this.responseText;  
                        parent.window.location.reload(false);
                        //window.close(); 
                    }
                }; 
                var url = (action=="add") ?
                    "../Server/staff_saveDB.php?username='" + username + "'&password='" +password + "'&email='" + email + "'&job_title='" + job_title + "'" :
                    "../Server/staff_saveDB.php?id=" + id  + "&username='" + username + "'&password='" +password + "'&email='" + email + "'&job_title='" + job_title + "'";

                xmlhttp.open("GET", url, true);
                xmlhttp.send();
            }
        }

        function fixQuotes(s) {
            return s.replace("'", " ").replace('"', ' ');
        }
        
        function isReservedWord(s){
            var reservedWords = [
                'select',
                'update',
                'delete',
                'drop',
                'truncate',
                'username',
                'password',
                'pwd'
            ];

            return reservedWords.indexOf(str)>-1;

        }

        //checking password | confirm password
        function passwordValidate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;
        if (password != confirmPassword) {

            return false;
        }
        return true;
    }
    </script>

</body>
</html>
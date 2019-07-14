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
    <title>Product Listing</title>
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
<h3 style="padding: 20px">Product Listing</h3>
<body>
    <?php
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "SELECT p.product_id, \n"

        . "p.product_title, \n"
        
        . "IFNULL(c.cat_id,0) as category_id, \n"

        . "IFNULL(c.cat_title,'') as product_category, \n"

        . "p.product_price, \n"

        . "p.product_quantity, \n"

        . "p.product_description, \n"

        . "p.product_image\n"

        . "FROM products p\n"

        . "	join categories c on p.product_category_id = c.cat_id\n" 

        . "order by p.product_id";

    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // table divs
            echo '<div class="table" id="results">';
    
            // header divs
            echo '<div class="theader">
                <div class="table_header">Product ID</div>
                <div class="table_header">Title</div>
                <div class="table_header">Category</div>
                <div class="table_header">Price</div>
                <div class="table_header">Quantity</div>
                <div class="table_header">Description</div>
                <div class="table_header">Image</div>
                <div class="table_header">Delete</div>
            </div>'; 

        $index = 0;
        $productId = '';
        while($row = $result->fetch_assoc()) {
            $index++;
            $productId = $row["product_id"];
            $productTitle = $row["product_title"];
            $categoryId = $row["category_id"];
            $productCategory = $row["product_category"];
            $price = $row["product_price"];
            $qty = $row["product_quantity"];
            $desc = $row["product_description"];
            $image = $row["product_image"];

            echo " <div class='table_row'>";

            echo "<div class='table_small'>
                    <div class='table_cell'>Product ID</div>
                    <div class='table_cell'><a href='#' onclick='lnkEdit_click(" . $productId . ", \"".$productTitle."\", ".$categoryId.", \"".$price."\", \"".$qty."\", \"".$desc."\", \"".$image."\");' >" . $productId . "</a></div>
                </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Product Title</div>
                <div class='table_cell'>".$productTitle."</div>
            </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Product Category</div>
                <div class='table_cell'>".$productCategory."</div>
            </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Price</div>
                <div class='table_cell'>".$price."</div>
            </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Quantity</div>
                <div class='table_cell'>".$qty."</div>
            </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Description</div>
                <div class='table_cell'>".$desc."</div>
            </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Product Image</div>
                <div class='table_cell'><img width='50' height='50' src='/pixelpitch/".$image."'/></div>
            </div>";

            echo "<div class='table_small'>
                <div class='table_cell'>Delete</div>
                <div class='table_cell'><a href='#' onclick=confirmDelete(".$productId.");>x</a></div>
            </div>";

            echo "</div>";
        }
        echo '</div>';      
    } else {
        echo "0 results";
    }
        $conn->close();
    ?>

<!-- Trigger/Open The Modal -->
</br>
    <span style="padding-left:20px;">
        <button id="myBtn">Add New Product</button><br/><br/><br/>
    </span>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>

        <!-- Adding Products -->
        <table border="0" cellspacing="2" cellpadding="2">

            <tr>
                <td colspan=2><span id=updateResult></span></td>
                </tr>
                <tr>
                    <h2>
                        <span id="spanHeader">Add Product</span>
                        <input type="hidden" id=productId>
                    </h2>
                </tr>
                <tr>
                    <td style="vertical-align:top">Title</td>
                    <td><input type=text id=productTitle ></td>
                </tr>
                <tr>
                    <td style="vertical-align:top">Category</td>
                    <td>
                        <?php  

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 
                        
                        $sql = "SELECT `cat_id`, `cat_title` FROM `categories` WHERE 1";
                        
                        $result = $conn->query($sql);
                        echo '<select id="category"><option value="">-Select One-</option>';
                        if ($result->num_rows > 0) { 
                            while($row = $result->fetch_assoc()) {
                                $categoryId = $row["cat_id"];
                                $categoryTitle = $row["cat_title"]; 
                                echo '<option value="'.$categoryId.'">'.$categoryTitle.'</option>' ;
                                
                            }
                        }
                        echo '</select>';
                        
                        $conn->close(); 
                        ?>
                    </td>
                </tr>
                <tr><td style="vertical-align:top">Price</td>
                    <td><input type=text id=productPrice></td>
                </tr>
                    <tr><td style="vertical-align:top">Quantity</td>
                    <td><input type=text id=productQuantity></td>
                </tr
                ><tr>
                    <td style="vertical-align:top">Description</td>
                    <td><textarea id=productDescription rows="4"></textarea></td>
                </tr>
                <tr>
                    <td style="vertical-align:top">Upload image</td>
                    <td>
                    <!-- <form action="product_image_upload.php" method="post" enctype="multipart/form-data" target="upload_target" id="frmUpload">
                        <input type="file" name="fileToUpload" id="fileToUpload"><br/>
                        <input type="submit" value="Upload Image" name="submit">
                    </form> -->
                     
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        </div>
                    </td>
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
            document.getElementById("spanHeader").innerHTML = "Add Product"; 
            
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
        function lnkEdit_click(id, title, categoryId, price, quantity, description, image) { 
           
           // update Header Text
           document.getElementById("spanHeader").innerHTML = "Edit Product ID: " + id;
           
           // clear and populate textboxes 
           clearData(); 
           
           document.getElementById("productId").value = id;
           document.getElementById("productTitle").value = title; 
           document.getElementById("category").value = categoryId;  
           document.getElementById("productPrice").value = price;
           document.getElementById("productQuantity").value = quantity;
           document.getElementById("productDescription").value = description;

           // modal
           var modal = document.getElementById("myModal");
           modal.style.display = "block";  

           // When the user clicks anywhere outside of the modal, close it
           window.onclick = function(event) {
           if (event.target == modal) {
               modal.style.display = "none";
               }
           }
       }

        // Prompt message before deleting products
        function confirmDelete (id) {
                    if (confirm("Are you sure you want to DELETE ProductID " +id+ " ?")) {
                        deleteData(id) ;

                    } else {
                        // do nothing
                    }
                }

        // Delete products
        function deleteData(id) {
            var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        //document.getElementById("updateResult").innerHTML = this.responseText; 
                        window.location.reload();
                    }
                };
                xmlhttp.open("GET", "../Server/product_deleteDB.php?id=" + id );
                xmlhttp.send();
        }
        
        // Adding products
        function clearData() {
            document.getElementById("productTitle").value = '';
            document.getElementById("category").selectedIndex=-1; 
            document.getElementById("productPrice").value = ''; 
            document.getElementById("productQuantity").value = ''
            document.getElementById("productDescription").value = '';
        }

        function confirmSave() { 
            var modalHeader = document.getElementById("spanHeader").innerHTML; 
            var action = (modalHeader.indexOf("Add Product")>-1) ? "add" : "edit"; 
            var msg = (action=="add") ? "Are you sure you want to save Product Details?" : "Are you sure you want to update Product Details?";

            if (confirm(msg)) {
                saveDB(action);

            } else {
                // do nothing
            } 
        }

        function saveDB(action) {
            var id = document.getElementById("productId").value;
            var title = document.getElementById("productTitle").value;
            var category = document.getElementById("category"); 
            var categoryId = category.options[category.selectedIndex].value; 
            var price = document.getElementById("productPrice").value;
            var qty = document.getElementById("productQuantity").value;
            var desc = document.getElementById("productDescription").value; 
            //var img = document.getElementById("productImage").value; 

            if (title.length == 0 ||
                categoryId.length == 0 ||
                price.length == 0 ||
                qty.length == 0 ||
                desc.length == 0 ) { 
                
                alert("All fields must have data");
                return;
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
                    "../Server/product_saveDB.php?title='" + title + "'&cat=" + categoryId + "&price=" +price + "&qty=" + qty + "&desc='" + desc + "'" :
                    "../Server/product_saveDB.php?id=" + id + "&title='" + title + "'&cat=" + categoryId + "&price=" +price + "&qty=" + qty + "&desc='" + desc + "'";

                xmlhttp.open("GET", url, true);
                xmlhttp.send();
                }
            }

    </script>
</body>
</html>
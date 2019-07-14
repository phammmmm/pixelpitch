<?php
// get the q parameter from URL
$id = 0;
if (isset($_GET['id'])) {
    $id = $_REQUEST["id"];
}
$title = $_REQUEST["title"];
$cat = $_REQUEST["cat"];
$price = $_REQUEST["price"];
$qty = $_REQUEST["qty"];
$desc = $_REQUEST["desc"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pixel pitch";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

/*
update products
set product_title='Black Athletic Tee'
, product_category_id=''
, product_price =''
, product_quantity=''
, product_description = ''
, product_image=''
*/

if (isset($_GET['id'])) {
    $sql = "update products "
    . "set `product_title`=" . $title .", `product_category_id`= ". $cat .", `product_price` = ". $price . ", `product_quantity` = ". $qty ." ,`product_description`= " . $desc . " where product_id=" . $id;
} else {
    $sql = "INSERT INTO `products`(`product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_description`, `product_image`) VALUES (" . $title . ", ". $cat .", ". $price .", ". $qty .", ". $desc .",'')";
}

//echo $sql;

if (mysqli_query($conn, $sql)) {
    echo "<font face=Arial color=green>Record updated successfully.</font>";
} else {
    echo "<font face=Arial color=red>Error updating record: " . mysqli_error($conn) . "</font>";
}

mysqli_close($conn);

// Output "no suggestion" if no hint was found or output correct values 
//echo $hint === "" ? "no suggestion" : $hint;
?>
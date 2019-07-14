<?php
// get the q parameter from URL
$id = 0;
if (isset($_GET['id'])) {
    $id = $_REQUEST["id"];
} 

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

$sql = "DELETE FROM `products` WHERE product_id=".$id;

//echo $sql;

if (mysqli_query($conn, $sql)) {
    echo "<font face=Arial color=green>Record deleted successfully.</font>";
} else {
    echo "<font face=Arial color=red>Error updating record: " . mysqli_error($conn) . "</font>";
}

mysqli_close($conn); 
?>
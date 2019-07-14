<?php
// get the q parameter from URL
$id = 0;
if (isset($_GET['id'])) {
    $id = $_REQUEST["id"];
}
$q_username = $_REQUEST["username"];
$q_password = $_REQUEST["password"];
$q_email = $_REQUEST["email"];
$q_jobtitle = $_REQUEST["job_title"]; 

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

if (isset($_GET['id'])) {
    $sql = "update admins set `username`= " . $q_username .", `password`= ". $q_password .", `email` = ". $q_email ." ,`job_title`= " . $q_jobtitle . " where adminid=" . $id;
} else {
    $sql = "INSERT INTO `admins`(`username`, `password`, `email`, `job_title`) VALUES (". $q_username .", " . $q_password .", ". $q_email .", ". $q_jobtitle .")";
}

//echo $sql;

if (mysqli_query($conn, $sql)) {
    echo "<font face=Arial color=green>Record updated successfully.</font>";
} else {
    echo "<font face=Arial color=red>Error updating record: " . mysqli_error($conn) . "</font>";
}

mysqli_close($conn);

// // Output "no suggestion" if no hint was found or output correct values 
// //echo $hint === "" ? "no suggestion" : $hint;
?>
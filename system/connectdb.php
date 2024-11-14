<?php
// if(!isset($allow_access)){
//     die("Unauthorized access.");
// }
$server = "localhost";
$username = "root";
$password = "";
$database = "myblog";
$conn = new mysqli($server, $username, $password, $database);
if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
}
?>
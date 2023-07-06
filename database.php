<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "world";

//creat connection
$conn = new mysqli ($server, $user, $pass, $db);

//check connection
if($conn->connect_error){
  die("Connection failed:" . $conn->connect_error);
}
echo "connection successfully";
?>
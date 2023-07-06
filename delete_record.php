<?php
require("./database.php");

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if($id){
  $query = "DELETE FROM `city` WHERE `ID` = '$id'";
  $result = mysqli_query($conn, $query);
}

$deleted = true;

include('./index.php');
?>
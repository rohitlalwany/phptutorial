<?php
$servername = "localhost"; //127.0.0.1
$db_name = "phplogin";
$db_user = "root";
$db_password = "";    

$conn = new mysqli($servername,$db_user,$db_password);
$conn->select_db($db_name);

if ($conn->connect_error){
    echo $conn->connect_error;
    exit;
}
?>
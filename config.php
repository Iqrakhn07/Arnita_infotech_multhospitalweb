<?php
$host = "localhost";
$user = "root";
$pass = "mysql";
$db_name = "hospital_db";

$conn = mysqli_connect($host, $user, $pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
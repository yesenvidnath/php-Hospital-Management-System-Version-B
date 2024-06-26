<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "main_db_arogya";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
$host = 'localhost';
$user = 'root';
$password = ''; // your DB password
$database = 'booking_db'; // your DB name

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

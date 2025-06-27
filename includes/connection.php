<?php
$host = '127.0.0.1:3308';
$user = 'root';
$password = ""; // keep it empty as your MySQL has no password
$dbname = 'bbms';

$connection = mysqli_connect($host, $user, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

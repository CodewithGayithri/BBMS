<?php
$connection = new mysqli(
    getenv('MYSQLHOST'),
    getenv('MYSQLUSER'),
    getenv('MYSQLPASSWORD'),
    getenv('MYSQLDATABASE'),
    getenv('MYSQLPORT') ?: 3306
);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>

<?php
$con = new mysqli(
    getenv('MYSQLHOST'),
    getenv('MYSQLUSER'),
    getenv('MYSQLPASSWORD'),
    getenv('MYSQLDATABASE'),
    getenv('MYSQLPORT') ?: 3306
);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

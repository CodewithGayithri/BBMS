<?php
$con = new mysqli("db", "root", "", "bbms");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

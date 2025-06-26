<?php
$host = 'db'; // this matches the `service` name in docker-compose.yml
$user = 'root';
$pass = '';
$db = 'bbms';

$con = new mysqli($host, $user, $pass, $db);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

<?php
$con = new mysqli("dpg-d1ept3fdiees73b011h0-a", "bbms_db_r8om_user", "bbms_db_r8om_user","bbms", "5432");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

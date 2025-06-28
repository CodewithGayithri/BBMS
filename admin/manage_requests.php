<?php
session_start();
include('../includes/connection.php');

// Fetch pending blood requests
$query = "SELECT * FROM requests WHERE status = 0";
$query_run = mysqli_query($connection, $query);
$sno = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Blood Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 m-auto">
                <center><h4><u>Manage Blood Requests</u></h4></center><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Request ID</th>
                            <th>Patient Name</th>
                            <th>Mobile No</th>
                            <th>Blood Group</th>
                            <th>Units (in ml)</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        // Securely cast patient ID to integer to avoid SQL injection
                        $patient_id = (int)$row['patient_id'];

                        $query1 = "SELECT name, mobile FROM patients WHERE id = $patient_id";
                        $query_run1 = mysqli_query($connection, $query1);

                        if ($row1 = mysqli_fetch_assoc($query_run1)) {
                            // Short blood group code
                            switch ($row['blood_group']) {
                                case 'A+': $bg = 'AP'; break;
                                case 'B+': $bg = 'BP'; break;}
                        }

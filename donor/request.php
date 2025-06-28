<?php
session_start();
include('../includes/connection.php');

// Ensure user is logged in and uid is set
if (!isset($_SESSION['uid'])) {
    die("Access denied. Please log in.");
}

$uid = (int)$_SESSION['uid']; // cast to integer for safety

$query = "SELECT * FROM donation WHERE donor_id = $uid";
$query_run = mysqli_query($connection, $query);
$sno = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Donation Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 m-auto">
                <center><h4><u>Donation Requests</u></h4></center><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Donation ID</th>
                            <th>Units (in ml)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                        <tr>
                            <td><?php echo $sno; ?></td>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['no_units']); ?></td>
                            <td>
                                <?php 
                                if ($row['status'] == 0) {
                                    echo '<span class="badge bg-secondary">No Action</span>';
                                } elseif ($row['status'] == 1) {
                                    echo '<span class="badge bg-success">Approved</span>';
                                } else {
                                    echo '<span class="badge bg-danger">Rejected</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($row['status'] == 0) { ?>
                                    <a class="btn btn-sm btn-warning" href="edit_request.php?did=<?php echo $row['id']; ?>">Edit</a>
                                    <a class="btn btn-sm btn-danger" href="delete_request.php?did=<?php echo $row['id']; ?>">Delete</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php
                        $sno++;
                    }
                    ?>
                    </tbody>
                </table> 
            </div>
        </div>  
    </div>
</body>
</html>

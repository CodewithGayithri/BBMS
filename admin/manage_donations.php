<?php
session_start();
include('../includes/connection.php');

// Fetch pending donation requests
$query = "SELECT * FROM donation WHERE status = 0";
$query_run = mysqli_query($connection, $query);
$sno = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Donation Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 m-auto">
                <center><h4><u>Manage Donation Request</u></h4></center><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Donation ID</th>
                            <th>Donor Name</th>
                            <th>Mobile No</th>
                            <th>Blood Group</th>
                            <th>Units (in ml)</th>
                            <th>Disease</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $donor_id = $row['donor_id'];

                            // Use prepared statement or escape your donor_id to avoid SQL injection
                            $query1 = "SELECT name, mobile FROM donors WHERE id = $donor_id";
                            $query_run1 = mysqli_query($connection, $query1);

                            if ($row1 = mysqli_fetch_assoc($query_run1)) {
                                // Short blood group code
                                switch ($row['blood_group']) {
                                    case 'A+': $bg = 'AP'; break;
                                    case 'B+': $bg = 'BP'; break;
                                    case 'AB+': $bg = 'ABP'; break;
                                    case 'O+': $bg = 'OP'; break;
                                    default: $bg = $row['blood_group'];
                                }
                        ?>
                        <tr>
                            <td><?php echo $sno; ?></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row1['name']); ?></td>
                            <td><?php echo htmlspecialchars($row1['mobile']); ?></td>
                            <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                            <td><?php echo htmlspecialchars($row['no_units']); ?></td>
                            <td><?php echo htmlspecialchars($row['disease']); ?></td>
                            <td>
                                <?php
                                if ($row['status'] == 0) {
                                    echo '<span class="badge bg-secondary">No Action</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-success" href="accept_don.php?did=<?php echo $row['id']; ?>&bg=<?php echo $bg; ?>&nu=<?php echo $row['no_units']; ?>">Approve</a>
                                <a class="btn btn-sm btn-danger" href="reject_don.php?did=<?php echo $row['id']; ?>">Reject</a>
                            </td>
                        </tr>
                        <?php
                                $sno++;
                            }
                        }
                        ?>
                    </tbody>
                </table> 
            </div>
        </div>  
    </div>
</body>
</html>

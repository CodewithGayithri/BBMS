<?php
session_start(); 
include_once '../includes/connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Manage Blood Requests</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="row">
            <div class="col-md-10 m-auto">
                <br>
                <center><h4><u>Manage Blood Requests</u></h4></center>
                <br>
                <table class="table table-striped table-bordered">
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
                        $query = "SELECT * FROM requests WHERE status = 0";
                        $query_run = mysqli_query($connection, $query);
                        $sno = 1;

                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $stmt = $connection->prepare("SELECT name, mobile FROM patients WHERE id = ?");
                            $stmt->bind_param("i", $row['patient_id']);
                            $stmt->execute();
                            $query_run1 = $stmt->get_result();

                            while ($row1 = mysqli_fetch_assoc($query_run1)) {
                                $bgMap = [
                                    'A+' => 'AP',
                                    'B+' => 'BP',
                                    'AB+' => 'ABP',
                                    'O+' => 'OP'
                                ];
                                $bg = $bgMap[$row['blood_group']] ?? $row['blood_group'];
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($sno); ?></td>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row1['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row1['mobile']); ?></td>
                                    <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_units']); ?></td>
                                    <td><?php echo htmlspecialchars($row['reason']); ?></td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 0) {
                                            echo '<span class="badge bg-secondary">No Action</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="accept_req.php?rid=<?php echo urlencode($row['id']); ?>&bg=<?php echo urlencode($bg); ?>&nu=<?php echo urlencode($row['no_units']); ?>">Approve</a>
                                        <a class="btn btn-sm btn-danger" href="reject_req.php?rid=<?php echo urlencode($row['id']); ?>">Reject</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            $sno++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

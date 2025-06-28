<?php
session_start();
include('../includes/connection.php');

$query = "SELECT * FROM patients";
$query_run = mysqli_query($connection, $query);
$sno = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patients List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 m-auto">
                <center><h4><u>List of All Patients</u></h4></center><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Patient Email</th>
                            <th>Mobile No</th>
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
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                            <td>
                                <a class="btn btn-sm btn-success" href="edit_patient.php?pid=<?php echo $row['id']; ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="delete_patient.php?pid=<?php echo $row['id']; ?>">Delete</a>
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

<?php
session_start();
include('../includes/connection.php');
$query = "SELECT * FROM donors";
$query_run = mysqli_query($connection, $query);
$sno = 1;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>List of Donors</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <center><h4><u>List of all Donors</u></h4></center><br>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>S.No</th>
                        <th>Donor ID</th>
                        <th>Donor Name</th>
                        <th>Donor Email</th>
                        <th>Mobile No</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query_run)) { ?>
                        <tr>
                            <td><?php echo $sno; ?></td>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                            <td>
                                <a class="btn btn-sm btn-success" href="edit_donor.php?did=<?php echo $row['id']; ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="delete_donor.php?did=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this donor?');">Delete</a>
                            </td>
                        </tr>
                    <?php $sno++; } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>

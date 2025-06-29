<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>List of Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 m-auto">
                <h4 class="text-center mb-4"><u>List of all Donors</u></h4>
                <table class="table table-bordered">
                    <thead class="table-light">
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
                    <?php 
                        include('../includes/connection.php');
                        $query = "SELECT * FROM donors";
                        $query_run = mysqli_query($connection, $query);
                        $sno = 1;
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <tr>
                                <td><?php echo $sno; ?></td>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                                <td>
                                    <a class="btn btn-sm btn-success" href="edit_donor.php?did=<?php echo urlencode($row['id']); ?>">Edit</a>
                                    <a class="btn btn-sm btn-danger" href="delete_donor.php?did=<?php echo urlencode($row['id']); ?>">Delete</a>
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

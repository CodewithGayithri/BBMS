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
    <title>Donor List</title>
    <!-- Add CSS, meta tags etc. here -->
</head>
<body>
    <div class="row">
        <div class="col-md-6 m-auto">
            <br><center><h4><u>List of all Donors</u></h4><br></center>
            <table class="table">
                <thead>
                    <th>S.No</th>
                    <th>Donor ID</th>
                    <th>Donor Name</th>
                    <th>Donor Email</th>
                    <th>Mobile No</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="edit_donor.php?did=<?php echo $row['id']; ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="delete_donor.php?did=<?php echo $row['id']; ?>">Delete</a>
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
</body>
</html>

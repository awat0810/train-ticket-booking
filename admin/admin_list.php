<?php 

require'../connection/conn.php';
require 'header.php';

$admin = "SELECT * FROM `admin` ";
$admin_r = $conn->query($admin);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
 
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Admin List</h2>
        <a href="admin_add.php" class="btn btn-success">+ Add New Admin</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Password</th>
					<th>Mobile</th>
					<th>Position</th>
                    <th colspan="2">Actions</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($admin_r)) { ?>
                    <tr>
                        <td><?php echo $row['admin_id']; ?></td>
                        <td><?php echo $row['admin_name']; ?></td>
                        <td><?php echo $row['admin_username']; ?></td>
                        <td><?php echo $row['admin_password']; ?></td>
                        <td><?php echo $row['admin_mobile']; ?></td>
						
						<td>
							<?php 
								if ($row['admin_position'] == 0) {
									echo "Checker";
								} elseif ($row['admin_position'] == 1) {
									echo "Admin";
								} elseif ($row['admin_position'] == 2) {
									echo "Super Admin";
								} else {
									echo "Unknown";
								}
							?>
						</td>
						
						<td><a href="admin_edit.php?id=<?php echo $row['admin_id']; ?>" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="admin_delete.php?id=<?php echo $row['admin_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                
                     
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

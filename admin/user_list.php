<?php
require '../connection/conn.php';
require 'header.php';

$query = "SELECT * from `user`";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-primary">User Lists</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Registered On</th>
					<th colspan=2>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $user['user_id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['phone_number']; ?></td>
                        <td><?php echo $user['create_at']; ?></td>
						<td>
											
					<?php if ( $_SESSION['admin_position'] != 0) { ?>
										  	<a href="user_edit.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
							<a href="user_delete.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this user?');">Delete</a>
						
											<?php }else {?> 	<a href="#" class="btn btn-sm btn-primary">Edit</a>
							<a href="#" class="btn btn-sm btn-danger" >Delete</a>
						 <?php }?>
						</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
require '../connection/conn.php';
require 'header.php';

$station_query = "SELECT * FROM `station`";
$station_result = $conn->query($station_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Station List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Station List</h2>
		
		
			<?php if ( $_SESSION['admin_position'] != 0) { ?>
					<a href="station_add.php" class="btn btn-success">+ Add New Station</a>
								  
			<?php }else {?>  <a href="#" class="btn btn-success">+ Add New Station</a> <?php }?>
		
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Station Name</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($station_result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['station_name']; ?></td>
											
				<?php if ( $_SESSION['admin_position'] != 0) { ?>
					    <td><a href="station_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="station_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                    					  
				<?php }else {?> <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
								<td><a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                 <?php }?>
						
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

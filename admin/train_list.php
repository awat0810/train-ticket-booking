<?php 
require '../connection/conn.php';
require 'header.php';

$train_query = "SELECT * FROM `train`,`train_type` where `train_type` = `id`";
$train_result = $conn->query($train_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Train List</h2>
		
		<a class="btn btn-primary" href="train_type_list.php">Manage Types</a>
		
		
		<?php if ( $_SESSION['admin_position'] != 0) { ?>
				
        <a href="train_add.php" class="btn btn-success">+ Add New Train</a>			  
		<?php }else {?>
        <a href="#" class="btn btn-success">+ Add New Train</a><?php }?>

		
		
         
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Train ID</th>
                    <th>Train Name</th>
                    <th>Train Number</th>
                    <th>Train Type</th>
                    <th>Total Seat</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($train_result)) { ?>
                    <tr>
                        <td><?php echo $row['train_id']; ?></td>
                        <td><?php echo $row['train_name']; ?></td>
                        <td><?php echo $row['train_number']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['total_seat']; ?></td>
											
				<?php if ( $_SESSION['admin_position'] != 0) { ?>
						<td><a href="train_edit.php?id=<?php echo $row['train_id']; ?>" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="train_delete.php?id=<?php echo $row['train_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                   
				<?php }else {?><td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
                               <td><a href="#" class="btn btn-sm btn-danger">Delete</a></td>
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


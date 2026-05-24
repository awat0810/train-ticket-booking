<?php 

require'../connection/conn.php';
require 'header.php';

$type = "SELECT * FROM `train_type` ";
$type_r = $conn->query($type);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Type List</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
 
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Train Type List</h2>
		
				<?php if ( $_SESSION['admin_position'] != 0) { ?>
                       <a href="train_type_add.php" class="btn btn-success">+ Add New Type</a>
						<?php }else {?>
						 <a href="#" class="btn btn-success">+ Add New Type</a>
						<?php }?>

       
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Discription</th>
                  
                    <th colspan="2">Actions</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($type_r)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['discription']; ?></td>
						<?php if ( $_SESSION['admin_position'] != 0) { ?>
                      
						<td><a href="train_type_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="train_type_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
						<?php }else {?><td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="#" class="btn btn-sm btn-danger" >Delete</a></td>
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


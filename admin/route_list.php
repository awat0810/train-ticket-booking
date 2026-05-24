<?php
require '../connection/conn.php';
require 'header.php';

$route_query = "
    SELECT 
        routes.route_id, 
        
        start_station.station_name AS start_station_name, 
        end_station.station_name AS end_station_name, 
        routes.duration
    FROM `routes`
  
    JOIN `station` AS start_station ON routes.start_station = start_station.id
    JOIN `station` AS end_station ON routes.end_station = end_station.id
";

$route_result = $conn->query($route_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Route List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Route List</h2>
		
		<?php if ( $_SESSION['admin_position'] != 0) { ?>
			<a href="route_add.php" class="btn btn-success">+ Add New Route</a>
                      
		<?php }else {?> 
				<a href="#" class="btn btn-success">+ Add New Route</a> <?php }?>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Start Station</th>
                    <th>End Station</th>
                    <th>Duration</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($route_result)) { ?>
                    <tr>
                    
                        <td><?php echo $row['start_station_name']; ?></td>
                        <td><?php echo $row['end_station_name']; ?></td>
                        <td><?php echo $row['duration']." Min"; ?></td>
						
				<?php if ( $_SESSION['admin_position'] != 0) { ?>
                          <td><a href="route_edit.php?id=<?php echo $row['route_id']; ?>" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="route_delete.php?id=<?php echo $row['route_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                    
				<?php }else {?>     <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
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

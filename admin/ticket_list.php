<?php
require '../connection/conn.php';
require 'header.php';

$tickets_query = "
    SELECT t.ticket_id, tr.train_name, s1.station_name AS start_station, s2.station_name AS end_station, 
           r.route_id, t.date_time, t.price
    FROM tickets t
    JOIN train tr ON t.train = tr.train_id
    JOIN routes r ON t.route = r.route_id
    JOIN station s1 ON r.start_station = s1.id
    JOIN station s2 ON r.end_station = s2.id";
$tickets_result = $conn->query($tickets_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Ticket List</h2>
		
			<?php if ( $_SESSION['admin_position'] != 0) { ?>
								  
        <a href="ticket_add.php" class="btn btn-success">+ Add New Ticket</a>
									<?php }else {?> 
        <a href="#" class="btn btn-success">+ Add New Ticket</a> <?php }?>
					
		
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Train Name</th>
                    <th>Route</th>
                    <th>Date/Time</th>
                    <th>Price</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($ticket = mysqli_fetch_array($tickets_result)) { ?>
                    <tr>
                        <td><?php echo $ticket['ticket_id']; ?></td>
                        <td><?php echo $ticket['train_name']; ?></td>
                        <td><?php echo $ticket['start_station'] . " to " . $ticket['end_station']; ?></td>
                        <td><?php echo $ticket['date_time']; ?></td>
                        <td><?php echo "$".$ticket['price']; ?></td>
                       
						
					<?php if ( $_SESSION['admin_position'] != 0) { ?>
                       <td><a href="ticket_edit.php?id=<?php echo $ticket['ticket_id']; ?>" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="ticket_delete.php?id=<?php echo $ticket['ticket_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                        <td>
                            <form method="POST" action="ticket_reset.php">
                                <input type="hidden" name="ticket_id" value="<?php echo $ticket['ticket_id']; ?>">
                                <button type="submit" class="btn btn-sm btn-warning" name="reset_ticket" onclick="return confirm('Are you sure you want to reset this ticket?')">Reset Ticket</button>
                            </form>
                        </td>
						<?php }else {?>   <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
                        <td><a href="#" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                        <td>
                            <form method="POST" action="ticket_reset.php">
                                <input type="hidden" name="ticket_id" value="<?php echo $ticket['ticket_id']; ?>">
                                <button type="submit" class="btn btn-sm btn-warning" name="reset_ticket" disabled>Reset Ticket</button>
                            </form>
                        </td><?php }?>
                       
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

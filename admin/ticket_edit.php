<?php
require '../connection/conn.php';

if (!isset($_GET['id'])) {
    header("Location: ticket_list.php");
    exit();
}

$ticket_id = $_GET['id'];

$train_query = "SELECT * FROM `train`";
$train_result = $conn->query($train_query);

$route_query = "
    SELECT r.route_id, s1.station_name AS start_station_name, s2.station_name AS end_station_name
    FROM routes r
    JOIN station s1 ON r.start_station = s1.id
    JOIN station s2 ON r.end_station = s2.id";
$route_result = $conn->query($route_query);


$ticket_query = "SELECT * FROM tickets WHERE ticket_id = $ticket_id";
$ticket_result = $conn->query($ticket_query);
$ticket = $ticket_result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $train = $_POST['train'];
    $route = $_POST['route'];
    $date_time = $_POST['date_time'];
    $price = $_POST['price'];

    $update_query = "
        UPDATE tickets 
        SET train = '$train', route = '$route', date_time = '$date_time', price = '$price'
        WHERE ticket_id = $ticket_id
    ";

    if ($conn->query($update_query)) {
        header("Location: ticket_list.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Ticket</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-warning">Edit Ticket</h2>

    <form method="POST">
        <div class="form-group">
            <label for="train">Train</label>
            <select id="train" name="train" class="form-control" required>
                <?php while ($row = mysqli_fetch_array($train_result)) { ?>
                    <option value="<?php echo $row['train_id']; ?>"
                        <?php if ($ticket['train'] == $row['train_id']) echo "selected"; ?>>
                        <?php echo $row['train_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="route">Route</label>
            <select id="route" name="route" class="form-control" required>
                <?php while ($row = mysqli_fetch_array($route_result)) { ?>
                    <option value="<?php echo $row['route_id']; ?>"
                        <?php if ($ticket['route'] == $row['route_id']) echo "selected"; ?>>
                        <?php echo $row['start_station_name'] . " to " . $row['end_station_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="date_time">Date and Time</label>
            <input type="datetime-local" id="date_time" name="date_time" class="form-control"
                   value="<?php echo date('Y-m-d\TH:i', strtotime($ticket['date_time'])); ?>" required>
        </div>

        <div class="form-group mt-3">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" class="form-control" value="<?php echo $ticket['price']; ?>" required>
        </div>

     

        <button type="submit" class="btn btn-warning mt-3">Update Ticket</button>
        <a href="ticket_list.php" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

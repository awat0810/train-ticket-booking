<?php
require '../connection/conn.php';

$route_id = $_GET['id']; 

$route_query = "SELECT * FROM `routes` WHERE route_id = '$route_id'";
$route_result = $conn->query($route_query);
$route_data = mysqli_fetch_array($route_result);



$station_query = "SELECT * FROM `station`";
$station_result = $conn->query($station_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $start_station = $_POST['start_station'];
    $end_station = $_POST['end_station'];
    $duration = $_POST['duration'];

    if ($start_station != $end_station) {
        $update_query = "UPDATE `routes` SET  start_station = '$start_station', end_station = '$end_station', duration = '$duration' WHERE route_id = '$route_id'";
        if ($conn->query($update_query)) {
            header("Location: route_list.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('Start station and end station cannot be the same.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Route</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-primary">Edit Route</h2>
    <form method="POST">
       

        <div class="form-group mt-3">
            <label for="start_station">Start Station</label>
            <select id="start_station" name="start_station" class="form-control" required>
                <option value="" disabled>Select Start Station</option>
                <?php while ($row = mysqli_fetch_array($station_result)) { ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $route_data['start_station']) ? 'selected' : ''; ?>>
                        <?php echo $row['station_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="end_station">End Station</label>
            <select id="end_station" name="end_station" class="form-control" required>
                <option value="" disabled>Select End Station</option>
                <?php
                    $station_result = $conn->query($station_query);
                    while ($row = mysqli_fetch_array($station_result)) { ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $route_data['end_station']) ? 'selected' : ''; ?>>
                        <?php echo $row['station_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="duration">Duration (in minutes)</label>
            <input type="number" id="duration" name="duration" class="form-control" required value="<?php echo $route_data['duration']; ?>">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Route</button>
    </form>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

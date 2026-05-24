<?php
require '../connection/conn.php';



$station_query = "SELECT * FROM `station`";
$station_result = $conn->query($station_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $start_station = $_POST['start_station'];
    $end_station = $_POST['end_station'];
    $duration = $_POST['duration'];

    if ($start_station != $end_station) {
        $insert_query = "INSERT INTO `routes` (start_station, end_station, duration) 
                         VALUES ('$start_station', '$end_station', '$duration')";
        if ($conn->query($insert_query)) {
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
    <title>Add New Route</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-primary">Add New Route</h2>
    <form method="POST">
       
        <div class="form-group mt-3">
            <label for="start_station">Start Station</label>
            <select id="start_station" name="start_station" class="form-control" required>
                <option value="" disabled selected>Select Start Station</option>
                <?php while ($row = mysqli_fetch_array($station_result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['station_name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="end_station">End Station</label>
            <select id="end_station" name="end_station" class="form-control" required>
                <option value="" disabled selected>Select End Station</option>
                <?php 
                    $station_result = $conn->query($station_query); 
                    while ($row = mysqli_fetch_array($station_result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['station_name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="duration">Duration (in minutes)</label>
            <input type="number" id="duration" name="duration" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Route</button>
    </form>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

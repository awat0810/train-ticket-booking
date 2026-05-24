<?php
require '../connection/conn.php';

if (isset($_POST['add'])) {
    $station_name = $_POST['station_name'];

    $station_add_query = "INSERT INTO `station` (`station_name`) VALUES ('$station_name')";
    if ($conn->query($station_add_query) === TRUE) {
        echo "<script type='text/javascript'>window.location.href ='station_list.php'</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Station</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Add Station</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="station_name" class="form-label">Station Name</label>
                    <input type="text" class="form-control" id="station_name" name="station_name" required>
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" name="add" value="ADD">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

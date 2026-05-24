<?php
require '../connection/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $station_query = "SELECT * FROM `station` WHERE `id` = '$id'";
    $station_result = $conn->query($station_query);
    $row = mysqli_fetch_array($station_result);
}

if (isset($_POST['update'])) {
    $station_name = $_POST['station_name'];

    $station_update_query = "UPDATE `station` SET `station_name` = '$station_name' WHERE `id` = '$id'";
    if ($conn->query($station_update_query) === TRUE) {
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
    <title>Edit Station</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Edit Station</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="station_name" class="form-label">Station Name</label>
                    <input type="text" class="form-control" id="station_name" name="station_name" value="<?php echo $row['station_name']; ?>" required>
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" name="update" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

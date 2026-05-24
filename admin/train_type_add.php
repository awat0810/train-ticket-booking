<?php
require '../connection/conn.php';

if (isset($_POST['add'])) {
    $type = $_POST['type'];
    $description = $_POST['description'];

    $insert_type = "INSERT INTO `train_type` (`type`, `discription`) VALUES ('$type', '$description')";
    if ($conn->query($insert_type)) {
        echo "<script type='text/javascript'>window.location.href = 'train_type_list.php';</script>";
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
    <title>Add Train Type</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Add New Train Type</h3>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" class="form-control" id="type" name="type" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <input type="submit" name="add" value="Add" class="btn btn-primary">
                    <a href="train_type_list.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

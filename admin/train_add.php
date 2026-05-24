<?php 
require '../connection/conn.php';

if (isset($_POST['add'])) {
    $train_name = $_POST['train_name'];
    $train_number = $_POST['train_number'];
    $train_type = $_POST['train_type'];
    $total_seat = $_POST['total_seat'];

    $add_train_query = "INSERT INTO `train`(`train_name`, `train_number`, `train_type`, `total_seat`) 
                        VALUES ('$train_name', '$train_number', '$train_type', '$total_seat')";
    
    if ($conn->query($add_train_query)) {
        echo "<script type='text/javascript'>window.location.href ='train_list.php'</script>";
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
    <title>Add New Train</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Add New Train</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="train_name" class="form-label">Train Name</label>
                    <input type="text" class="form-control" id="train_name" name="train_name" required>
                </div>
                <div class="mb-3">
                    <label for="train_number" class="form-label">Train Number</label>
                    <input type="text" class="form-control" id="train_number" name="train_number" required>
                </div>
                <div class="mb-3">
                    <label for="train_type" class="form-label">Train Type</label>
                    <select class="form-control" id="train_type" name="train_type" required>
                        <option value="" disabled selected>Select a Train Type</option> <!-- Placeholder option -->
                        <?php
                       
                        $type_query = "SELECT * FROM `train_type`";
                        $type_result = $conn->query($type_query);
                        while ($type_row = mysqli_fetch_array($type_result)) {
                            echo "<option value='" . $type_row['id'] . "'>" . $type_row['type'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="total_seat" class="form-label">Total Seats</label>
                    <input type="number" class="form-control" id="total_seat" name="total_seat" required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" name="add" value="Add Train">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
require '../connection/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $select = "SELECT * FROM `train_type` WHERE id = '$id'";
    $result = $conn->query($select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Train type not found.'); window.location.href='train_type_list.php';</script>";
        exit();
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $description = $_POST['description'];

    $update = "UPDATE `train_type` SET `type`='$type', `discription`='$description' WHERE id='$id'";
    if ($conn->query($update)) {
        echo "<script>window.location.href='train_type_list.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Train Type</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Edit Train Type</h3>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <input type="text" class="form-control" id="type" name="type" value="<?php echo htmlspecialchars($row['type']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="<?php echo htmlspecialchars($row['discription']); ?>" required>
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" name="update" value="Update">
                    <a href="train_type_list.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

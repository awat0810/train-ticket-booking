<?php
require '../connection/conn.php';

$id = $_GET['id'];
$query = "SELECT * FROM `user` WHERE user_id = $id";
$result = $conn->query($query);
$user = mysqli_fetch_array($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];

    $update = "UPDATE `user` SET name='$name', email='$email', username='$username', phone_number='$phone' WHERE user_id=$id";
    if ($conn->query($update)) {
        header("Location: user_list.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Edit User</h2>
    <form method="POST">
        <div class="form-group">
            <label>Name</label>
            <input name="name" value="<?php echo $user['name']; ?>" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label>Email</label>
            <input name="email" value="<?php echo $user['email']; ?>" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label>Username</label>
            <input name="username" value="<?php echo $user['username']; ?>" class="form-control" required>
        </div>
        <div class="form-group mt-2">
            <label>Phone</label>
            <input name="phone" value="<?php echo $user['phone_number']; ?>" class="form-control" required>
        </div>
        <button class="btn btn-primary mt-3" type="submit">Update</button>
    </form>
</div>
</body>
</html>

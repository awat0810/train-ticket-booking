<?php

require '../connection/conn.php';
require 'header.php';


if (!isset($_SESSION['user_id'])) {
   
    header("Location: login.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM `user` WHERE `user_id` = '$user_id'";
$result = $conn->query($query);
$user = $result->fetch_assoc();

if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $update_query = "UPDATE `user` SET `name` = '$name', `username` = '$username', `email` = '$email', `phone_number` = '$phone_number' WHERE `user_id` = '$user_id'";

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        $error_message = "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> 
</head>
<body>



<div class="container mt-5">

    <div class="card shadow-lg">
        <div class="card-body">
          
            <h3 class="text-center text-primary mb-4">Profile</h3>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST" action="">

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="profile.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="update_profile" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

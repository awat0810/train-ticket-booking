<!DOCTYPE html>
<html lang="en">
<head>

<?php
session_start();
require '../connection/conn.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
	

    $query = "SELECT * FROM `user` WHERE `username` = '$username'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ( $password == $user['password']) {
          
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            
              header("Location: available_tickets.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "User not found.";
    }
}
?>





    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5" style="max-width: 500px;">
    <h3 class="text-center text-primary mb-4">Login to Your Account</h3>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>

        <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a>.</p>
    </form>
</div>
</body>
</html>

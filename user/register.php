<!DOCTYPE html>
<html lang="en">
<head>

<?php
session_start();
require '../connection/conn.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
	$create_at = date('Y-m-d');

    

    
    $query = "INSERT INTO `user` (`name`, `email`, `username`, `phone_number`, `password`,`create_at`) 
              VALUES ('$name', '$email', '$username', '$phone', '$password','$create_at')";

    if ($conn->query($query)) {
       
        $user_id = $conn->insert_id;

    
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] =$name;

        header("Location: available_tickets.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
        echo "<script>alert('Error: . $conn->error;');</script>";
    }
}
?>



    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5" style="max-width: 500px;">
    <h3 class="text-center text-success mb-4">Create a New Account</h3>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Create Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Sign Up</button>

        <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>

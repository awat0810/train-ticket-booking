<?php 
require '../connection/conn.php';
require 'header.php';

$name = $_SESSION['admin_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <style>
    .welcome-box {
        margin-top: 100px;
        text-align: center;
    }
    .welcome-card {
        padding: 40px;
        background-color: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: inline-block;
    }
  </style>
</head>
<body>

  <div class="container welcome-box">
    <div class="welcome-card">
      <h2 class="text-primary">Welcome, <?php echo htmlspecialchars($name); ?> 👋</h2>
      <p class="text-muted">Hope you're having a great day managing the system!</p>
    </div>
  </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

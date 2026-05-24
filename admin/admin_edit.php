<!DOCTYPE html>
<html>
<head>
    <?php
    require '../connection/conn.php';
  

    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $admin = $_POST['admin'];
        $username = $_POST['user'];
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];
        $mobile = $_POST['mobile'];
		$position = $_POST['position'];

        if ($pass != $pass2) {
            $error = "Passwords do not match";
        } else {
            $add = "UPDATE `admin` 
                    SET `admin_name`='$admin',
                        `admin_username`='$username',
                        `admin_password`='$pass',
                        `admin_mobile`='$mobile',
						`admin_position`='$position'
                    WHERE `admin_id`=$id";
            $conn->query($add);
            header("Location: admin_list.php");
            exit();
        }
    }

    $id = $_GET['id'];
    $admin = "SELECT * FROM `admin` WHERE `admin_id`=$id";
    $admin_r = $conn->query($admin);
    $row1 = mysqli_fetch_array($admin_r);
    ?>

    <title>Edit Admin</title>
    <link href="formStyle.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Edit Admin</h1>
        <div class="form-container">
          <form action="" method="post">
				<?php if (isset($error)): ?>
					<div class="alert alert-danger"><?php echo $error; ?></div>
				<?php endif; ?>

				<div class="mb-3">
					<label for="admin" class="form-label">Admin Name</label>
					<input type="text" class="form-control" id="admin" name="admin" value="<?php echo htmlspecialchars($row1['admin_name']); ?>" required>
				</div>

				<div class="mb-3">
					<label for="user" class="form-label">Username</label>
					<input type="text" class="form-control" id="user" name="user" value="<?php echo htmlspecialchars($row1['admin_username']); ?>" required>
				</div>

				<div class="mb-3">
					<label for="pass" class="form-label">Password</label>
					<input type="password" class="form-control" id="pass" name="pass" value="<?php echo htmlspecialchars($row1['admin_password']); ?>" required>
				</div>

				<div class="mb-3">
					<label for="pass2" class="form-label">Repeat Password</label>
					<input type="password" class="form-control" id="pass2" name="pass2" >
				</div>

				<div class="mb-3">
					<label for="mobile" class="form-label">Mobile</label>
					<input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($row1['admin_mobile']); ?>" required>
				</div>

				<div class="mb-3">
					<label class="form-label">Position</label>
					<div class="form-check">
						<input class="form-check-input" type="radio" id="checker" name="position" value="0" <?php if ($row1['admin_position'] == 0) echo 'checked'; ?>>
						<label class="form-check-label" for="checker">Checker</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" id="admin" name="position" value="1" <?php if ($row1['admin_position'] == 1) echo 'checked'; ?>>
						<label class="form-check-label" for="admin">Admin</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" id="superadmin" name="position" value="2" <?php if ($row1['admin_position'] == 2) echo 'checked'; ?>>
						<label class="form-check-label" for="superadmin">Super Admin</label>
					</div>
				</div>

				<button type="submit" name="submit" class="btn btn-primary">Edit</button>
			</form>

        </div>
    </div>
	
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

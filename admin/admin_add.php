<?php
  require'../connection/conn.php';
if(isset($_POST['add'])) {
  
	
	
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$mobile = $_POST['mobile'];
	$position = $_POST['position'];


	
	$admin_add = "INSERT INTO `admin`(`admin_name`, `admin_username`, `admin_mobile`, `admin_password`, `admin_position`) 
              VALUES ('$name','$username','$mobile','$password','$position')";

    $conn->query($admin_add);
	

   echo "<script type='text/javascript'>window.location.href ='admin_list.php'</script>";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Add Admin</h3>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
				  <div class="mb-3">
                    <label for="username" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
				   
				  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" required>
                </div>
				  <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" required>
					</div>
				 <div class="mb-3">
					<label class="form-label">Position</label><br>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="position" id="checker" value="0" required>
						<label class="form-check-label" for="checker">Checker</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="position" id="admin" value="1">
						<label class="form-check-label" for="admin">Admin</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="position" id="superadmin" value="2">
						<label class="form-check-label" for="superadmin">Super Admin</label>
					</div>
				</div>
		

				
			

				
                <div class="mb-3">
                <a href="admin_list.php" class="btn btn-secondary">Cancel</a>
                    <input type="submit" class="btn btn-primary" name="add" value="ADD">
                </div>
            </form>
        </div>
    </div>
</div>


<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

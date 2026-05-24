<?php
require '../connection/conn.php';

$id = $_GET['id'];
$query = "DELETE FROM `user` WHERE user_id = $id";

if ($conn->query($query)) {
    header("Location: user_list.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

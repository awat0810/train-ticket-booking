<?php
require '../connection/conn.php';

$route_id = $_GET['id']; 

$delete_query = "DELETE FROM `routes` WHERE route_id = '$route_id'";
if ($conn->query($delete_query)) {
    header("Location: route_list.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>

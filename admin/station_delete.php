<?php
require '../connection/conn.php';

$id = $_GET['id'];

$delete_query = "DELETE FROM `station` WHERE `id` = '$id'";

$conn->query($delete_query);

header("Location: station_list.php");
exit();
?>

<?php
require '../connection/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete = "DELETE FROM `train_type` WHERE id = '$id'";
    if ($conn->query($delete)) {
        echo "<script>window.location.href='train_type_list.php';</script>";
    } else {
        echo "<script>alert('Error deleting record.'); window.location.href='train_type_list.php';</script>";
    }
} else {
    echo "<script>window.location.href='train_type_list.php';</script>";
}
?>

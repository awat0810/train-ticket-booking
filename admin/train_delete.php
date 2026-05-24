<?php
require '../connection/conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete_query = "DELETE FROM `train` WHERE `train_id` = '$id'";
    $conn->query($delete_query);

    echo "<script type='text/javascript'>window.location.href = 'train_list.php';</script>";
}
?>

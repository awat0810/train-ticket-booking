<?php
require '../connection/conn.php';

if (isset($_GET['id'])) {
    $ticket_id = $_GET['id'];

    $delete_query = "DELETE FROM tickets WHERE ticket_id = $ticket_id";

    if ($conn->query($delete_query)) {
        header("Location: ticket_list.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: ticket_list.php");
    exit();
}
?>

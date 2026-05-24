<?php
require '../connection/conn.php';

if (isset($_POST['reset_ticket'])) {
    $ticket_id = $_POST['ticket_id'];

    
    $delete_stmt = $conn->prepare("DELETE FROM booked_ticket WHERE ticket = ?");
    $delete_stmt->bind_param("i", $ticket_id);
    if ($delete_stmt->execute()) {
        $delete_stmt->close(); 


        $next_day = date('Y-m-d', strtotime('+1 day'));
        $update_stmt = $conn->prepare("UPDATE tickets SET date_time = CONCAT(?, ' ', TIME(date_time)) WHERE ticket_id = ?");
        $update_stmt->bind_param("si", $next_day, $ticket_id);

        if ($update_stmt->execute()) {
            header("Location: ticket_list.php");
        } else {
            echo "Error updating ticket date: " . $update_stmt->error;
        }
    } else {
        echo "Error deleting from booked_ticket: " . $delete_stmt->error;
    }
}
?>

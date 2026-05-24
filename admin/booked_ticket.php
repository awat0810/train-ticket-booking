<?php
require '../connection/conn.php';
require 'header.php';

$query = "
SELECT 
    bt.booked_ticket_id,
    bt.time,
    u.name AS user_name,
    t.train_name,
    s1.station_name AS start_station,
    s2.station_name AS end_station,
    tk.date_time,
    tk.price
FROM booked_ticket bt
JOIN user u ON bt.user = u.user_id
JOIN tickets tk ON bt.ticket = tk.ticket_id
JOIN train t ON tk.train = t.train_id
JOIN routes r ON tk.route = r.route_id
JOIN station s1 ON r.start_station = s1.id
JOIN station s2 ON r.end_station = s2.id
ORDER BY tk.date_time 
";


$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booked Tickets List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2 class="text-primary">Booked Tickets List</h2>
    <table class="table table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>Select</th> <!-- Added column for checkbox -->
                
                <th>User</th>
                <th>Train</th>
                <th>Route</th>
                <th>Date/Time</th>
                <th>Price</th>
                <th>Date/Time(Of Booking)</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <tr id="row-<?php echo $row['booked_ticket_id']; ?>" class="<?php echo (isset($_COOKIE['ticket-' . $row['booked_ticket_id']]) && $_COOKIE['ticket-' . $row['booked_ticket_id']] == 'true' ? 'table-success' : ''); ?>">
                    <td><input type="checkbox" name="selected_tickets[]" value="<?php echo $row['booked_ticket_id']; ?>" onclick="toggleRowDesign(<?php echo $row['booked_ticket_id']; ?>)" <?php echo (isset($_COOKIE['ticket-' . $row['booked_ticket_id']]) && $_COOKIE['ticket-' . $row['booked_ticket_id']] == 'true' ? 'checked' : ''); ?>></td> <!-- Checkbox for each row -->
                   
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['train_name']; ?></td>
                    <td><?php echo $row['start_station'] . " → " . $row['end_station']; ?></td>
                    <td><?php echo $row['date_time']; ?></td>
                    <td><?php echo "$" . $row['price']; ?></td>
                      <td><?php echo $row['time']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    // Toggle the row design and store the checkbox state in cookies
    function toggleRowDesign(ticketId) {
        var row = document.getElementById('row-' + ticketId);
        var checkbox = row.querySelector('input[type="checkbox"]');

        // If the checkbox is checked, change the row design and store the state in cookies
        if (checkbox.checked) {
            row.classList.add('table-success');
            document.cookie = 'ticket-' + ticketId + '=true; path=/';
        } else {
            row.classList.remove('table-success');
            document.cookie = 'ticket-' + ticketId + '=false; path=/';
        }
    }

    // Apply row designs based on the saved states when the page loads
    window.onload = function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            var ticketId = checkbox.value;
            if (document.cookie.indexOf('ticket-' + ticketId + '=true') !== -1) {
                checkbox.checked = true;
                document.getElementById('row-' + ticketId).classList.add('table-success');
            }
        });
    };
</script>

</body>
</html>

<?php
require '../connection/conn.php';
require 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "
SELECT 
    bt.booked_ticket_id,
    bt.time,
    t.train_name,
    s1.station_name AS start_station,
    s2.station_name AS end_station,
    tk.date_time,
    tk.price
FROM booked_ticket bt
JOIN tickets tk ON bt.ticket = tk.ticket_id
JOIN train t ON tk.train = t.train_id
JOIN routes r ON tk.route = r.route_id
JOIN station s1 ON r.start_station = s1.id
JOIN station s2 ON r.end_station = s2.id
WHERE bt.user = ?
ORDER BY bt.booked_ticket_id DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result(); 


if ($result === false) {
    die("Error executing query: " . $stmt->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Booked Tickets</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-primary text-center mb-4"><i class="bi bi-ticket-perforated-fill"></i> My Booked Tickets</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="row g-4">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-train-front-fill text-success"></i> <?php echo htmlspecialchars($row['train_name']); ?></h5>
                            <p class="card-text mb-1"><i class="bi bi-geo-alt-fill text-danger"></i> Route: <strong><?php echo htmlspecialchars($row['start_station']); ?></strong> → <strong><?php echo htmlspecialchars($row['end_station']); ?></strong></p>
                            <p class="card-text mb-1"><i class="bi bi-calendar-check text-primary"></i> Date & Time: <?php echo htmlspecialchars($row['date_time']); ?></p>
                            <p class="card-text mb-1"><i class="bi bi-cash-coin text-warning"></i> Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                            <p class="card-text"><i class="bi bi-clock-history text-secondary"></i> Booked At: <?php echo htmlspecialchars($row['time']); ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">You haven't booked any tickets yet.</div>
    <?php endif; ?>
</div>
</body>
</html>

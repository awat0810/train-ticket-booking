<?php
require '../connection/conn.php';
require 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';

$query = "SELECT 
    tk.ticket_id,
    tk.date_time,
    tk.price,
    tr.train_name AS train_name,
    tr.total_seat,
    ss.station_name AS start_station,
    es.station_name AS end_station,
    COUNT(bt.booked_ticket_id) AS booked_seats
FROM tickets tk
JOIN train tr ON tk.train = tr.train_id
JOIN routes rt ON tk.route = rt.route_id
JOIN station ss ON rt.start_station = ss.id
JOIN station es ON rt.end_station = es.id
LEFT JOIN booked_ticket bt ON tk.ticket_id = bt.ticket
GROUP BY 
    tk.ticket_id, tk.date_time, tk.price, tr.train_name, tr.total_seat, ss.station_name, es.station_name";

$result = mysqli_query($conn, $query);
if (!$result) {
    echo "<pre>SQL Error:\n" . mysqli_error($conn) . "</pre>";
    exit;
}

if (isset($_POST['book_ticket'])) {
    $ticket_id = $_POST['ticket_id'];
    $user_id = $_SESSION['user_id'];

    $insert = "INSERT INTO booked_ticket (user, ticket) VALUES ('$user_id', '$ticket_id')";
    if (mysqli_query($conn, $insert)) {
        header("Location: available_tickets.php");
        exit();
    } else {
        echo "Booking error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Tickets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../path/to/your/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card-title {
            font-size: 1.2rem;
        }
        .card-text {
            font-size: 0.95rem;
        }
        .welcome-box {
            margin-top: 50px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">

    <!-- Welcome Box -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="alert alert-primary text-center shadow-sm rounded-3">
                <h4 class="mb-1">👋 Welcome, <?php echo htmlspecialchars($name); ?></h4>
                <p class="mb-0">We hope you're having a smooth booking experience today.</p>
            </div>
        </div>
    </div>

    <h2 class="text-center fw-bold mb-4">Available Tickets</h2>

    <div class="row g-4">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <?php $remaining = $row['total_seat'] - $row['booked_seats']; ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary fw-bold mb-2">
                            🚆 <?php echo htmlspecialchars($row['train_name']); ?>
                        </h5>
                        <ul class="list-unstyled mb-3">
                            <li><strong>Route:</strong> <?php echo htmlspecialchars($row['start_station'] . ' → ' . $row['end_station']); ?></li>
                            <li><strong>Date/Time:</strong> <?php echo htmlspecialchars($row['date_time']); ?></li>
                            <li><strong>Price:</strong> $<?php echo htmlspecialchars($row['price']); ?></li>
                            <li><strong>Seats Left:</strong> 
                                <span class="<?php echo $remaining > 0 ? 'text-success' : 'text-danger'; ?>">
                                    <?php echo $remaining . " / " . $row['total_seat']; ?>
                                </span>
                            </li>
                        </ul>

                        <div class="mt-auto">
                            <?php if ($remaining > 0): ?>
                                <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#bookingModal" 
                                        data-ticket-id="<?php echo $row['ticket_id']; ?>" 
                                        data-ticket-name="<?php echo htmlspecialchars($row['train_name']); ?>"
                                        data-ticket-price="<?php echo $row['price']; ?>"> <!-- Added price -->
                                    <i class="bi bi-cart-check"></i> Book Ticket
                                </button>
                            <?php else: ?>
                                <button class="btn btn-outline-secondary w-100" disabled>
                                    <i class="bi bi-x-circle"></i> Sold Out
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</div>

<!-- Booking Confirmation Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Confirm Your Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to book this ticket for the <strong><span id="trainName"></span></strong>?</p>
                <p><strong>Price:</strong> $<span id="ticketPrice"></span></p>
                <input type="hidden" id="ticketId" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="">
                    <button type="submit" name="book_ticket" class="btn btn-primary">Confirm Booking</button>
                    <input type="hidden" name="ticket_id" id="ticketIdInput">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Handle the ticket data for confirmation modal
    const bookingModal = document.getElementById('bookingModal');
    bookingModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // The button that triggered the modal
        const ticketId = button.getAttribute('data-ticket-id');
        const trainName = button.getAttribute('data-ticket-name');
        const ticketPrice = button.getAttribute('data-ticket-price'); // Get the ticket price

        // Update modal content
        document.getElementById('trainName').textContent = trainName;
        document.getElementById('ticketPrice').textContent = ticketPrice; // Display price
        document.getElementById('ticketId').value = ticketId;
        document.getElementById('ticketIdInput').value = ticketId;
    });
</script>

</body>
</html>

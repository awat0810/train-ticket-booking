
<?php 
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .navbar-nav .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 shadow-sm">
<?php if ($_SESSION['admin_position'] == 2): ?>
    <a class="navbar-brand fw-bold text-white" href="admin_list.php">
        <i class="bi bi-tools"></i> Admin Dashboard
    </a>
    <?php endif; ?>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="ticket_list.php"><i class="bi bi-ticket-perforated-fill"></i> Tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="user_list.php"><i class="bi bi-people-fill"></i> Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="route_list.php"><i class="bi bi-map"></i> Routes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="station_list.php"><i class="bi bi-train-front"></i> Stations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="train_list.php"><i class="bi bi-train-front-fill"></i> Trains</a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link text-white" href="booked_ticket.php"><i class="bi bi-journal-text"></i> Booked</a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>

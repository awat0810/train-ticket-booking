<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
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
    <a class="navbar-brand fw-bold text-white" href="available_tickets.php">
        <i class="bi bi-ticket-detailed-fill"></i> Ticket System
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="available_tickets.php"><i class="bi bi-ticket-perforated-fill"></i> Tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="profile.php"><i class="bi bi-person-circle"></i> Profile</a>
            </li>
             <li class="nav-item">
                <a class="nav-link text-white" href="my_ticket.php"><i class="bi bi-receipt"></i> my ticket</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>

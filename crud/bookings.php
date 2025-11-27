<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

// Fetch bookings joined with user + service
$stmt = $conn->query("
    SELECT b.id, u.username, s.name, b.booking_date, b.status
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN services s ON b.service_id = s.id
    ORDER BY b.booking_date DESC
");
$bookings = [];
if ($stmt && $stmt->num_rows > 0) {
    while ($row = $stmt->fetch_assoc()) {
        $bookings[] = $row;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookings - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a href="admin.php" class="navbar-brand">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="admin.php">Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="payments.php">Payments</a></li>
                <li class="nav-item"><a class="nav-link" href="reviews.php">Reviews</a></li>
            </ul>
            <div class="d-flex align-items-center">
                <a href="index.php" class="btn btn-light btn-sm me-2">Public Page</a>
                <span class="text-white me-3">Logged in as <strong><?= $_SESSION['username'] ?></strong></span>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
<h2>Bookings</h2>
<a href="booking_add.php" class="btn btn-primary mb-3">Add Booking</a>
<a href="admin.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Service</th>
            <th>Date</th>
            <th>Status</th>
            <th width="160">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bookings as $b): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= htmlspecialchars($b['username']) ?></td>
            <td><?= htmlspecialchars($b['name']) ?></td>
            <td><?= $b['booking_date'] ?></td>
            <td><?= $b['status'] ?></td>
            <td>
                <a href="booking_edit.php?id=<?= $b['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="booking_delete.php?id=<?= $b['id'] ?>" class="btn btn-sm btn-danger"
                   onclick="return confirm('Delete this booking?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch reviews with booking details
$reviews = $conn->query("
    SELECT r.*, b.customer_name, s.name AS service_name, u.username
    FROM reviews r
    JOIN bookings b ON r.booking_id = b.id
    JOIN services s ON r.service_id = s.id
    JOIN users u ON r.user_id = u.id
    ORDER BY r.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reviews - Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a href="admin.php" class="navbar-brand">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="admin.php">Bookings</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="payments.php">Payments</a></li>
                <li class="nav-item"><a class="nav-link active" href="reviews.php">Reviews</a></li>
            </ul>
            <div class="d-flex align-items-center">
                <a href="index.php" class="btn btn-light btn-sm me-2">Public Page</a>
                <span class="text-white me-3">Logged in as <strong><?= $_SESSION['username'] ?></strong></span>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Customer Reviews</h3>
        <a href="review_add.php" class="btn btn-primary">Add Review</a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $reviews->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['customer_name'] ?></td>
                            <td><?= $row['service_name'] ?></td>
                            <td>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span style="color: <?= $i <= $row['rating'] ? 'gold' : '#ddd' ?>">★</span>
                                <?php endfor; ?>
                                (<?= $row['rating'] ?>/5)
                            </td>
                            <td><?= htmlspecialchars(substr($row['comment'] ?? '', 0, 50)) ?><?= strlen($row['comment'] ?? '') > 50 ? '...' : '' ?></td>
                            <td><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                            <td>
                                <a href="review_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="review_delete.php?id=<?= $row['id'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Delete this review?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

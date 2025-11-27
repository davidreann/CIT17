<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$users = $conn->query("SELECT id, username, role FROM users ORDER BY username ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
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
                <li class="nav-item"><a class="nav-link active" href="users.php">Users</a></li>
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

<div class="container mt-4">

    <div class="d-flex justify-content-between">
        <h3>User Accounts</h3>
        <a href="user_add.php" class="btn btn-primary btn-sm">Add User</a>
    </div>

    <div class="card mt-3">
        <div class="card-body table-responsive">

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($row = $users->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= ucfirst($row['role']) ?></td>
                            <td>
                                <a href="user_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="user_delete.php?id=<?= $row['id'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete this user?')">
                                   Delete
                                </a>
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

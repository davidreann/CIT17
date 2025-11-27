<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $payment_status = $_POST['payment_status'];
    $payment_date = $_POST['payment_date'];

    $stmt = $conn->prepare("INSERT INTO payments (booking_id, amount, payment_method, payment_status, payment_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("idsss", $booking_id, $amount, $payment_method, $payment_status, $payment_date);

    if ($stmt->execute()) {
        header("Location: payments.php");
        exit;
    } else {
        $error = "Failed to add payment.";
    }
}

// Get all bookings for dropdown
$bookings = $conn->query("
    SELECT b.id, b.customer_name, s.name AS service_name, s.price
    FROM bookings b
    JOIN services s ON b.service_id = s.id
    ORDER BY b.booking_date DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a href="admin.php" class="navbar-brand">Admin Dashboard</a>
        <div class="d-flex align-items-center">
            <a href="payments.php" class="btn btn-light btn-sm me-2">← Back to Payments</a>
            <span class="text-white me-3">Logged in as <strong><?= $_SESSION['username'] ?></strong></span>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add Payment</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Booking</label>
                            <select name="booking_id" class="form-select" required>
                                <option value="">Select Booking</option>
                                <?php while ($row = $bookings->fetch_assoc()): ?>
                                    <option value="<?= $row['id'] ?>">
                                        #<?= $row['id'] ?> - <?= $row['customer_name'] ?> (<?= $row['service_name'] ?> - ₱<?= number_format($row['price'], 2) ?>)
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="gcash">GCash</option>
                                <option value="paymaya">PayMaya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Status</label>
                            <select name="payment_status" class="form-select" required>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Date</label>
                            <input type="date" name="payment_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Payment</button>
                        <a href="payments.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

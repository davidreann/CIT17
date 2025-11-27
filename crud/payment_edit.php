<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $payment_status = $_POST['payment_status'];
    $payment_date = $_POST['payment_date'];

    $stmt = $conn->prepare("UPDATE payments SET booking_id=?, amount=?, payment_method=?, payment_status=?, payment_date=? WHERE id=?");
    $stmt->bind_param("idsssi", $booking_id, $amount, $payment_method, $payment_status, $payment_date, $id);

    if ($stmt->execute()) {
        header("Location: payments.php");
        exit;
    } else {
        $error = "Failed to update payment.";
    }
}

// Get payment data
$stmt = $conn->prepare("SELECT * FROM payments WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$payment = $stmt->get_result()->fetch_assoc();

if (!$payment) {
    header("Location: payments.php");
    exit;
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
    <title>Edit Payment</title>
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
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Edit Payment</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Booking</label>
                            <select name="booking_id" class="form-select" required>
                                <?php while ($row = $bookings->fetch_assoc()): ?>
                                    <option value="<?= $row['id'] ?>" <?= $payment['booking_id'] == $row['id'] ? 'selected' : '' ?>>
                                        #<?= $row['id'] ?> - <?= $row['customer_name'] ?> (<?= $row['service_name'] ?> - ₱<?= number_format($row['price'], 2) ?>)
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" step="0.01" value="<?= $payment['amount'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="cash" <?= $payment['payment_method'] == 'cash' ? 'selected' : '' ?>>Cash</option>
                                <option value="credit_card" <?= $payment['payment_method'] == 'credit_card' ? 'selected' : '' ?>>Credit Card</option>
                                <option value="gcash" <?= $payment['payment_method'] == 'gcash' ? 'selected' : '' ?>>GCash</option>
                                <option value="paymaya" <?= $payment['payment_method'] == 'paymaya' ? 'selected' : '' ?>>PayMaya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Status</label>
                            <select name="payment_status" class="form-select" required>
                                <option value="pending" <?= $payment['payment_status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="completed" <?= $payment['payment_status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                <option value="failed" <?= $payment['payment_status'] == 'failed' ? 'selected' : '' ?>>Failed</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Date</label>
                            <input type="date" name="payment_date" class="form-control" value="<?= $payment['payment_date'] ?>" required>
                        </div>

                        <button type="submit" class="btn btn-warning">Update Payment</button>
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

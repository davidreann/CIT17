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
    $user_id = $_POST['user_id'];
    $service_id = $_POST['service_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("UPDATE reviews SET booking_id=?, user_id=?, service_id=?, rating=?, comment=? WHERE id=?");
    $stmt->bind_param("iiiisi", $booking_id, $user_id, $service_id, $rating, $comment, $id);

    if ($stmt->execute()) {
        header("Location: reviews.php");
        exit;
    } else {
        $error = "Failed to update review.";
    }
}

// Get review data
$stmt = $conn->prepare("SELECT * FROM reviews WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$review = $stmt->get_result()->fetch_assoc();

if (!$review) {
    header("Location: reviews.php");
    exit;
}

// Get all bookings for dropdown
$bookings = $conn->query("
    SELECT b.id, b.customer_name, b.user_id, b.service_id, s.name AS service_name
    FROM bookings b
    JOIN services s ON b.service_id = s.id
    ORDER BY b.booking_date DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a href="admin.php" class="navbar-brand">Admin Dashboard</a>
        <div class="d-flex align-items-center">
            <a href="reviews.php" class="btn btn-light btn-sm me-2">← Back to Reviews</a>
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
                    <h5 class="mb-0">Edit Review</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST" id="reviewForm">
                        <div class="mb-3">
                            <label class="form-label">Booking</label>
                            <select name="booking_id" id="booking_id" class="form-select" required>
                                <?php while ($row = $bookings->fetch_assoc()): ?>
                                    <option value="<?= $row['id'] ?>" 
                                            data-user-id="<?= $row['user_id'] ?>" 
                                            data-service-id="<?= $row['service_id'] ?>"
                                            <?= $review['booking_id'] == $row['id'] ? 'selected' : '' ?>>
                                        #<?= $row['id'] ?> - <?= $row['customer_name'] ?> (<?= $row['service_name'] ?>)
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <input type="hidden" name="user_id" id="user_id" value="<?= $review['user_id'] ?>" required>
                        <input type="hidden" name="service_id" id="service_id" value="<?= $review['service_id'] ?>" required>

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-select" required>
                                <option value="5" <?= $review['rating'] == 5 ? 'selected' : '' ?>>⭐⭐⭐⭐⭐ Excellent (5)</option>
                                <option value="4" <?= $review['rating'] == 4 ? 'selected' : '' ?>>⭐⭐⭐⭐ Very Good (4)</option>
                                <option value="3" <?= $review['rating'] == 3 ? 'selected' : '' ?>>⭐⭐⭐ Good (3)</option>
                                <option value="2" <?= $review['rating'] == 2 ? 'selected' : '' ?>>⭐⭐ Fair (2)</option>
                                <option value="1" <?= $review['rating'] == 1 ? 'selected' : '' ?>>⭐ Poor (1)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comment</label>
                            <textarea name="comment" class="form-control" rows="4"><?= htmlspecialchars($review['comment'] ?? '') ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-warning">Update Review</button>
                        <a href="reviews.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-populate user_id and service_id when booking is selected
document.getElementById('booking_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    document.getElementById('user_id').value = selectedOption.getAttribute('data-user-id');
    document.getElementById('service_id').value = selectedOption.getAttribute('data-service-id');
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("DELETE FROM payments WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: payments.php");
exit;

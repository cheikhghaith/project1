<?php
include 'config.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    echo "<script>alert('Access Denied. Admins only.'); window.location.href='login.php';</script>";
    exit;
}

// Check if ID and status are passed
if (isset($_GET['id']) && isset($_GET['status'])) {
    $payment_id = mysqli_real_escape_string($conn, $_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);

    // Update the payment status in the database
    $query = "UPDATE payments SET status = '$status' WHERE id = '$payment_id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Payment status updated successfully.'); window.location.href='admin_payments.php';</script>";
    } else {
        echo "<script>alert('Error updating payment status.'); window.location.href='admin_payments.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='admin_payments.php';</script>";
}
?>

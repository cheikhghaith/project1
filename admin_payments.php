<?php
include 'config.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    echo "<script>alert('Access Denied. Admins only.'); window.location.href='login.php';</script>";
    exit;
}

// Fetch all payment details from the database
$query = "SELECT * FROM payments ORDER BY payment_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Payments</title>
    <link rel="stylesheet" href="style.css?v=1.0">
</head>
<body>

<section class="dashboard">
    <h1>Manage Payments</h1>
    <table class="payments-table">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>User ID</th>
                <th>Booking ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Payment Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($payment = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $payment['id'] ?></td>
                    <td><?= $payment['user_id'] ?></td>
                    <td><?= $payment['booking_id'] ?></td>
                    <td><?= $payment['amount'] ?></td>
                    <td><?= $payment['status'] ?></td>
                    <td><?= $payment['payment_date'] ?></td>
                    <td>
                        <a href="update_payment_status.php?id=<?= $payment['id'] ?>&status=Paid" class="btn">Mark as Paid</a>
                        <a href="update_payment_status.php?id=<?= $payment['id'] ?>&status=Failed" class="btn">Mark as Failed</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

</body>
</html>

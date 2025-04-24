<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in first.'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$payments = mysqli_query($conn, "SELECT * FROM payments WHERE user_id = '$user_id' ORDER BY payment_date DESC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Payments</title>
    <link rel="stylesheet" href="style.css?v=1.0">
</head>
<body>

<section class="header">
    <a href="home.php" class="logo"><span>Travel TN</span></a>
    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="book.php">Book</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="payment.php">Payments</a>
    </nav>
</section>

<section class="payments">
    <h1 class="heading-title">Your Payments</h1>

    <div class="payment-container">
        <?php while ($payment = mysqli_fetch_assoc($payments)) : ?>
            <div class="payment-box">
                <p><strong>Amount:</strong> $<?= $payment['amount'] ?></p>
                <p><strong>Status:</strong> <?= $payment['status'] ?></p>
                <p><strong>Date:</strong> <?= $payment['payment_date'] ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</section>

</body>
</html>

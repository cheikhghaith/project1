<?php
include 'config.php';
session_start();

// Check if admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    echo "<script>alert('Access Denied. Admins only.'); window.location.href='login.php';</script>";
    exit;
}

// Get counts
$total_users    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users WHERE role = 'User'"))['count'];
$total_trips    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM trips"))['count'];
$total_bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM bookings"))['count'];
$total_revenue  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) AS total FROM payments WHERE states = 'Completed'"))['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard | Travel.tn</title>
  <link rel="stylesheet" href="style.css?v=1.0">
  <style>
    .dashboard { padding: 30px; font-family: Arial, sans-serif; }
    .cards { display: flex; gap: 20px; flex-wrap: wrap; }
    .card {
      background: #f8f8f8;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      flex: 1;
      min-width: 200px;
      text-align: center;
    }
    .card h2 { margin-bottom: 10px; font-size: 1.5em; }
    .card a { text-decoration: none; color: #007bff; font-weight: bold; display: inline-block; margin-top: 10px; }
  </style>
</head>
<body>

<section class="dashboard">
  <h1>Welcome, Admin!</h1>
  <div class="cards">
    <div class="card">
      <h2><?= $total_users ?> Users</h2>
      <a href="manage_users.php">Manage Users</a>
    </div>
    <div class="card">
      <h2><?= $total_trips ?> Trips</h2>
      <a href="manage_trips.php">Manage Trips</a>
    </div>
    <div class="card">
      <h2><?= $total_bookings ?> Bookings</h2>
      <a href="manage_bookings.php">Manage Bookings</a>
    </div>
    <div class="card">
      <h2>$<?= number_format($total_revenue, 2) ?> Revenue</h2>
      <a href="admin_payments.php">View Payments</a>
    </div>
    <div class="card">
      <h2>Reviews</h2>
      <a href="admin_reviews.php">Manage Reviews</a>
    </div>
  </div>
</section>

</body>
</html>

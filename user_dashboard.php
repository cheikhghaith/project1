<?php
include 'config.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in first.'); window.location.href='login.php';</script>";
    exit;
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM bookings WHERE user_id = $user_id ORDER BY created_at DESC";
$bookings = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="style.css?v=1.0">
</head>
<body>
  <section class="user-dashboard">
    <h1>Welcome, <?= $_SESSION['name'] ?></h1>
    <h2>Your Bookings</h2>

    <table>
      <thead>
        <tr>
          <th>Booking ID</th>
          <th>Location</th>
          <th>Guests</th>
          <th>Status</th>
          <th>Arrival</th>
          <th>Leaving</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($bookings)) { ?>
          <tr>
            <td><?= $row['booking_id'] ?></td>
            <td><?= $row['location'] ?></td>
            <td><?= $row['guests'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['arrival_date'] ?></td>
            <td><?= $row['leaving_date'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <br>
    <a href="home.php" class="btn">Back to Home</a>
    <a href="logout.php" class="btn">Log Out</a>
  </section>
</body>
</html>

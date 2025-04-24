<?php
include 'config.php';
session_start();

// Admin access only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    echo "<script>alert('Access Denied. Admins only.'); window.location.href='login.php';</script>";
    exit;
}

// Update booking status
if (isset($_POST['update_status'])) {
    $id     = intval($_POST['booking_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    mysqli_query($conn, "UPDATE bookings SET status='$status' WHERE booking_id=$id");
}

// Mark as paid
if (isset($_POST['mark_paid'])) {
    $id = intval($_POST['booking_id']);
    mysqli_query($conn, "UPDATE bookings SET payment_status='Paid' WHERE booking_id=$id");
}

// Delete booking
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM bookings WHERE booking_id=$id");
    header("Location: manage_bookings.php");
    exit;
}

// Fetch bookings
$query = "SELECT b.*, u.name AS user_name
          FROM bookings b
          JOIN users u ON b.user_id = u.user_id
          ORDER BY b.created_at DESC";
$bookings = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Bookings</title>
  <link rel="stylesheet" href="style.css?v=1.0">
  <style>
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: center; font-size: 14px; }
    th { background-color: #f0f0f0; }
    .form-inline { display: flex; gap: 5px; justify-content: center; align-items: center; }
    .btn-small { padding: 4px 10px; font-size: 13px; }
    .btn-del { color: red; text-decoration: none; }
  </style>
</head>
<body>
  <section class="dashboard">
    <h1>Manage Bookings</h1>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Destination</th>
          <th>Guests</th>
          <th>Dates</th>
          <th>Status</th>
          <th>Payment</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($bookings)) { ?>
          <tr>
            <td><?= $row['booking_id'] ?></td>
            <td><?= $row['user_name'] ?></td>
            <td><?= $row['location'] ?></td>
            <td><?= $row['guests'] ?></td>
            <td><?= $row['arrival_date'] ?> → <?= $row['leaving_date'] ?></td>
            <td>
              <form method="post" class="form-inline">
                <input type="hidden" name="booking_id" value="<?= $row['booking_id'] ?>">
                <select name="status">
                  <option <?= $row['status']=='Pending'?'selected':'' ?>>Pending</option>
                  <option <?= $row['status']=='Approved'?'selected':'' ?>>Approved</option>
                  <option <?= $row['status']=='Rejected'?'selected':'' ?>>Rejected</option>
                </select>
                <input type="submit" name="update_status" value="Update" class="btn-small">
              </form>
            </td>
            <td>
              <?= $row['payment_status'] ?>
              <?php if ($row['payment_status'] !== 'Paid') { ?>
                <form method="post" style="margin-top: 5px;">
                  <input type="hidden" name="booking_id" value="<?= $row['booking_id'] ?>">
                  <input type="submit" name="mark_paid" value="Mark Paid" class="btn-small">
                </form>
              <?php } ?>
            </td>
            <td>
              <a href="?delete=<?= $row['booking_id'] ?>" class="btn-del" onclick="return confirm('Delete this booking?')">Delete</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <br>
    <a href="admin_dashboard.php" class="btn">← Back to Dashboard</a>
  </section>
</body>
</html>

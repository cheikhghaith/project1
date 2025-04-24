<?php
include 'config.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM reviews ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Reviews</title>
  <link rel="stylesheet" href="style.css?v=1.0">
  <style>
    .admin-table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }

    .admin-table th, .admin-table td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
    }

    .admin-table th {
      background: #333;
      color: #fff;
    }

    .btn-small {
      padding: 6px 10px;
      margin: 0 3px;
      font-size: 0.9rem;
    }

    .actions {
      display: flex;
    }
  </style>
</head>
<body>
  <section class="header">
    <a href="admin_dashboard.php" class="logo">Travel TN Admin</a>
    <nav class="navbar">
      <a href="admin_dashboard.php">Dashboard</a>
      <a href="admin_reviews.php">Reviews</a>
      <a href="logout.php">Logout</a>
    </nav>
  </section>

  <section class="reviews">
    <h1 class="heading-title">Manage Reviews</h1>
    <table class="admin-table">
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Trip</th>
        <th>Rating</th>
        <th>Comment</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
      <?php while($review = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $review['id'] ?></td>
          <td><?= $review['user_id'] ?></td>
          <td><?= $review['trip_id'] ?></td>
          <td><?= $review['rating'] ?></td>
          <td><?= htmlspecialchars($review['comment']) ?></td>
          <td><?= $review['status'] ?></td>
          <td class="actions">
            <a href="verify_review.php?id=<?= $review['id'] ?>" class="btn btn-small">Verify</a>
            <a href="reply_review.php?id=<?= $review['id'] ?>" class="btn btn-small">Reply</a>
            <a href="delete_review.php?id=<?= $review['id'] ?>" class="btn btn-small" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </section>
</body>
</html>

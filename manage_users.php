<?php
include 'config.php';
session_start();

// Admin only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    echo "<script>alert('Access Denied. Admins only.'); window.location.href='login.php';</script>";
    exit;
}

// Handle deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $check = mysqli_query($conn, "SELECT * FROM users WHERE user_id=$id AND role='User'");
    if (mysqli_num_rows($check) === 1) {
        mysqli_query($conn, "DELETE FROM users WHERE user_id=$id");
        header("Location: manage_users.php");
        exit;
    }
}

$users = mysqli_query($conn, "SELECT * FROM users WHERE role='User'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <link rel="stylesheet" href="style.css?v=1.0">
  <style>
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
    th { background-color: #f4f4f4; }
    a.btn-del { color: red; text-decoration: none; font-weight: bold; }
  </style>
</head>
<body>
  <section class="dashboard">
    <h1>Manage Users</h1>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Registered</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($users)) { ?>
          <tr>
            <td><?= $row['user_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><a href="?delete=<?= $row['user_id'] ?>" class="btn-del" onclick="return confirm('Delete this user?')">Delete</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <br>
    <

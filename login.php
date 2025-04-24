<?php
include 'config.php';
session_start();

// Handle form submission
if (isset($_POST['submit_login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch user data
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        echo "<script>window.location.href='user_dashboard.php';</script>";
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Login</title>
  <link rel="stylesheet" href="style.css?v=1.0">
</head>
<body>
  <section class="login">
    <h1>Login</h1>
    <form method="POST" class="login-form">
      <input type="email" name="email" placeholder="Enter your email" required>
      <input type="password" name="password" placeholder="Enter your password" required>
      <input type="submit" name="submit_login" value="Login" class="btn">
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
  </section>
</body>
</html>

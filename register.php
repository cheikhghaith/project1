<?php
include 'config.php';
session_start();

// Handle form submission
if (isset($_POST['submit_register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($check_email) > 0) {
            echo "<script>alert('Email already exists!');</script>";
        } else {
            // Insert user into the database
            $insert_query = "INSERT INTO users (name, email, phone, password, role, created_at)
                             VALUES ('$name', '$email', '$phone', '$hashed_password', 'User', NOW())";
            if (mysqli_query($conn, $insert_query)) {
                echo "<script>alert('Registration successful! Please log in.'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error: Unable to register.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <link rel="stylesheet" href="style.css?v=1.0">
</head>
<body>
  <section class="register">
    <h1>Register</h1>
    <form method="POST" class="register-form">
      <input type="text" name="name" placeholder="Enter your name" required>
      <input type="email" name="email" placeholder="Enter your email" required>
      <input type="text" name="phone" placeholder="Enter your phone number" required>
      <input type="password" name="password" placeholder="Enter your password" required>
      <input type="password" name="confirm_password" placeholder="Confirm your password" required>
      <input type="submit" name="submit_register" value="Register" class="btn">
    </form>
    <p>Already have an account? <a href="login.php">Log In</a></p>
  </section>
</body>
</html>

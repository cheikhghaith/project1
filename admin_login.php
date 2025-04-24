<?php
include 'config.php';
session_start();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database for admin credentials
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Check if admin exists
    if (mysqli_num_rows($result) === 1) {
        $admin = mysqli_fetch_assoc($result);

        // Setting session variables for successful login
        $_SESSION['user_id'] = $admin['id'];       // Admin's user ID
        $_SESSION['role'] = 'Admin';                // Role set as Admin

        // Redirect to the admin dashboard
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css?v=1.0">
</head>
<body>
    <section class="form-container">
        <form action="admin_login.php" method="post" class="login-form">
            <h2>Admin Login</h2>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <input type="text" name="username" placeholder="Enter username" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <input type="submit" name="login" value="Log In" class="btn">
        </form>
    </section>
</body>
</html>

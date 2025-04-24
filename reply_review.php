<?php
include 'config.php';
session_start();

// Check if the user is an admin
if (!isset($_SESSION['admin_id'])) {
    echo "<script>alert('You are not authorized to access this page.'); window.location.href='login.php';</script>";
    exit;
}

if (isset($_POST['review_id']) && isset($_POST['reply'])) {
    $review_id = $_POST['review_id'];
    $reply = mysqli_real_escape_string($conn, $_POST['reply']);

    // Update review with the admin's reply
    $query = "UPDATE reviews SET reply = '$reply', status = 'replied' WHERE id = '$review_id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Reply posted successfully.'); window.location.href='admin_reviews.php';</script>";
    } else {
        echo "<script>alert('Failed to post reply.'); window.location.href='admin_reviews.php';</script>";
    }
} else {
    echo "<script>alert('Review or reply not found.'); window.location.href='admin_reviews.php';</script>";
}
?>

<?php
include 'config.php';
session_start();

// Check if the user is an admin
if (!isset($_SESSION['admin_id'])) {
    echo "<script>alert('You are not authorized to access this page.'); window.location.href='login.php';</script>";
    exit;
}

if (isset($_GET['review_id'])) {
    $review_id = $_GET['review_id'];

    // Delete the review
    $query = "DELETE FROM reviews WHERE id = '$review_id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Review deleted successfully.'); window.location.href='admin_reviews.php';</script>";
    } else {
        echo "<script>alert('Failed to delete review.'); window.location.href='admin_reviews.php';</script>";
    }
} else {
    echo "<script>alert('Review not found.'); window.location.href='admin_reviews.php';</script>";
}
?>

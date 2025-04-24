<?php
include 'config.php';
session_start();

if (isset($_POST['submit_review']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $rating = intval($_POST['rating']);

    $query = "INSERT INTO reviews (user_id, comment, rating, created_at) VALUES ('$user_id', '$comment', '$rating', NOW())";
    mysqli_query($conn, $query);

    echo "<script>alert('Review submitted!'); window.location.href='reviews.php';</script>";
} else {
    echo "<script>alert('Please log in to leave a review.'); window.location.href='login.php';</script>";
}
?>

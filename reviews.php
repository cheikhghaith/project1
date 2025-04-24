<?php
include 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in first.'); window.location.href='login.php';</script>";
    exit;
}

// Fetch existing reviews
$reviews = mysqli_query($conn, "SELECT r.*, u.name FROM reviews r JOIN users u ON r.user_id = u.id ORDER BY r.created_at DESC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reviews</title>
    <link rel="stylesheet" href="style.css?v=1.0">
</head>
<body>

<section class="header">
    <a href="home.php" class="logo"><span>Travel TN</span></a>
    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="package.php">Package</a>
        <a href="book.php">Book</a>
        <a href="reviews.php">Reviews</a>
    </nav>
</section>

<section class="reviews">
    <h1 class="heading-title">Customer Reviews</h1>

    <?php while ($row = mysqli_fetch_assoc($reviews)) : ?>
        <div class="review-box">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p><?= htmlspecialchars($row['comment']) ?></p>
            <small>Rating: <?= $row['rating'] ?>/5 | <?= $row['created_at'] ?></small>
        </div>
    <?php endwhile; ?>

    <form action="submit_review.php" method="post" class="review-form">
        <h2>Leave a Review</h2>
        <textarea name="comment" placeholder="Your review..." required></textarea>
        <label for="rating">Rating:</label>
        <select name="rating" required>
            <option value="">--Select--</option>
            <?php for ($i = 5; $i >= 1; $i--): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>
        <button type="submit" name="submit_review" class="btn">Submit</button>
    </form>
</section>

</body>
</html>

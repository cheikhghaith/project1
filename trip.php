<?php
include 'config.php';
session_start();

// Fetch trip details based on trip_id
if (isset($_GET['trip_id'])) {
    $trip_id = mysqli_real_escape_string($conn, $_GET['trip_id']);  // Sanitize the trip_id input

    // Fetch the trip details from the database
    $query = "SELECT * FROM trips WHERE trip_id = '$trip_id' AND availability = 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $trip = mysqli_fetch_assoc($result);
    } else {
        echo "Trip not found or unavailable.";
        exit;
    }
} else {
    echo "No trip selected.";
    exit;
}

// Handle the booking process
if (isset($_POST['book_now'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please log in first to make a booking'); window.location.href='login.php';</script>";
        exit;
    }

    // Get user data and trip details for the booking
    $user_id = $_SESSION['user_id'];
    $trip_id = $_POST['trip_id'];
    $quantity = $_POST['quantity'];
    $guests = $_POST['guests'];
    $arrival_date = $_POST['arrival_date'];
    $leaving_date = $_POST['leaving_date'];
    $address = $_POST['address'];
    $total_price = $trip['price'] * $quantity;

    // Insert booking into the bookings table
    $query = "INSERT INTO bookings (user_id, trip_id, quantity, guests, arrival_date, leaving_date, address, total_price, status)
              VALUES ('$user_id', '$trip_id', '$quantity', '$guests', '$arrival_date', '$leaving_date', '$address', '$total_price', 'Pending')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Booking successful!'); window.location.href='bookings.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trip Details | Travel.tn</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="trip-details">
    <h1><?php echo $trip['name']; ?></h1>
    <!-- Static Image for the Trip (You can change this to a dynamic image if you add an image field) -->
    <img src="path/to/default-trip-image.jpg" alt="Trip Image">
    <p><strong>Location:</strong> <?php echo $trip['location']; ?></p>
    <p><strong>Description:</strong> <?php echo $trip['description']; ?></p>
    <p><strong>Price:</strong> $<?php echo $trip['price']; ?></p>
    <p><strong>Duration:</strong> <?php echo $trip['duration']; ?> days</p>

    <!-- Booking Form -->
    <form action="trip.php?trip_id=<?php echo $trip_id; ?>" method="POST">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1" required>

        <label for="guests">Number of Guests:</label>
        <input type="number" name="guests" id="guests" min="1" required>

        <label for="arrival_date">Arrival Date:</label>
        <input type="date" name="arrival_date" id="arrival_date" required>

        <label for="leaving_date">Leaving Date:</label>
        <input type="date" name="leaving_date" id="leaving_date" required>

        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea>

        <input type="hidden" name="trip_id" value="<?php echo $trip_id; ?>">
        <button type="submit" name="book_now">Book Now</button>
    </form>
</section>

</body>
</html>

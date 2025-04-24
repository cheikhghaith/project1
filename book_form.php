<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in first.'); window.location.href='login.php';</script>";
    exit;
}

if (isset($_POST['submit_booking'])) {
    $user_id    = $_SESSION['user_id'];
    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $address    = mysqli_real_escape_string($conn, $_POST['adress']);
    $guests     = $_POST['guests'];
    $arrival    = $_POST['Arrivals'];
    $leaving    = $_POST['Leaving'];
    $trip_id    = $_POST['trip_id'];
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);  // Capture payment method

    // Check if the trip exists
    $query = "SELECT * FROM trips WHERE trip_id = '$trip_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Trip found
        $trip = mysqli_fetch_assoc($result);

        // Insert booking into the bookings table
        $insert_booking = "INSERT INTO bookings (user_id, trip_id, name, email, address, guests, arrival_date, leaving_date, created_at, updated_at)
                           VALUES ('$user_id', '$trip_id', '$name', '$email', '$address', '$guests', '$arrival', '$leaving', NOW(), NOW())";

        if (mysqli_query($conn, $insert_booking)) {
            $booking_id = mysqli_insert_id($conn);

            // Insert payment information into the payments table
            $insert_payment = "INSERT INTO payments (booking_id, amount, payment_method)
                               VALUES ('$booking_id', '100.00', '$payment_method')"; // Adjust amount calculation as needed

            if (mysqli_query($conn, $insert_payment)) {
                echo "<script>alert('Booking successful with payment!'); window.location.href='my_bookings.php';</script>";
                exit;
            } else {
                echo "<script>alert('Payment failed. Try again.'); window.location.href='book.php';</script>";
            }
        } else {
            echo "<script>alert('Booking failed. Try again.'); window.location.href='book.php';</script>";
        }
    } else {
        echo "<script>alert('Trip not found.'); window.location.href='book.php';</script>";
    }
}
?>

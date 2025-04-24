
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=1.0">
    <style>
    .booking .book-form .flex .inputBox select {
      width: 100%;
      padding: 1.2rem 1.4rem;
      font-size: 1.6rem;
      color: var(--light-black);
      text-transform: none;
      margin-top: 1.5rem;
      border: var(--border);
    }

    .booking .book-form .flex .inputBox select:focus {
      background: var(--black);
      color: var(--white);
    }

    .booking .book-form .flex .inputBox select:focus::placeholder {
      background: var(--black);
      color: var(--light-white);
    }

    .booking .book-form .flex .inputBox span {
      font-size: 1.5rem;
      color: var(--light-black);
    }
  </style>

  </head>

  <body>
    <section class="header">
      <a href="home.php" class="logo">
        <img src="https://cdn-icons-png.freepik.com/256/6684/6684159.png" alt="logo">
        <span>Travel TN</span>
      </a>
      <nav class="navbar">
        <a href="home.php">home</a>
        <a href="about.php">about</a>
        <a href="package.php">package</a>
        <a href="book.php">book</a>
      </nav>
      <div id="menu-btn" class="fas fa-bars"></div>
    </section>

    <div class="heading-title" style="background:url(https://img.freepik.com/premium-photo/dubai-uae-december-26-2017-camels-skyscrapers-background-beach-uae-dubai-marina-jbr-beach-style-camels-skyscrapers_474717-10765.jpg?uid=R196508448&ga=GA1.1.1740592143.1744890625&semt=ais_hybrid&w=740) no-repeat">
      <h1>Book Now</h1>
    </div>

    <section class="booking">
      <h1 class="heading-title"> Book Your Trip!</h1>

      <form action="book_form.php" method="post" class="book-form">
        <input type="hidden" name="trip_id" value="<?php echo $trip_id; ?>">
        <div class="flex">
          <div class="inputBox">
            <span>Name :</span>
            <input type="text" placeholder="enter your name" name="name" required>
          </div>
          <div class="inputBox">
            <span>Email :</span>
            <input type="email" placeholder="enter your email" name="email" required>
          </div>
          <div class="inputBox">
            <span>Payment Method :</span>
            <select name="payment_method" required>
              <option value="">-- Select a method --</option>
              <option value="Credit Card">Credit Card</option>
              <option value="PayPal">PayPal</option>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Cash">Cash</option>
            </select>
          </div>
          <div class="inputBox">
            <span>Adress:</span>
            <input type="text" placeholder="enter your adress" name="adress" required>
          </div>
          <div class="inputBox">
            <span>Where to :</span>
            <input type="text" placeholder="place you want to visit" name="location" required>
          </div>
          <div class="inputBox">
            <span>How many :</span>
            <input type="number" placeholder="number of guests" name="guests" required>
          </div>
          <div class="inputBox">
            <span>Arrivals :</span>
            <input type="date" name="Arrivals" required>
          </div>
          <div class="inputBox">
            <span>Leaving :</span>
            <input type="date" name="Leaving" required>
          </div>
        </div>

        <input type="submit" name="submit_booking" value="Book Now" class="btn">
      </form>

      <p class="need-auth">
        You need an account to book a trip.
        <a href="login.php" class="btn">Log In</a>
        Or
        <a href="register.php" class="btn">Register</a>
      </p>
    </section>

    <section class="footer">
      <div class="box-container">
        <div class="box">
          <h3>quick links</h3>
          <a href="home.php"><i class="fas fa-angle-right"></i> home</a>
          <a href="about.php"><i class="fas fa-angle-right"></i> about</a>
          <a href="package.php"><i class="fas fa-angle-right"></i>package</a>
          <a href="book.php"><i class="fas fa-angle-right"></i> book</a>
        </div>
        <div class="box">
          <h3>extra links</h3>
          <a href="#"><i class="fas fa-angle-right"></i>ask question</a>
          <a href="#"><i class="fas fa-angle-right"></i>about us</a>
          <a href="#"><i class="fas fa-angle-right"></i>privacy policy</a>
          <a href="#"><i class="fas fa-angle-right"></i>terms of use</a>
        </div>
        <div class="box">
          <h3>contact info</h3>
          <a href="#"><i class="fas fa-phone"></i>+71-999-999</a>
          <a href="#"><i class="fas fa-phone"></i>+71-888_888</a>
          <a href="#"><i class="fas fa-envelope"></i>agence@gmail.com</a>
          <a href="#"><i class="fas fa-map"></i>tunis, bardo</a>
        </div>
        <div class="box">
          <h3>follow us</h3>
          <a href="#"><i class="fab fa-facebook-f"></i>facebook</a>
          <a href="#"><i class="fab fa-twitter"></i>twitter</a>
          <a href="#"><i class="fab fa-instagram"></i>instagram</a>
          <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>
        </div>
      </div>
      <div class="credit"> created by <span>Ghait & Anis</span> all rights reserved!  </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="script.js"></script>
  </body>
</html>

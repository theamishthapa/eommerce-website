<?php
    session_start();
    require_once 'db.php';
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Commerce Layout with Slider</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />

    <link rel="stylesheet" href="ecom.css" />
  </head>
  <body>
    <div class="wrapper">
      <div class="header">
        <div class="logo">Yo Kindeu👠</div>

        <div class="header-title">#1 Online Shoe Store</div>

        <div class="header-right">
          <!-- cart icon -->
          <a href="cart.php"><i class="fas fa-shopping-cart cart-icon"></i></a>

          <!-- searchbox -->
          <input type="text" placeholder="Search..." class="search-box" />

          <!-- socials -->
          <div class="social-icons">
            <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
          </div>
        
          <?php
          if(!isset($_SESSION['id'])){
          ?>
          <button class="auth-btn" onclick="toggleOverlay('login')">
            Login
          </button>
          <button class="auth-btn" onclick="toggleOverlay('signup')">
            Sign Up
          </button>
          <?php
          }
          else{
          ?>
          <a href="logout.php" class="auth-btn">
            Logout</a>
          <?php
          }
          ?>
        </div>
      </div>

      <div class="body">
        <div class="menu">
          <h3>Categories</h3>

          <div class="menu-item">
            <a href="#">Sneakers</a>
            <div class="submenu">
              <a href="#">Running</a>
              <a href="#">Street Style</a>
            </div>
          </div>

          <div class="menu-item">
            <a href="#">Sports</a>
            <div class="submenu">
              <a href="#">Football</a>
              <a href="#">Basketball</a>
            </div>
          </div>

          <div class="menu-item">
            <a href="#">Casual</a>
            <div class="submenu">
              <a href="#">Loafers</a>
              <a href="#">Sandals</a>
            </div>
          </div>

          <div class="menu-item">
            <a href="#">Boots</a>
            <div class="submenu">
              <a href="#">Leather</a>
              <a href="#">Winter</a>
            </div>
          </div>
        </div>

        <div class="content">
          <h2>Welcome to our store!</h2>
          <p>Today's Featured Items</p>

          <!-- Image Slider -->
          <div class="slider">
            <div class="slides" id="slides">
              <div class="slide">
                <img
                  class="img1"
                  src="./images/sneakers.webp"
                  alt="Slide 1"
                />
              </div>
              <div class="slide">
                <img src="./images/heels.jpg" alt="Slide 2" />
              </div>
              <div class="slide">
                <img src="./images/converse.jpg" alt="Slide 3" />
              </div>
            </div>
            <button class="slider-btn prev" onclick="prevSlide()">❮</button>
            <button class="slider-btn next" onclick="nextSlide()">❯</button>
          </div>

          <!-- grid section -->
          <h3>Featured Products</h3>

          <?php
            include_once 'products.php';
          ?>
        </div>
      </div>

      <div class="footer">
        <p>&copy; 2025 My E-Commerce Site. All rights reserved.</p>
      </div>
    </div>

    <!-- Overlay Form -->
    <div id="overlay" class="overlay">
      <div class="overlay-content">
        <span class="close-btn" onclick="closeOverlay()">✖</span>
        <h2 id="formTitle">Login</h2>
        <form action="auth.php" method="POST">
          <input type="text" placeholder="Username" name="username" value="<?php if(isset($_SESSION['username']))echo $_SESSION['username']; ?>" required /><br />
          <input type="password" placeholder="Password" name="password" required /><br />
          <button type="submit" class="submit-btn" id="submit" name="submit">Submit</button>
        </form>
      </div>
    </div>

    <script src="ecom.js"></script>
  </body>
</html>

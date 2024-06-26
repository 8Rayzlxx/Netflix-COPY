<?php
include 'includes/db_connection.php';
include 'includes/functions.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="description" content="Hello this is my first web page!." />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <title>Netflix India - Watch TV Shows Online, Watch Movies Online</title>
  <link rel="icon" href="img/netflix_PNG15.png"/>
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="navbar__brand">
        <img src="img/netflix-logo-0.png" alt="logo" class="brand__logo" />
      </div>

      <div class="navbar__nav__items">
        <div class="nav__item">
          <div class="dropdown__container">
            <i class="fas fa-globe"></i>
            <select name="languages" id="languagesSelect" class="language__drop__down">
              <option value="english" selected style="color: black;">English</option> 
            </select>
          </div>
        </div>

        <div class="nav__item">
          <a href="../natin_film_db_2024-main/pages/signin.php"><button class="signin__button">Sign in</button></a>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <section class="hero">
      <div class="hero__bg__image__container">
        <img src="img/bg-img.jpg" alt="BG hero image" class="hero__bg__image" />
      </div>
      <div class="hero__bg__overlay"></div>

      <div class="hero__card">
        <h1 class="hero__title">
          Unlimited Movies TV,<br />
          Shows and More.
        </h1>
        <p class="hero__subtitle">Watch anywhere and cancel anytime.</p>
        <p class="hero__description">
          Ready to watch? Enter your email to create or restart your
          membership .
        </p>

        <div class="email__form__container">
          <div class="form__container">
            <input id="emailInput" type="email" class="email__input" placeholder="Email Address" name="mail"/>
            <label class="email__label"></label>
          </div>
          <a id="signinButton" href="../natin_film_db_2024-main/pages/signin.php" type="submit" class="primary__button">Sign Up!</a>
        </div>
    </section>
    <section class="features__container">
      <!-- Feature 1 -->
      <div class="feature">
        <div class="feature__details">
          <h3 class="feature__title">Enjoy on your TV.</h3>
          <h5 class="feature__sub__title">
            Watch on smart TVs, PlayStation, Xbox, Chromecast, Apple TV,
            Blu-ray players and more.
          </h5>
        </div>
        <div class="feature__image__container">
          <img src="img/tv.png" alt="Feature image" class="feature__image" />
          <div class="feature__backgroud__video__container">
            <video autoplay="" loop="" muted="" class="feature__backgroud__video">
              <source src="img/video-tv-in-0819.m4v" type="video/mp4" />
            </video>
          </div>
        </div>
      </div>
      <!-- Feature 2 -->
      <div class="feature">
        <div class="feature__details">
          <h3 class="feature__title">
            Download your shows to watch offline.
          </h3>
          <h5 class="feature__sub__title">
            Save your favourites easily and always have something to watch.
          </h5>
        </div>
        <div class="feature__image__container">
          <img src="img/mobile-0819.jpg" alt="Feature image" class="feature__image" />
          <div class="feature__2__poster__container">
            <div class="poster__container">
              <img src="img/boxshot.png" alt="poster" class="poster" />
            </div>
            <div class="poster__details">
              <h4>Stranger Things</h4>
              <h6>Downloading...</h6>
            </div>
            <div class="download__gif__container">
              <img src="img/download-icon.gif" alt="downloading gif" class="gif" />
            </div>
          </div>
        </div>
      </div>

      <!-- Feature 4 -->
      <div class="feature">
        <div class="feature__details">
          <h3 class="feature__title">Create profiles for children.</h3>
          <h5 class="feature__sub__title">
            Send children on adventures with their favourite characters in a
            space made just for them—free with your membership.
          </h5>
        </div>
        <div class="feature__image__container">
          <img src="img/AAAABVxdX2WnFSp49eXb1do0euaj-F8upNImjofE77XStKhf5kUHG94DPlTiGYqPeYNtiox-82NWEK0Ls3CnLe3WWClGdiJP.png" alt="Feature image" class="feature__image" />
        </div>
      </div>
    </section>

  </main>

  <footer class="f1">
    <div class="footer__row__1">
      <h4>Questions? Call 000-800-040-1843</h4>
    </div>
    <div class="footer__row__2">
      <div class="column__1">
        <p>FAQ</p>
        <p>Investor Relations</p>
        <p>Privacy</p>
        <p>Speed Test</p>
      </div>
      <div class="column__2">
        <p>Help Centre</p>
        <p>Jobs</p>
        <p>Cookie Preferences</p>
        <p>Legal Notices</p>
      </div>
      <div class="column__3">
        <p>Account</p>
        <p>Ways to Watch</p>
        <p>Corporate Information</p>
        <p>Only on Netflix</p>
      </div>
      <div class="column__4">
        <p>Media Centre</p>
        <p>Terms of Use</p>
        <p>Contact Us</p>
      </div>
    </div>
    <div class="footer__row__3">
      <div class="dropdown__container">
        <i class="fas fa-globe"></i>
        <select name="languages" id="languagesSelect" class="language__drop__down">
          <option value="english" selected>English</option>
          <option value="hindi">हिन्दी</option>
        </select>
      </div>
    </div>
    <div class="footer__row__4">
      <p>Netflix India</p>
    </div>
  </footer>

  <script src="js/index.js"></script>
</body>

</html>
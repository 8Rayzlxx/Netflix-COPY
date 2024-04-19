<?php
session_start();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Login</title>
    <link rel="icon" href="../img/netflix_PNG15.png"/>
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<header>
    <nav class="navbar">
      <div class="navbar__brand">
        <a href="../index.php"><img src="../img/netflix-logo-0.png" alt="logo" class="brand__logo"/></a>
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
        <a href="../pages/signin.php"><button class="signin__button">Login</button></a>
        </div>
      </div>
    </nav>
  </header>
      <div class="hero__bg__overlay"></div>
<body>

<div class="wrapper">
    <form action="../includes/user-signup.php" method="POST">
        <h2>Sign up Now!!</h2>
        <h3>Start your 30 day free-trail now!</h3>
        <div class="input-group">
            <span class="icon">
                <ion-icon name="person"></ion-icon>
            </span>
            <input type="text" class="form-control" placeholder="Full name" name="fullname">
        </div>
        <div class="input-group">
            <span class="icon">
                <ion-icon name="calendar-outline"></ion-icon>
            </span>
            <input type="date" placeholder="Date of birth"name="dateofbirth">
        </div>
        <div class="input-group">
            <span class="icon">
                <ion-icon name="mail"></ion-icon>
            </span>
            <input type="email" placeholder="Email Address"name="email">
        </div>
        <div class="input-group">
            <span class="icon">
                <ion-icon name="lock-closed"></ion-icon>
            </span>
            <input type="password" placeholder="Password"name="passwrd">
        </div>
        <div class="input-group">
            <span class="icon">
                <ion-icon name="call-outline"></ion-icon>
            </span>
            <input type="number" placeholder="Phone number"name="number">
        </div>
        <button type="submit" class="btn">Sign up</button>
        <div class="sign-link">
            <p>Are you an admin? <a href="../pages/prank.php" class="register-link">login here</a></p>
        </div>
    </form>
</div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
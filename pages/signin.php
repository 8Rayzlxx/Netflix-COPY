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
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<header>
    <nav class="navbar">
      <div class="navbar__brand">
        <a href="../index.php"><img src="../img/netflix-logo-0.png" alt="logo" class="brand__logo" /></a>
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
        <a href="../pages/signup.php"><button class="signin__button">Sign up</button></a>
      </div>
      </div>
    </nav>
  </header>
      <div class="hero__bg__overlay"></div>
<body>

    <div class="wrapper">
        <form action="../includes/user-login.php" method="POST">
            <h2>Login</h2>
            <div class="input-group">
                <span class="icon">
                    <ion-icon name="person"></ion-icon>
                </span>
                <input type="email" class="form-control" placeholder="Email Address" name="mail" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
            </div>
            <div class="input-group">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" placeholder="Password" required name="pass">
            </div>
            <div class="forgot-pass">
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="sign-link">
                <p>Are you an admin? <a href="../pages/prank.php" class="register-link">login here</a></p>
            </div>
        </form>
        <!-- Display the popup message using JavaScript -->

    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
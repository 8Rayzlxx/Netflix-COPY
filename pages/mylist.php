<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Please login to view your movie list.');</script>";
    echo "<script>window.location.href = 'signin.php';</script>";
    exit();
}

// Get the user ID from the session
$userId = $_SESSION['id'];

// Include your database connection file
include '../includes/db_connection.php';

// Fetch movies added by the user
$sql = "SELECT movies.* FROM movies INNER JOIN list ON movies.mid = list.mid WHERE list.id = $userId";
$result = $conn->query($sql);

// Fetch shows added by the user

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tagss for new branch -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/landing.css">
    <link rel="stylesheet" href="../css/movie.css">
    <title>Netflix Admin</title>
    <link rel="icon" href="../img/netflix_PNG15.png"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
    
    <div style="position: relative;">
    <!-- header -->
    <nav class="navbar navbar-expand-lg netflix-navbar netflix-padding-left netflix-padding-right" id="navbar">
      <div class="container-fluid">
        <div class="netflix-row">
          <div class="left d-flex align-items-center">
            <a class="navbar-brand" href="#">
            <?php
            if (isset($_SESSION['id'])) {
                if ($_SESSION['id'] == 1) {
                    echo "<img src='../img/oglogo.png'>"; // Display admin profile if session id is 1
                } else {
                    echo "<img src='../img/netflix-logo-0.png'>"; // Display another image if session id is not 1
                }
            }
            ?>
            </a>
            <div  class="netflix-nav">
               <section>
                <!--php that checks if login user has an id of 1 then it displays the admin-controlls-->
               <?php
              if (isset($_SESSION['id'])) {
                if ($_SESSION['id'] == 1) {
                  echo "<a href='../pages/movieadd.php'><button>Add-movie</button></a>";
                }
              }
              ?>
              <?php
              if (isset($_SESSION['id'])) {
                if ($_SESSION['id'] == 1) {
                  echo "<a href='../pages/tvshowadd.php'><button>Add-Tv Show</button></a>";
                }
              }
              ?>
              <!--END HERE BTW-->
              <a href="../pages/homepage.php"><button>Home</button></a>
              <a href="../pages/homepage.php"><button>Movies & Tv Shows</button></a>
              <a href="../pages/mylist.php"><button>My List</button></a>
               </section>
            </div>
          </div>
          <div class="right d-flex align-items-center">
          <!-- Container for the search form -->
<div id="searchContainer" class='col' style="display: none;">
    <!-- Search form -->
    <form action="search.php" method="POST">
        <select name="option" style="padding: 5px;">
            <option value="name">Name</option>
            <option value="genre">Genre</option>
            <option value="rdate">Release year</option>
        </select>
        <input type="text" placeholder="Search..." style="margin-left: 10px; margin-top: 10px; padding: 5px;" name="textoption">
        <input type="submit" name="submit" class="btn btn-success" style="display: inline; width: 100px; margin-left: 20px; margin-right: 20px; margin-bottom: 5px;" value="Search">
    </form>
</div>

<!-- Button to toggle search form visibility -->
<i id="toggleSearchFormBtn" class="bi bi-search" style="cursor: pointer;"></i>


<!-- JavaScript to toggle search form visibility -->
<script>
    // Get references to the search container and the toggle button
    var searchContainer = document.getElementById("searchContainer");
    var toggleSearchFormBtn = document.getElementById("toggleSearchFormBtn");

    // Add click event listener to the toggle button
    toggleSearchFormBtn.addEventListener("click", function() {
        // Toggle the display style of the search container
        if (searchContainer.style.display === "none") {
            searchContainer.style.display = "block";
        } else {
            searchContainer.style.display = "none";
        }
    });
</script>
            <i class="bi bi-bell-fill"></i>
            <section class="netflix-profile">
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="profileDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php
            if (isset($_SESSION['id'])) {
                if ($_SESSION['id'] == 1) {
                    echo "<img src='../img/profile.jpg'>"; // Display admin profile if session id is 1
                } else {
                    echo "<img src='../img/otherpfp.jpg'>"; // Display another image if session id is not 1
                }
            }
            ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="profileDropdownMenu">
        <a class="dropdown-item" href="../includes/sessiondestroy.php">Logout</a>
        </div>

    </div>
</section>
<!-- Bootstrap JS for the dropdwon menu-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--How it works idk dont ask m-->
          </div>
        </div>
      </div>
    </nav>
    <!-- /header -->
    <script>
  // Get the navbar element
  var navbar = document.getElementById("navbar");

  // Listen for the scroll event
  window.addEventListener("scroll", function() {
    // Check if the user has scrolled down more than 100px
    if (window.scrollY > 100) {
      // Add the "scrolled" class to the navbar
      navbar.classList.add("scrolled");
    } else {
      // Remove the "scrolled" class from the navbar
      navbar.classList.remove("scrolled");
    }
  });
</script>

<body>
    <div class="container">
    <br><br><br>
        <h1 style="color: white;">My Movie List</h1>
        <br>
        <div class="row" style="width: 51%;">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Display movie details inside anchor tag
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<a href='listmovie.php?movie_id={$row['mid']}' class='card-link'>";
                    echo "<div class='card'>";
                    echo "<img src='../thumbnails/{$row['imgpath']}' class='card-img-top' alt='Movie Image'>";
                    echo "<div class='card-body'>";
                    echo "<form action='../pages/listmovie.php' method='GET'>";
                    echo "<input type='hidden' name='movie_id' value='{$row['mid']}'>";
                    echo "<button style='background-color: red;
                    border-block-color: red;' type='submit' name='submit' class='btn btn-primary'>Watch '{$row['name']}'</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No movies added to your list yet.</p>";
            }
            ?>
        </div>
    </div>
</body>
<body>
    <div class="container2" style="margin-left: 104px">
        <h1 style="color: white;">My Tv-Show List</h1>
        <br>
        <div class="row" style="width: 47%;">
            <?php
              include '../pages/tvlist.php';
            ?>
        </div>
    </div>
</body>


</html>

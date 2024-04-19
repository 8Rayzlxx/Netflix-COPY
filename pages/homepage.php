<?php
session_start();
// Check if the session variable for video played exists and is true
if (!isset($_SESSION['video_played']) || !$_SESSION['video_played']) {
    // Set the session variable to true to indicate that the video has been played
    $_SESSION['video_played'] = true;
?>

<div id="splashscreen">
    <video id="splashVideo" src="../img/videoplayback.mp4" autoplay muted></video>
    <audio id="splashAudio" src="../img/logoplay.mp3" autoplay></audio>
</div>

<script>
    // Get the video and audio elements
    var video = document.getElementById("splashVideo");
    var audio = document.getElementById("splashAudio");

    // Listen for the 'ended' event on both video and audio
    video.addEventListener('ended', function() {
        // Hide the splashscreen div when the video ends
        document.getElementById("splashscreen").style.display = "none";
    });

    audio.addEventListener('ended', function() {
        // Hide the splashscreen div when the audio ends
        document.getElementById("splashscreen").style.display = "none";
    });
</script>

<style>
    #splashscreen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 9999; /* Set a high z-index to ensure it appears on top */
    }

    #splashscreen video {
        min-width: 100%; 
        min-height: 100%;
        width: auto;
        height: auto;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<?php
}
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tagss for new branch -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link rel="icon" href="../img/netflix_PNG15.png"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/landing.css">
    <title>Netflix Admin</title>
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
              <button onclick="scrollToTop()">Home</button>
                <script>
                  function scrollToTop() {
                    // Scroll to the top of the page
                      window.scrollTo({
                        top: 0,
                        behavior: "smooth" // Smooth scroll behavior
                      });
                  }
                </script>
                
                  <button id="scrollBtn">Movies & Tv Shows</button>
                  <a href="../pages/mylist.php"><button>My List</button></a>
               </section>
               <script>
                document.getElementById("scrollBtn").addEventListener("click", function() {
                 // Scroll down 100 pixels vertically
                 window.scrollBy(0, 700);
                 });
               </script>
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


    <!-- video -->
      <div class="">
         <section class="netflix-home-video">
            <div class="top"></div>
            <div class="bottom"></div>
            <video id="myVideo" src="../img/finallandofbad.mp4" loop></video>
            <div class="content">
                <section class="left">
                    <img src="../img/landofbadtext.png" alt="">
                
                    <div class="d-flex mt-2">
                      <button id="playButton" class="btn btn-light m-2" > <i class="bi bi-play-fill" style="color: black; padding: 0%;"></i> Watch Trailer </button>
                      <a href="https://www.imdb.com/title/tt19864802/?ref_=fn_al_tt_1"><button class="btn btn-secondary m-2"><i class="bi bi-info-circle" style=" padding: 0%;"></i> More Info</button></a>
                    </div>
                </section>
               
            </div>
          </section>
         
      </div>
    <!-- video -->

    <!-- code is added here bc im to lazy to figure out why it doesnt work when placed in a diff js document -->
    <script>
document.getElementById("playButton").addEventListener("click", function() {
    var video = document.getElementById("myVideo");
    var imgAndButton = document.querySelector(".content"); // Select the container of the image and play button

    if (video.paused) {
        // If the video is paused, play it and fade out the image and play button
        video.play();
        imgAndButton.style.opacity = "8%"; // Set opacity to 0 for fading out
        this.innerHTML = '<i class="bi bi-pause-fill" style="color: black; padding: 0%;"></i> Pause'; // Change button text/icon to "Pause"
    } else {
        // If the video is playing, pause it and reset the video
        video.pause();
        video.currentTime = 0; // Set current time of the video to 0
        imgAndButton.style.opacity = "100%"; // Reset opacity
    }
});

// Add CSS transition for smoother fading effect
document.querySelector(".content").style.transition = "opacity 1.0s ease";
</script>


 
<!-- yeah it ends here btw DONT TOUCH IT -->

      <!-- sliders -->
      <div class="slider-box">
        <div class="container-fluid slider">
          
        <div class="jumbotron">
        <h2 style='margin-top:10px;'>Movies </h2>
          <div class="row">
            <?php
              include '../includes/moviefetcher.php';
             ?>
          </div>
      </div>

      <div class="jumbotron" style="margin-top: -5px;">
        <h2 style='margin-top:10px;'>Tv Shows </h2>
          <div class="row">
            <?php
              include '../includes/tvshowfetcher.php';
             ?>
          </div>
      </div>
      


              </div>
            </div>
            
          </div>
        </div> 






























</div>
</section>
      <!-- footer  -->
      

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->


    <script src="../js/index.js"></script>
  </body>
</html>
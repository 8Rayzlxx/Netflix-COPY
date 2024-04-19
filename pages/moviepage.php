<?php
session_start();

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
    <link rel="stylesheet" href="../css/moviepage.css">
    <title>Netflix Admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
    
    <div style="position: relative;">
    <!-- header -->
    <nav class="navbar navbar-expand-lg netflix-navbar netflix-padding-left netflix-padding-right">
      <div class="container-fluid">
        <div class="netflix-row">
          <div class="left d-flex align-items-center">
            <a class="navbar-brand" href="#">
              <img id="scrollTop" src="../img/oglogo.png" alt="">
              <script>
                document.getElementById("scrollTop").addEventListener("click", function() {
                 // Scroll down 100 pixels vertically
                 window.scrollBy(700, 0);
                 });
               </script>
            </a>
            <div  class="netflix-nav">
               <section>
                  <a href="../pages/movieadd.php"><button>Admin
                  </button></a>
                  <button id="scrollBtn">Movies</button>
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
          <div class='col'>
  </div>
            <i class="bi bi-bell-fill"></i>
            <section class="netflix-profile">

            </section>
          </div>
        </div>
      </div>
    </nav>
    <!-- /header -->


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
                      <button id="playButton" class="btn btn-light m-2" > <i class="bi bi-play-fill" style="color: black; padding: 0%;"></i> Watch Now</button>
                    </div>
                    <?php
    if (isset($_POST['submit'])) {

      $title = $_POST['submit'];

      include '../includes/db_connection.php';
      $im = "SELECT * FROM movies WHERE name = '$title'";

      $records = mysqli_query($conn,$im);

      while($result = mysqli_fetch_assoc($records)){
        $mname = $result['name'];
        $person = $_SESSION['id'];
        $movieid = $result['mid'];
        $current = $result['viewers'];
        $newcount = $current + 1;
        $newsql = "UPDATE movies SET viewers = '$newcount' WHERE name='$mname' ";
        $nsql = "UPDATE user1 SET mid = '$movieid' WHERE id ='$person' ";
        $updatecount = mysqli_query($conn,$newsql);
        $updatecount = mysqli_query($conn,$nsql);
        echo "<br>";
        echo "<h5 style='display: inline;'>Movie Name: </h5><h1 style='display: inline;'>".ucwords($result['name'])."</h1>";
        echo "<br><h5 style='display: inline;'>Genre: </h5><h4 style='display: inline;'>".ucwords($result['genre'])."</h4>";
        echo "<br><h5 style='display: inline;'>Release Year: </h5><h4 style='display: inline;'>".$result['rdate']."</h4>";
        echo "<br><h5 style='display: inline;'>Directed By: </h5><h4 style='display: inline;'>".$result['regisseur']."</h4>";
        echo "<br><h5 style='display: inline;'>Cast: </h5><h4 style='display: inline;'>".$result['cast']."</h4>";
        echo "<br><h5 style='display: inline;'>Runtime: </h5><h4 style='display: inline;'>".$result['runtime']." mins </h4>";
        echo "<br><h5 style='display: inline;'>Description: </h5><h4 style='display: inline;'>".ucfirst($result['decription'])."</h4>";
        echo "<br><h5 style='display: inline;'>Views: </h5><h4 style='display: inline;'>".$result['viewers']."</h4>";
        echo "<br><br><br>";
      }
    }
    ?>
                </section>
               
            </div>
          </section>
         
      </div>
    <!-- video -->

    <!-- code is added here bc im to lazy to figure out why it doesnt work when placed in a diff js document -->
<script>
document.getElementById("playButton").addEventListener("click", function() {
    var video = document.getElementById("myVideo");
    if (video.paused) {
        video.play();
        this.innerHTML = '<i class="bi bi-pause-fill" style="color: black; padding: 0%;"></i> Pause'; // Change button text/icon to "Pause"
    } else {
        video.pause();
        location.reload(); // Reload the webpage when the video is paused
    }
});
</script>    
<!-- yeah it ends here btw DONT TOUCH IT -->

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
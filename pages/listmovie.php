<?php
session_start();




// Check if the form is submitted with a movie title
if (isset($_POST['submit'])) {
    $title = $_POST['submit'];
    include '../includes/db_connection.php';
    $im = "SELECT * FROM movies WHERE name = '$title'";
    $records = mysqli_query($conn, $im);
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/listmovie.css">
    <link rel="stylesheet" href="../css/listmovie2.css">
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

<?php
// Include your database connection file
include '../includes/db_connection.php';

// Check if the movie_id parameter is set in the URL
if(isset($_GET['movie_id'])) {
    // Sanitize the movie_id parameter to prevent SQL injection
    $movie_id = mysqli_real_escape_string($conn, $_GET['movie_id']);

    // Fetch the details of the selected movie from the database
    $sql = "SELECT * FROM movies WHERE mid = '$movie_id'";
    $result = $conn->query($sql);

    // Check if the movie exists in the database
    if ($result->num_rows > 0) {
        // Fetch movie details
        $movie = $result->fetch_assoc();
        $mname = $movie['name']; // Assign movie name to $mname variable

        // Update the view count of the movie
        $new_count = $movie['viewers'] + 1;
        $update_sql = "UPDATE movies SET viewers = $new_count WHERE mid = '$movie_id'";
        $conn->query($update_sql);

        // Display the movie details
        echo "<div class='jumbotron-fluid'>";
        echo "<div class='container'>";
        echo "<div class='embed-responsive embed-responsive-16by9' style='width: 500px; height: 300px;'>";
        echo "<iframe id='videoPlayer' class='embed-responsive-item' src='{$movie['link']}'></iframe>";
        echo "</div>";
        echo "<div class='img'>";
        echo "<img src='../thumbnails/{$movie['imgpath']}' height='280' width='200' style='margin-top: 112px; margin-left: 30px; margin-right: 20px;' />";
        echo "</div>";
        echo "<div class='text'>";
        echo "<h1>" . ucwords($movie['name']) . "</h1>";
        echo "<h5>" . ucfirst($movie['decription']) . "</h5>";
        echo "<div class='elements'>";
        echo "<br><strong>Genre :</strong> " . ucwords($movie['genre']) . "<br>";
        echo "<strong>Release Year :</strong> " . $movie['rdate'] . "<br>";
        echo "<strong>Production :</strong> " . $movie['regisseur'] . "<br>";
        echo "<strong>Cast :</strong> " . $movie['cast'] . "<br>";
        echo "<strong>Runtime :</strong> " . $movie['runtime'] . " mins<br>";
        echo "<strong>Views :</strong> " . $new_count . "<br>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p>No movie details available.</p>";
    }
} else {
    echo "<p>Movie ID not provided.</p>";
}
?>

                    <br><br><br>
                    
                    <?php
// Check if the user is logged in and is an admin
if (isset($_SESSION['id']) && $_SESSION['id'] == 1) {
    // Display the delete button only for admins
    echo '
    <div class="delete">
        <form action="../includes/deletemovie.php" method="post" style="display: inline;">
            <input type="hidden" name="delete_title" value="' . $mname . '">
            <button type="submit" name="delete_submit" onclick="return confirm(\'Are you sure you want to delete this movie?\');" style="font-size: 20px;color:white;background-color:#2d2f33;border:3px solid red;border-radius:5px;padding:10px;text-decoration:none;">Delete Movie</button>
        </form>
    </div>';
  }
?>
 <?php
// Check if the user is logged in and is an admin
if (isset($_SESSION['id']) && $_SESSION['id'] == 1) {
    // Display the "Edit Movie" button only for admins
    echo '<div class="edit">
            <button style="font-size: 20px;color:white;background-color:#2d2f33;border:3px solid red;border-radius:5px;padding:10px;text-decoration:none;" onclick="openEditForm()">Edit Movie</button>
          </div>';
}
?>

<div id="floatingWindow" class="wrapper" style="display: none; position: fixed; top: 41%; left: 50%; transform: translate(-50%, -50%);padding: 20px; border: 1px solid black;">
<h1 onclick="closeEditForm()" >Edit Movie Details</h1>
<form class="" action="../includes/editmovie.php" method="post">
        <button onclick="closeEditForm()" type="submit" name="edit_submit" style="font-size: 20px;color:white;background-color:#2d2f33;border:3px solid red;border-radius:5px;padding:10px;text-decoration:none;">Save Changes</button>
        <br><br>
        <input class="form" type="text" name="edit_title" value="<?php echo $mname; ?>">
        <br>
        <!-- input fields for editing movie information -->
        <input class="form" type="text" name="edit_decription" value="<?php echo $result['decription']; ?>">
        <br>
        <input class="form" type="text" name="edit_genre" value="<?php echo $result['genre']; ?>">
        <br>
        <input class="form" type="text" name="edit_rdate" value="<?php echo $result['rdate']; ?>">
        <br>
        <input class="form" type="text" name="edit_regisseur" value="<?php echo $result['regisseur']; ?>">
        <br>
        <input class="form" type="text" name="edit_cast" value="<?php echo $result['cast']; ?>">
        <br>
        <input class="form" type="text" name="edit_rtime" value="<?php echo $result['runtime']; ?>">
        <br>
        <input class="form" type="text" name="edit_link" value="<?php echo $result['link']; ?>">
        <br>
        <input class="form" type="text" name="edit_imgpath" value="<?php echo $result['imgpath']; ?>">
        <!-- input fields for other movie information -->
<br>

    </form>
    
</div>

<script>
    $(function() {
        $("#floatingWindow").draggable();
    });

    function openEditForm() {
        document.getElementById('floatingWindow').style.display = 'block';
    }

    function closeEditForm() {
        document.getElementById('floatingWindow').style.display = 'none';
    }

</script>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<div class="list">
    <form action="../includes/addtolist.php" method="post">
        <input type="hidden" name="mid" value="<?php echo $result['mid']; ?>">
        <button type="submit" style="font-size: 20px;color:white;background-color:#2d2f33;border:3px solid red;border-radius:5px;padding:10px;text-decoration:none;">Add To List</button>
    </form>
</div>        
        </div>
    </div>


</body>

</html>
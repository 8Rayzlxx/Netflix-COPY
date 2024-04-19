<?php
session_start();

// Initialize $title variable
$title = "";

// Check if the form is submitted for deleting the movie
if (isset($_POST['delete_submit'])) {
    include '../includes/db_connection.php';
    $delete_title = $_POST['delete_title'];
    
    // Update associated records in user1 table by setting mid to NULL
    $update_associated_query = "UPDATE user1 SET tvid = NULL WHERE tvid = (SELECT tvid FROM tvshows WHERE name = '$delete_title')";
    $update_associated_result = mysqli_query($conn, $update_associated_query);
    
    // Then, delete the movie record
    $delete_query = "DELETE FROM tvshows WHERE name = '$delete_title'";
    $delete_result = mysqli_query($conn, $delete_query);
    
    if ($delete_result) {
        echo "<script>alert('Movie deleted successfully!');</script>";
        // Redirect to homepage or any other page after successful deletion
        echo "<script>window.location.href = 'homepage.php';</script>";
        exit; // Terminate the script after redirection
    } else {
        echo "<script>alert('Failed to delete movie!');</script>";
    }
}

// Check if the form is submitted with a movie title
if (isset($_POST['submit'])) {
    $title = $_POST['submit'];
    include '../includes/db_connection.php';
    $im = "SELECT * FROM tvshows WHERE name = '$title'";
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

<div class='jumbotron-fluid'>
  
        <div class='container'>
            <?php
            // Check if $records is defined
            if (isset($records)) {
                while ($result = mysqli_fetch_assoc($records)) {
                    $mname = $result['name'];
                    $person = $_SESSION['id'];
                    $movieid = $result['tvid'];
                    $current = $result['viewers'];
                    $newcount = $current + 1;
                    $newsql = "UPDATE tvshows SET viewers = '$newcount' WHERE name='$mname' ";
                    $nsql = "UPDATE user1 SET tvid = '$movieid' WHERE id ='$person' ";
                    $updatecount = mysqli_query($conn, $newsql);
                    $updatecount = mysqli_query($conn, $nsql);
            ?>
                    <br>

                    <br><br><br>
                    <div class='embed-responsive embed-responsive-16by9' style='width: 500px; height: 300px;'>
                    <iframe class='embed-responsive-item' src="<?php echo $result['link']; ?>"></iframe>
                    </div>
                    <div class="img">
                      <img src="../thumbnails/<?php echo $result['imgpath']; ?>" height="280" width="200" style="margin-top: 30px; margin-left: 30px; margin-right: 20px;" />
                  </div>
<div class="text">             
                    <br><br>
                    <h1 style='display: inline;'><?php echo ucwords($result['name']); ?></h1>
                    <br><br><h5 style='display: inline;'><?php echo ucfirst($result['decription']); ?></h5>
                    <div class="elements">
                    <br><strong>Genre : </strong><?php echo ucwords($result['genre']); ?>
                    <br><strong>Release Year : </strong><?php echo $result['rdate']; ?>
                    <br><strong>Production: </strong><?php echo $result['regisseur']; ?>
                    <br><strong>Cast: </strong><?php echo $result['cast']; ?></h6>
                    <br><strong>Episodes : </strong><?php echo $result['runtime']; ?>
                    
                    <br><strong>Views : </strong><?php echo $result['viewers']; ?>
                    </div>
</div>
                    <br><br><br>
                    <div class="admin">
                    <?php
// Check if the user is logged in and is an admin
if (isset($_SESSION['id']) && $_SESSION['id'] == 1) {
    // Display the delete button only for admins
    echo '
    <div class="delete">
        <form action="../includes/deleteshows.php" method="post" style="display: inline;">
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
<form class="" action="../includes/edittvshow.php" method="post">
        <button onclick="closeEditForm()" type="submit" name="edit_show" style="font-size: 20px;color:white;background-color:#2d2f33;border:3px solid red;border-radius:5px;padding:10px;text-decoration:none;">Save Changes</button>
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

</div>
<div class="list">
    <form action="../includes/addtolist.php" method="post">
        <input type="hidden" name="tvid" value="<?php echo $result['tvid']; ?>" >
        <button type="submit" style="font-size: 20px;color:white;background-color:#2d2f33;border:3px solid red;border-radius:5px;padding:10px;text-decoration:none;">Add To List</button>
    </form>
</div>



            <?php
                }
            } else {
                // No movie title submitted or no records found
                echo "No movie details available.";
            }
            ?>
        </div>
    </div>


</body>

</html>
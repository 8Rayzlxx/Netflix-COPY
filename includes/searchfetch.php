<?php
include 'db_connection.php';
if(isset($_POST['submit'])){

    $option = $_POST['option'];
    $text =  strtolower($_POST['textoption']);
    $person = $_SESSION['id'];

    // Query for movies
    $movie_found = "SELECT * FROM movies WHERE $option LIKE '$text%'";
    $movie_display = mysqli_query($conn,$movie_found);

    // Query for TV shows
    $tvshow_found = "SELECT * FROM tvshows WHERE $option LIKE '$text%'";
    $tvshow_display = mysqli_query($conn,$tvshow_found);

    // Combine the result sets
    $combined_results = array_merge(mysqli_fetch_all($movie_display, MYSQLI_ASSOC), mysqli_fetch_all($tvshow_display, MYSQLI_ASSOC));

    // Display combined results
    $i = 0;
    echo "<div class='row'>";
    foreach($combined_results as $final) {
        echo "<div class='col'>";
        echo "<form action='../pages/";
        echo isset($final['imgpath']) ? "movie.php" : "tvshow.php";
        echo "' method='POST'>";
        echo "<img src='../thumbnails/".$final['imgpath']."' height='280' width='200' style='margin-top: 30px;margin-left:30px;margin-right:20px;' />";
        echo "<div class='noob'>";
        echo "<input type='submit' name='submit' class='btn btn-outline-info' style='display:block;width:200px;padding-bottom:15px;margin-bottom:30px;margin-left:30px;margin-right:20px;' value='".ucwords($final['name'])."'/>";
        echo "</div>";
        echo "</form>";
        echo "</div>";

        $i++;
        if ($i % 4 == 0) {
            echo "</div><div class='row'>";
        }
    }
    echo "</div>";
}
?>

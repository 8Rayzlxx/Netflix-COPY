<?php
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
$sql = "SELECT tvshows.* FROM tvshows INNER JOIN list ON tvshows.tvid = list.tvid WHERE list.id = $userId";
$result = $conn->query($sql);
?>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Display movie details inside anchor tag
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<a href='listmovie.php?movie_id={$row['tvid']}' class='card-link'>";
                    echo "<div class='card'>";
                    echo "<img src='../thumbnails/{$row['imgpath']}' class='card-img-top' alt='Movie Image'>";
                    echo "<div class='card-body'>";
                    echo "<form action='../pages/listshow.php' method='GET'>";
                    echo "<input type='hidden' name='movie_id' value='{$row['tvid']}'>";
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
        

</html>

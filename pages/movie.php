<?php
session_start();

// Initialize $title variable
$title = "";

// Check if the form is submitted for deleting the movie
if (isset($_POST['delete_submit'])) {
    include '../includes/db_connection.php';
    $delete_title = $_POST['delete_title'];
    
    // Delete associated records from user1 table first to avoid foreign key constraint violation
    $delete_associated_query = "DELETE FROM user1 WHERE mid = (SELECT mid FROM movies WHERE name = '$delete_title')";
    $delete_associated_result = mysqli_query($conn, $delete_associated_query);
    
    // Then, delete the movie record
    $delete_query = "DELETE FROM movies WHERE name = '$delete_title'";
    $delete_result = mysqli_query($conn, $delete_query);
    
    if ($delete_result && $delete_associated_result) {
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
    $im = "SELECT * FROM movies WHERE name = '$title'";
    $records = mysqli_query($conn, $im);
}

?>

<!DOCTYPE html>
<html lang='en' dir='ltr'>

<head>
    <meta charset='utf-8'>
    <title><?php echo $title; ?></title>
    <link rel='stylesheet' href='../css/movie.css'>
    <link rel='stylesheet' href='../css/landing.css'>
</head>

<body>

    <div class='jumbotron-fluid'>
        <div class='container'>
            <?php
            // Check if $records is defined
            if (isset($records)) {
                while ($result = mysqli_fetch_assoc($records)) {
                    $mname = $result['name'];
                    $person = $_SESSION['id'];
                    $movieid = $result['mid'];
                    $current = $result['viewers'];
                    $newcount = $current + 1;
                    $newsql = "UPDATE movies SET viewers = '$newcount' WHERE name='$mname' ";
                    $nsql = "UPDATE user1 SET mid = '$movieid' WHERE id ='$person' ";
                    $updatecount = mysqli_query($conn, $newsql);
                    $updatecount = mysqli_query($conn, $nsql);
            ?>
                    <br>
                    <a href='homepage.php' style='font-size: 20px;color:white;border:3px solid red;border-radius:5px;padding:10px;text-decoration:none;'>Back to Home </a>
                    <form action="" method="post" style="display: inline;">
                        <input type="hidden" name="delete_title" value="<?php echo $mname; ?>">
                        <button type="submit" name="delete_submit" onclick="return confirm('Are you sure you want to delete this movie?');" style='font-size: 20px;color:white;border:3px solid red;border-radius:5px;padding:10px;text-decoration:none;'>Delete Movie </button>
                    </form>
                    <br><br><br>
                    <div class='embed-responsive embed-responsive-16by9'>
                        <iframe class='embed-responsive-item' src="<?php echo $result['link']; ?>"></iframe>
                    </div>
                    <br><br>
                    <h5 style='display: inline;'><br>movie name : </h5><h1 style='display: inline;'><?php echo ucwords($result['name']); ?></h1>
                    <br><h5 style='display: inline;'>genre : </h5><h4 style='display: inline;'><?php echo ucwords($result['genre']); ?></h4>
                    <br><h5 style='display: inline;'>release year : </h5><h4 style='display: inline;'><?php echo $result['rdate']; ?></h4>
                    <br><h5 style='display: inline;'>Directed By: </h5><h4 style='display: inline;'><?php echo $result['regisseur']; ?></h4>
                    <br><h5 style='display: inline;'>Cast: </h5><h4 style='display: inline;'><?php echo $result['cast']; ?></h4>
                    <br><h5 style='display: inline;'>runtime : </h5><h4 style='display: inline;'><?php echo $result['runtime']; ?> mins </h4>
                    <br><h5 style='display: inline;'>description : </h5><h4 style='display: inline;'><?php echo ucfirst($result['decription']); ?></h4>
                    <br><h5 style='display: inline;'>views : </h5><h4 style='display: inline;'><?php echo $result['viewers']; ?></h4>

                    

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


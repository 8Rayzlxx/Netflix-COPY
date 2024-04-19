**doesnt work and also to lazy to figure out why**
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Please login to remove movies from your list.');</script>";
    echo "<script>window.location.href = 'signin.php';</script>";
    exit();
}

// Get the user ID from the session
$id = $_SESSION['id'];

// Get the movie ID from the form
$mid = $_POST['mid'];

// Include your database connection file
include '../includes/db_connection.php';

// Remove the movie from the user's list
$sql_remove = "DELETE FROM list WHERE id = '$id' AND mid = '$mid'";
if ($conn->query($sql_remove) === TRUE) {
    echo "<script>alert('Movie removed from your list successfully.');</script>";
} else {
    echo "<script>alert('Error: Unable to remove movie from your list.');</script>";
}


?>

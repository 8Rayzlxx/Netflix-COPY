<?php
session_start();

// Initialize $title variable
$title = "";

// Check if the form is submitted for deleting the movie
if (isset($_POST['delete_submit'])) {
    include '../includes/db_connection.php';
    $delete_title = $_POST['delete_title'];
    
    // Update associated records in user1 table by setting mid to NULL
    $update_associated_query = "UPDATE user1 SET mid = NULL WHERE mid = (SELECT mid FROM movies WHERE name = '$delete_title')";
    $update_associated_result = mysqli_query($conn, $update_associated_query);
    
    // Then, delete the movie record
    $delete_query = "DELETE FROM movies WHERE name = '$delete_title'";
    $delete_result = mysqli_query($conn, $delete_query);
    
    if ($delete_result) {
        echo "<script>alert('Movie deleted successfully!');</script>";
        // Redirect to homepage or any other page after successful deletion
        echo "<script>window.location.href = '../pages/homepage.php';</script>";
        exit; // Terminate the script after redirection
    } else {
        echo "<script>alert('Failed to delete movie!');</script>";
    }
}
?>
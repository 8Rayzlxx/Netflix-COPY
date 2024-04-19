<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Please login to add movies to your list.');</script>";
    echo "<script>window.location.href = 'signin.php';</script>";
    exit();
}

// Get the user ID from the session
$id = $_SESSION['id'];

// Get the movie ID from the form
$mid = $_POST['mid'];
$tvid = $_POST['tvid'];

// Include your database connection file
include '../includes/db_connection.php';

// Insert the movie into the user's list
$sql = "INSERT INTO list (id, mid, tvid) VALUES ('$id', '$mid', '$tvid')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Movie added to your list successfully.');</script>";
    echo "<script>window.history.go(-1);</script>";
} else {
    echo "<script>alert('Error: Unable to add movie to your list.');</script>";
    echo "<script>window.history.go(-1);</script>";
  
}
?>

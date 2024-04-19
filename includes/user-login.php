<?php
session_start();
include '../includes/db_connection.php';

$username = $_POST['mail'];
$password = $_POST['pass'];

$sql = "SELECT * FROM user1 WHERE Email = '$username' AND Passwd = '$password' ";
$result = $conn->query($sql);

if (!$row = $result->fetch_assoc()) {
    // Display a popup message
    echo "<script>alert('Incorrect username or password');</script>";
    // Redirect back to the login page after the alert is dismissed
    echo "<script>
            setTimeout(function() {
                window.location.href = 'signin.php';
            }, 0.1); // Redirect after 0.1 second
          </script>";
} else {
    $_SESSION['id'] = $row['id'];
    // Display a popup message and redirect to homepage.php after a short delay
    echo "<script>alert('Login successful. Redirecting to login page...');</script>";
    echo "<script>setTimeout(function(){ window.location.href = '../pages/homepage.php'; }, 1000);</script>"; // Redirect after 2 seconds
}
?>


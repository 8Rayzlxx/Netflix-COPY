<?php
session_start();

if(isset($_POST['edit_show'])) {
    include '../includes/db_connection.php';

    // Get form data
    $edit_title = $_POST['edit_title'];
    $edit_decription = $_POST['edit_decription'];
    $edit_genre = $_POST['edit_genre'];
    $edit_release_date = $_POST['edit_rdate'];
    $edit_director = $_POST['edit_regisseur'];
    $edit_cast = $_POST['edit_cast'];
    $edit_runtime = $_POST['edit_rtime'];
    $edit_link = $_POST['edit_link'];
    $edit_imgpath = $_POST['edit_imgpath'];

    // Update movie information in the database
    $update_query = "UPDATE tvshows 
                     SET decription = '$edit_decription', genre = '$edit_genre', rdate = '$edit_release_date', regisseur = '$edit_director', 
                         cast = '$edit_cast', runtime = '$edit_runtime', link = '$edit_link', imgpath = '$edit_imgpath' 
                     WHERE name = '$edit_title'";
    $update_result = mysqli_query($conn, $update_query);

    if($update_result) {
        echo "<script>alert('Movie information updated successfully!');</script>";
    } else {
        echo "<script>alert('Failed to update movie information.');</script>";
    }

   // Redirect back to the previous page
echo "<script>window.history.go(-1);</script>";
}
?>

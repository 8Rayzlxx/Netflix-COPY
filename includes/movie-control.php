<?php
session_start();
if (isset($_POST['upload'])) {

  include '../includes/db_connection.php';

  $targetvid = "../films/".basename($_FILES['video']['name']);
  $target = "../thumbnails/".basename($_FILES['image']['name']);
  $name = strtolower($_POST['mname']);
  $rdate = $_POST['release'];
  $genre = strtolower($_POST['genre']);
  $regisseur = $_POST['regisseur'];
  $cast = $_POST['cast'];
  $rtime = $_POST['rtime'];
  $desc = $_POST['desc'];
  $link = $_POST['link'];
  $image = $_FILES['image']['name'];
  $video = $_FILES['video']['name'];

  $sql = "INSERT INTO movies (name, rdate, genre, regisseur, cast, runtime, decription, link, imgpath, videopath)
    VALUES('$name','$rdate','$genre','$regisseur','$cast','$rtime','$desc','$link','$image','$video')";

  mysqli_query($conn,$sql);

  if (move_uploaded_file($_FILES['image']['tmp_name'],$target) && move_uploaded_file($_FILES['video']['tmp_name'],$targetvid)) {
    header("Location: ../pages/homepage.php");
  }else {
    echo "error uploading";
  }
}


?>

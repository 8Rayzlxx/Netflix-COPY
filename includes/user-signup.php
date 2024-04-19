<?php
  session_start();
  include '../includes/db_connection.php';


    $name = $_POST['fullname'];
    $DOB =  $_POST['dateofbirth'];
    $email =  $_POST['email'];
    $username = $_POST['email'];
    $passwd =  $_POST['passwrd'];
    $phone = $_POST['number'];

    $sql = "INSERT INTO user1(username, Name, DOB, Email, Passwd, Phone)
    values('$username','$name','$DOB','$email','$passwd','$phone')";
    $result = $conn->query($sql);

    header("Location: ../pages/signin.php");
?>

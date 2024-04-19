<?php
include 'db_connection.php';


  $im = "SELECT * FROM movies ORDER BY name ASC" ;
  $records = mysqli_query($conn,$im);

  start:
  $i=0;

  echo"<div class='row'>";
    while($result = mysqli_fetch_assoc($records)){
      echo"<form action='../pages/movieview.php' method='POST'>";
      echo"<div class='col'>";
      echo "<img src='../thumbnails/".$result['imgpath']."' height='280' width='200' style='margin-top: 30px;margin-left:30px;margin-right:20px;' />";
        echo"<div class='noob'>";
          echo "<input type='submit' name='submit' class='btn btn-outline-info' style='display:block;width:200px;padding-bottom:15px;margin-bottom:30px;margin-left:30px;margin-right:20px; white-space:normal;' value='".ucwords($result['name'])."'/>";
        echo"</div>";
      echo"</div>";
      echo"</form>";

      if ($i==4) {

        echo"</div>";

        goto start;
      }
      $i++;
    }
    echo"</div>";
    ?>

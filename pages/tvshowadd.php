<?php
session_start();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="../img/netflix_PNG15.png"/>
    <link rel="stylesheet" href="../css/movieadd.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<header>
    <nav class="navbar">
      <div class="navbar__brand">
        <img src="../img/oglogo.png" alt="logo" class="brand__logo" />
      </div>

      <div class="navbar__nav__items">

        <div class="nav__item">
        <a href="../pages/homepage.php"><button class="signin__button">Cancel</button></a>
        </div>
      </div>
    </nav>
  </header>
      <div class="hero__bg__overlay"></div>
<body>

<div class="wrapper">

<div class="jumbotron">
  <b><h1> Enter Movie details</h1></b>
  <p> <b></b> </p> <br>

  <form class="" action="../includes/tvshow-control.php" method="POST" enctype="multipart/form-data">

   <input type="text" class="form-control" placeholder="Tv Show Name" name="mname" value=""><br>
    <input type="text" class="form-control" placeholder="Year of Release" name="release" value="">
    <br>
    <input type="text" class="form-control" placeholder="Genre" name="genre" value="">
    <br>
    <input type="text" class="form-control" placeholder="Directed By" name="regisseur" value="">
    <br>
    <input type="text" class="form-control" placeholder="Casts" name="cast" value="">
    <br>
    <input type="number" class="form-control" placeholder="Total Episode" name="rtime" value="">
    <br>
    <input type="text" class="form-control" placeholder="Description..." name="desc" value="">
    <br>
    <input type="text" class="form-control" placeholder="Trailer link" name="link" value="">
    <br>
    <div class="row">
      <div class="col">
        <table>
          <tr>
            <td> <label for=""><b>Upload Image : </b></label> </td>
            <td>
                 <div class="">
                     <input type="hidden" name="size" value="100000">

                     <input type="file" name="image" value="">
                 </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="col">
      </div>
    </div> <br><br>
    <div class="signupbutton">
      <input type="submit" class ="btn btn-success btn-lg" name="upload" value="Submit" >
    </div>


  </form>

</div>


</div>

</div>


</div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
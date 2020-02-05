<?php require_once("db.php"); ?>
<?php require_once("sessions.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/12d31af374.js" crossorigin="anonymous"></script>
</head>

<body >


   <div style="height: 10px; background-color:#4d86e2;"></div>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
       
       <div class="container">
         <a href="./blog.php" class="navbar-brand">Gui Gomes</a>  
         <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS"><span class="navbar-toggler-icon"></span></button>
         <div class="collapse navbar-collapse" id="navbarcollapseCMS">
       <ul class="navbar-nav mr-auto">
           <li class="nav-item"><a href="blog.php" class="nav-link"><i class="fas fa-user text-success"></i>Home</a></li>
           <li class="nav-item"><a href="" class="nav-link">About us</a></li>
           <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
           <li class="nav-item"><a href="" class="nav-link">Contact Us</a></li>
           <li class="nav-item"><a href="" class="nav-link">Features</a></li>
       </ul>
       <ul class="navbar-nav ml-auto">
         
          <form action="./blog.php" method="post" class="form-inline d-none d-sm-block">
          <div class="form-group">
          <input type="text" class="form-control mr-2" name="query" placeholder="Search Here">
          <input type="submit" name="search" value="Go" class="btn btn-primary">
              </div>
          </form>
          
       </ul>
       </div>
       </div>
       
   </nav>
   <div style="height: 10px; background-color:#4d86e2;"></div>

  <?php showMessages(); ?>
   

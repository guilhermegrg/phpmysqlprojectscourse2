<?php require_once("db.php"); ?>
<?php require_once("sessions.php"); ?>
<?php setTrackingURL(); ?>
<?php confirmLogin(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>First Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/12d31af374.js" crossorigin="anonymous"></script>
</head>

<body >


   <div style="height: 10px; background-color:#4d86e2;"></div>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
       
       <div class="container">
         <a href="" class="navbar-brand">Gui Gomes</a>  
         <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS"><span class="navbar-toggler-icon"></span></button>
         <div class="collapse navbar-collapse" id="navbarcollapseCMS">
       <ul class="navbar-nav mr-auto">
           <li class="nav-item"><a href="myprofile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a></li>
           <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
           <li class="nav-item"><a href="posts.php" class="nav-link">Posts</a></li>
           <li class="nav-item"><a href="categories.php" class="nav-link">Categories</a></li>
           <li class="nav-item"><a href="admins.php" class="nav-link">Manage Admins</a></li>
           <li class="nav-item"><a href="comments.php" class="nav-link">Comments</a></li>
           <li class="nav-item"><a href="blog.php" class="nav-link">Live Blog</a></li>
       </ul>
       <ul class="navbar-nav ml-auto">
           <l1 class="nav-item"><a href="logout.php" class="nav-link text-danger"><i class="fas fa-user-times"></i> Logout</a></l1>
       </ul>
       </div>
       </div>
       
   </nav>
   <div style="height: 10px; background-color:#4d86e2;"></div>

   

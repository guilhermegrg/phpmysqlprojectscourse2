<?php include "includes/public_header.php" ?>

 <?php
    
    if(isset($_GET['id'])){
    
            $id = $_GET['id'];
            $row = getAdminById($id);
            $name = $row['name'];
            $username = $row['name'];
            $bio = $row['bio'];
            $headline = $row['headline'];
            $image = $row['image'];
            
        
        
        
    }else
    {
        setError("Nothing found!");
        send("blog.php");
    }
            ?>
            
 
 
 <!--    header-->
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
               <h1><?php echo $name; ?></h1>
             <small class="muted">  <?php echo $headline; ?></small>
           </div>
       </div>
       
   </div>
   </header>
   
<!--   main-->



            <!--   main-->
            
<section class="container py-2 mb-4">
   
    <div class="row" >
      
   <?php showMessages(); ?>   
       
       <div class="col-md-3">
    <img src="uploads/<?php echo $image; ?>" alt="" class="img-fluid d-block rounded-circle">
       </div>
        <div class="col-md-9">
        <div class="card">
        
            <div class="card-body">
                   <p><?php echo $bio; ?></p>
                    </div>
        </div>
        
       </div>
       
    </div>
</section>

<?php include "includes/footer.php" ?>
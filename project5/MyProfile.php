<?php include "includes/header.php" ?>

<?php
    
if(isset($_POST['submit'])){
    
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $headline = $_POST['headline'];
    
    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    
    
    $id=getAdminId();
        
    if($image)
     $query = "UPDATE admins SET name=:name, headline=:headline, bio=:bio, image=:image WHERE id=:id";
    else
     $query = "UPDATE admins SET name=:name, headline=:headline, bio=:bio WHERE id=:id";
        
    
        $stmt = $conn->prepare($query);
        $stmt->bindValue("name",$name);
        $stmt->bindValue("headline",$headline);
        $stmt->bindValue("bio",$bio);
        if($image)
        $stmt->bindValue("image",$image);
        $stmt->bindValue("id",$id);

        
        $result = $stmt->execute();
        
        
        
        if($result && $id > 0){
            
           if($image)
               move_uploaded_file($temp_name,"uploads/".$image);
            
            setSuccess("Updated profile!");
            send("MyProfile.php");
        }else{
            setError("Error! " . $conn->errorInfo() . " result: " . $result . " id: " + $id);
            send("MyProfile.php");
            
        }
}

    
    
?>

<?php 
            
            
            $id = getAdminId();
            $row = getAdminById($id);
            $name = $row['name'];
            $username = $row['name'];
            $bio = $row['bio'];
            $headline = $row['headline'];
            $image = $row['image'];
            
            ?>

<!--    header-->
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
              
               <h1><i class="text-success fas fa-user mr-2"></i>@<?php echo $username?></h1>
               <small><?php echo $headline?></small>
           </div>
       </div>
       
   </div>
   </header>
   

           
           
   
   
<!--   main-->
<section class="container py-2 mb-4">
    <div class="row" >
       
       <div class="col-md-3">
           <div class="card">
               <div class="card-header bg-dark text-light">
                   <h5><?php echo $name; ?></h5>
                   <small class="muted"><?php echo $headline; ?></small>
               </div>
               <div class="card-body">
                   <img src="uploads/<?php echo $image; ?>" class="block img-fluid mb-3" alt="">
                   <div><p><?php echo $bio; ?></p>
                   </div>
               </div>
           </div>
       </div>
       
       
        <div class="col-lg-9 " style="min-height: 400px;">
                
        <?php showMessages(); ?>
            
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card bg-dark text-light ">
                    <div class="card-header bg-secondary text-light">
                        <h4>Edit Profile</h4>
                    </div>
                    
                    <div class="card-body">
                       
                        <div class="form-group">
                            <input type="text" name="name" id="name" placeholder="Type name Here" class="form-control" value="<?php echo $name; ?>">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" name="headline" id="headline" placeholder="Type headline Here" class="form-control" value="<?php echo $headline; ?>">
                            <small class="text-muted">add a professional headline</small>
                            <span class="text-danger">Not more than 50 chars</span>
                        </div>
                        
                        
                               

                        
                        
                        
                        <div class="form-group">
                            <textarea name="bio" id="bio" cols="30" rows="10" class="form-control"><?php echo $bio; ?></textarea>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="image" id="image" class="custom-file-input">
                                <label for="image" class="custom-file-label">Select Image</label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6 mb-2"><a href="" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard</a></div>
                            <div class="col-lg-6 mb-2"><button class="btn btn-success btn-block" name="submit" type="submit"><i class="fas fa-check"></i>Save Profile Changes</button></div>
                        </div>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
    
</section>





<!--   main end-->


<?php include "includes/footer.php" ?>
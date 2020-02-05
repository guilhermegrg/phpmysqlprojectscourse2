<?php include "includes/header.php" ?>

<?php
    
if(isset($_POST['submit'])){
    
    $title = $_POST['title'];
    
    $author_id=getAdminId(); 
    $cat_id = $_POST['category'];
    $content = $_POST['content'];
    
    
    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    
    
    
    
    
    if(empty($title)){
        setError("All fields must be filled in!");
        send("AddNewPost.php");
    }elseif(strlen($title)<=2){
        setError("Title must be more than 2 chars!");
        send("AddNewPost.php");
        
    }elseif(strlen($title)>50){
        setError("Title must be less than 50 chars!");
        send("AddNewPost.php");
        
    }elseif($cat_id<=0){
        setError("Choose a valid category!");
        send("AddNewPost.php");
        
    }elseif($author_id<=0){
        setError("Invalid author! Are you logged in?");
        send("AddNewPost.php");
        
    }else{//insert new post
        
        date_default_timezone_set("Europe/Lisbon");
        $time = date('Y-m-d H:i:s');
        
     $query = "INSERT INTO posts(title, category_id, author_id, time, image, content) VALUES (:title, :cat_id, :author_id, :time, :image, :content)";
        $stmt = $conn->prepare($query);
        $stmt->bindValue("title",$title);
        $stmt->bindValue("cat_id",$cat_id);
        $stmt->bindValue("author_id",$author_id);
        $stmt->bindValue("time",$time);
        $stmt->bindValue("image",$image);
        $stmt->bindValue("content",$content);
        
        $result = $stmt->execute();
        $id = $conn->lastInsertId();
        
        
        
        if($result && $id > 0){
            
            move_uploaded_file($temp_name,"uploads/".$image);
            
            setSuccess("Post $id->'$title' added!");
            send("AddNewPost.php");
        }else{
            setError("Error! " . $conn->errorInfo() . " result: " . $result . " id: " + $id);
            send("AddNewPost.php");
            
        }
    }
}
    
    
?>

<!--    header-->
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
              
               <h1><i class="fas fa-user mr-2"></i>My Profile</h1>
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
                   <h3><?php echo getAdminUsername(); ?></h3>
               </div>
               <div class="card-body">
                   <img src="images/avatar.png" class="block img-fluid mb-3" alt="">
                   <div>
                       Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo unde incidunt, ab praesentium, magnam minus in aspernatur temporibus quidem, numquam obcaecati velit dolor. Minus velit adipisci ratione in, atque nisi!
                   </div>
               </div>
           </div>
       </div>
       
       
        <div class="col-lg-9 " style="min-height: 400px;">
            
        <?php showMessages(); ?>
            
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
<!--
                    <div class="card-header">
                        <h1>Add New Blog Post</h1>
                    </div>
-->
                    <div class="card-body bg-dark">
                       
                        <div class="form-group">
                            <label for="title">Username</label>
                            <input type="username" name="username" id="title" placeholder="Type Title Here" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="category">Choose Category</label>
                            <select name="category" id="category" placeholder="Choose Category" class="form-control">
                               <?php
                                
                                $cats = getCategories();
                                foreach($cats as $id=>$name){
                                    echo "<option value='$id'>" . $name . "</option>";
                                }
                                ?>
                               
                               
<!--
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
-->
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="image" >Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" id="image" class="custom-file-input">
                                <label for="image" class="custom-file-label">Select Image</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="content">Post:</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-lg-6 mb-2"><a href="" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard</a></div>
                            <div class="col-lg-6 mb-2"><button class="btn btn-success btn-block" name="submit" type="submit"><i class="fas fa-check"></i>Add New Post</button></div>
                        </div>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
    
</section>





<!--   main end-->


<?php include "includes/footer.php" ?>
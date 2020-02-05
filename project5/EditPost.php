<?php include "includes/header.php" ?>

<?php
    
if(isset($_POST['submit'])){
    
    $id = $_POST['id'];
    $title = $_POST['title'];
    
    $author_id=1; //dummy value
    $cat_id = $_POST['category'];
    $content = $_POST['content'];
    
    
    $new_image = $_FILES['image']['name'];
    $new_image_temp_name = $_FILES['image']['tmp_name'];
    
    
    if(!isset($new_image) || empty($new_image)){
        $posts = getPostById($id);
        $post = $posts[0];
        $image = $post['image'];
    }else
    {
        $image = $new_image;
    }
    
    
    if(empty($title)){
        setError("All fields must be filled in!");
        send("EditPost.php?id=$id");
    }elseif(strlen($title)<=2){
        setError("Title must be more than 2 chars!");
        send("EditPost.php?id=$id");        
    }elseif(strlen($title)>50){
        setError("Title must be less than 50 chars!");
        send("EditPost.php?id=$id");        
    }elseif($cat_id<=0){
        setError("Choose a valid category!");
        send("EditPost.php?id=$id");        
    }elseif($author_id<=0){
        setError("Invalid author! Are you logged in?");
        send("EditPost.php?id=$id");        
    }else{//insert new post
//        
//        date_default_timezone_set("Europe/Lisbon");
//        $time = date('Y-m-d H:i:s');
        
     $query = "UPDATE posts SET title=:title, category_id=:cat_id, image=:image, content=:content WHERE id=:id"; ;
        $stmt = $conn->prepare($query);
        $stmt->bindValue("title",$title);
        $stmt->bindValue("cat_id",$cat_id);
        $stmt->bindValue("image",$image);
        $stmt->bindValue("content",$content);
        $stmt->bindValue("id",$id);
        
        $result = $stmt->execute();
//        $id = $conn->lastInsertId();
        
        
        
        if($result){
            
            if(isset($new_image))
                move_uploaded_file($new_image_temp_name,"uploads/".$new_image);
            
            setSuccess("Post $id->'$title' Updated! $new_image $new_image_temp_name");
            send("posts.php");
        }else{
            setError("Error! " . $conn->errorInfo() . " result: " . $result . " id: " + $id);
            send("FullPost.php?id=$id");
            
        }
    }
}
    
    
?>

<!--    header-->
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
              
               <h1><i class="fas fa-edit"></i>Edit Post</h1>
           </div>
       </div>
       
   </div>
   </header>
   

   
<!--   main-->
<section class="container py-2 mb-4">
    <div class="row" >
        <div class="offset-lg-1 col-lg-10 " style="min-height: 400px;">
            
        <?php showMessages(); ?>
           
           <?php
            
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $posts = getPostById($id);
                if(empty($posts)){
                    setError("Couldn't find post $id");
                    send("blog.php");
                }else
                {
                    $post = $posts[0];
                    $title = $post['title'];
                    $author_id = $post['author_id'];
                    $image = $post['image'];
                    $content = $post['content'];
                    $cat_id = $post['category_id'];
                    $time = $post['time'];
                }
                
            }else
            {
                setError("Bad request!");
                send("blog.php");
            }
            
            ?>
            
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
<!--
                    <div class="card-header">
                        <h1>Add New Blog Post</h1>
                    </div>
-->
                    <div class="card-body bg-dark">

                        <div class="form-group">
                            <label for="id">Post Id</label>
                            <input type="text" name="id" id="id" class="form-control" value="<?php echo $id;?>" readonly>
                        </div>
                                                                     
                        <div class="form-group">
                            <label for="title">Post Title</label>
                            <input type="text" name="title" id="title" placeholder="Type Title Here" class="form-control" value="<?php echo $title;?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="category">Choose Category</label>
                            <select name="category" id="category" placeholder="Choose Category" class="form-control">
                               <?php
                                
                                $cats = getCategories();
                                foreach($cats as $id=>$name){
                                    echo "<option value='$id' " . ($id==$cat_id?"selected":""). ">". $name . "</option>";
                                }
                                ?>
                               
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="image" >Image</label><br>
                            <img src="uploads/<?php echo $image;?>" alt="" class="img-fluid mb-2" width="200px" >
                            <div class="custom-file">
                                <input type="file" name="image" id="image" class="custom-file-input" value="<?php echo $image;?>">
                                <label for="image" class="custom-file-label">Select Image</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="content">Post:</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control"><?php echo $content;?></textarea>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-lg-6 mb-2"><a href="" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard</a></div>
                            <div class="col-lg-6 mb-2"><button class="btn btn-success btn-block" name="submit" type="submit"><i class="fas fa-check"></i>Submit Changes</button></div>
                        </div>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
    
</section>





<!--   main end-->


<?php include "includes/footer.php" ?>
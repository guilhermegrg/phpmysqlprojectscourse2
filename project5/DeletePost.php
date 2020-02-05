<?php include "includes/header.php" ?>

<?php
    
if(isset($_POST['submit'])){
    
    $id = $_POST['id'];
    
    $posts = getPostById($id);
    $post = $posts[0];
    $image = $post['image'];
    
        
     $query = "DELETE FROM posts WHERE id=:id"; ;
     $stmt = $conn->prepare($query);
     $stmt->bindValue("id",$id);
        
     $result = $stmt->execute();
     //$id = $conn->lastDeletedId();
        
        
        
        if($result){
            
            unlink("uploads/".$image);
            
            setSuccess("Deleted post $id->'$title'!");
            send("posts.php");
        }else{
            setError("Error! " . $conn->errorInfo() . " result: " . $result . " id: " + $id);
            send("posts.php");
            
        }
    }
    
    
?>

<!--    header-->
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
              
               <h1><i class="fas fa-edit"></i>Delete Post</h1>
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
                    send("posts.php");
                }else
                {
                    $post = $posts[0];
                    $title = $post['title'];
                    $author_id = $post['author_id'];
                    $image = $post['image'];
                    $content = $post['content'];
                    $cat_id = $post['category_id'];
                    $cat_name = $post['cat_name'];
                    $time = $post['time'];
                }
                
            }else
            {
                setError("Bad request!");
                send("blog.php");
            }
            
            ?>
            
            <form action="" method="post" >
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
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo $title;?>" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" value="<?php echo $cat_name;?>" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="image" >Image</label><br>
                            <img src="uploads/<?php echo $image;?>" alt="" class="img-fluid mb-2" width="200px" >
                        </div>
                        
                        <div class="form-group">
                            <label for="content">Post:</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control" readonly><?php echo $content;?></textarea>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-lg-6 mb-2"><a href="" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard</a></div>
                            <div class="col-lg-6 mb-2"><button class="btn btn-danger btn-block" name="submit" type="submit"><i class="fas fa-trash"></i>Submit Changes</button></div>
                        </div>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
    
</section>





<!--   main end-->


<?php include "includes/footer.php" ?>
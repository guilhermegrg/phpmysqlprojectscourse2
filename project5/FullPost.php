<?php include "includes/public_header.php" ?>
<!--    header-->
<!--
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
               <h1>basic</h1>
           </div>
       </div>
       
   </div>
   </header>
-->
   
   <div class="container">
       <div class="row">
           <div class="col-sm-8" >
              <h1 >The Complete Responsive CMS Blog</h1>
              <h1 class="lead">The Complete CMS Blog by using PHP by Gui Gomes</h1>
               
                <?php
    
    
    
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $posts = getPostById($id);
        
        if(empty($posts)){
            setError("Post not found!");
            send("blog.php");
        }
        
    }else{
        setError("Bad Request");
        send("blog.php");
    }
    
    
if(isset($_POST['submit_comment'])){
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
    
        $post_id = $id;
    
    if(empty($name) || empty($email) || empty($message) || $post_id <=0 ){
        setError("Fill in all of the required fields in order to leave a comment!");
        send("FullPost.php?id=$id");
        
    }
    
    
    $comment_id = postComment($name,$email,$message,$post_id);
    if($comment_id > 0 ){
        setSuccess("Comment created! ");
        send("FullPost.php?id=$id");
    }else{
        setError("Error creating comment!");
        send("FullPost.php?id=$id");
    }
    
    
        
    }



            foreach($posts as $key=>$value){
                $post = $value;
                $id = htmlentities($post['id']);
                $title = htmlentities($post['title']);
                $author_id = htmlentities($post['author_id']);
                $author_name = htmlentities($post['author_name']);
                $cat_name = htmlentities($post['cat_name']);
                $image = htmlentities($post['image']);
                $time = htmlentities($post['time']);
                $content = htmlentities($post['content']);
                
                if(strlen($title)>18)
                    $title = substr($title,0,18)."..";
                
                if(strlen($cat_name)>18)
                    $cat_name = substr($cat_name,0,18)."..";
                
                if(strlen($time)>18)
                    $time = substr($time,0,18)."..";
                
                ?>
   
               
                   <div class="card mb-4">
                      <img src="uploads/<?php echo $image; ?>" alt="" class="img-fluid card-img-top" style="max-height: 450px;">
                       <div class="card-body">
                           <h4 class="card-title"><?php echo $title; ?></h4>
                           <small class="text-muted">Category: <span class="text-dark"><?php echo $cat_name; ?></span> Written by <span class="text-dark"><?php echo $author_name; ?></span> On <?php echo $time; ?></small>
<!--                           <small style="float: right;" class="badge badge-dark text-light">Comments 20</small>-->
                           <hr>
                           <p class="card-text"><?php echo $content; ?></p>
                       </div>
                   </div>
                   
                   <div>
                   <form action="" class="form" method="post">
                   <div class="card">
                       <div class="card-header">
                           <h5>Share your thoughts about this post</h5>
                       </div>
                       <div class="card-body">
                             
                              <div class="form-group">
                               <div class="input-group">
                                   <div class="input-group-prepend">
                                     <span class="input-group-text">
                                      <i class="fas fa-user"></i> 
                                      </span>
                                   </div>
                                   <input type="text" class="form-control" name="name" placeholder="Enter your name">
                               </div>
                                </div>
                                 
                                   
                                 <div class="form-group">      
                                  <div class="input-group">
                                   <div class="input-group-prepend">
                                     <span class="input-group-text">
                                      <i class="fas fa-envelope"></i> 
                                      </span>
                                   </div>
                                   <input type="email" class="form-control" name="email" placeholder="Enter your email">
                               </div>
                               </div>
                               
                                 <div class="form-group">      
                                   <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Enter your message here"></textarea>
                               </div>                               
                               
                               <div class="form-group">
                                   <input type="submit" class="btn btn-primary col-lg-12" name="submit_comment" value="Submit">
                               </div>
                               
                          
                       </div>
                       
                       
                   </div>
                 </form>
              </div>
              
<!--              end of create comment-->
    <div>
    <h4>Comments</h4>
    </div>                    

             <?php
                
                $comments = getPublishedCommentsFromPost($id);
                foreach($comments as $key=>$comment){
                    $comment_id = $comment['id'];
                    $comment_name = $comment['name'];
                    $comment_email = $comment['email'];
                    $comment_message = $comment['message'];
                    $comment_time = $comment['time'];
                    
                ?>    
                    <div class="media">
                       <i class="fas fa-user d-block align-self-center mr-2" style="font-size: 500%;"></i>
                        <div class="media-body">
                            <h6 class="lead"><?php echo $comment_name; ?></h6>
                            <p class="small"><?php echo $comment_time; ?></p>
                            <p><?php echo $comment_message; ?></p>
                        </div>
                    </div>
                    <hr>
                    
<!--                    echo "$comment_id - $comment_name -  $comment_email -  - $comment_time<br>";-->
                    
                <?php
                
                }
                
                ?>
              
              
              
              <?php
               }
               ?>
               
               
               
           </div>
                      
  <?php include "sidebar.php"; ?>
      
      
       </div>
       
   </div>
   
<!--   main-->


<?php include "includes/footer.php" ?>
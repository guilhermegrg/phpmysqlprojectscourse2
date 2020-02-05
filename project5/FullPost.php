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
    
    

            foreach($posts as $key=>$value){
                $post = $value;
                $id = htmlentities($post['id']);
                $title = htmlentities($post['title']);
                $author_id = htmlentities($post['author_id']);
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
                           <small class="text-muted">Written by <?php echo $author_id; ?> On <?php echo $time; ?></small>
                           <small style="float: right;" class="badge badge-dark text-light">Comments 20</small>
                           <hr>
                           <p class="card-text"><?php echo $content; ?></p>
                       </div>
                   </div>
                
              
              <?php
               }
               ?>
               
               
               
           </div>
           <div class="col-sm-4"  style="min-height:40px; background:yellow;">
               
           </div>
       </div>
       
   </div>
   
<!--   main-->


<?php include "includes/footer.php" ?>
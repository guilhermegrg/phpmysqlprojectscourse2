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
    $index = 0;
    $items_per_page = 1;

    if(isset($_GET['page'])){
        $page=$_GET['page'];
        if($page<=0)
            $page=1;

        
        
    }else
        $page=1;
    
        $index = ($page-1)*$items_per_page;
    
    $searching = false;
    $searchingByCategory = false;

    if(isset($_POST['query'])){
        $query =$_POST['query'];
        $posts = searchPosts($query,$index,$items_per_page);
        $searching = true;
    }elseif(isset($_GET['category'])){
        $search_category_id = $_GET['category'];
        $posts = getPostsByCategory($search_category_id,$index,$items_per_page);
        $searchingByCategory = true;
        
//        var_dump($posts);
        
    }else{
//        echo "TOP index: $index items: $items_per_page";
        $posts = getPosts($index,$items_per_page);
        
    }

//            var_dump($posts);
?>
<div class="mb-2">
        <?php include "pagination.php"; ?>
</div>
<?php

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
                
                $ok_comments=$post['ok_comments'];
                
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
                           <small style="float: right;" class="badge badge-dark text-light">Comments <?php echo $ok_comments; ?></small>
                           <hr>
                           <p class="card-text"><?php echo substr($content,0,200); ?></p>
                           <a href="FullPost.php?id=<?php echo $id; ?>" style="float: right;" ><span class="btn btn-info">Read More >></span></a>
                       </div>
                   </div>
                
              
              <?php
               }
               ?>
               
               
               
<div class="mb-2">
        <?php include "pagination.php"; ?>
</div>

           </div>
           
           
  <?php include "sidebar.php"; ?>
           
           
       </div>
       
   </div>
   
<!--   main-->


<?php include "includes/footer.php" ?>
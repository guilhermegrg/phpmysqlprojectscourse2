<?php include "includes/header.php" ?>
<!--    header-->
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
               <h1><i class="fas fa-blog"></i>Manage Posts</h1>
           </div>
           <div class="col-lg-3 mb-2">
               <a href="AddNewPost.php" class="btn btn-primary btn-block"><i class="fas fa-edit"></i>Add New Post</a>
           </div>
              <div class="col-lg-3 mb-2">
               <a href="categories.php" class="btn btn-info btn-block"><i class="fas fa-folder-plus"></i>Add New Category</a>
           </div>
              <div class="col-lg-3 mb-2">
               <a href="Admins.php" class="btn btn-warning btn-block"><i class="fas fa-user-plus"></i>Add New Admin</a>
           </div>
              <div class="col-lg-3 mb-2">
               <a href="comments.php" class="btn btn-success btn-block"><i class="fas fa-check"></i>Approve Comments</a>
           </div>
       </div>
       
   </div>
   </header>
   
<!--   main-->
<section class="container py-2 mb-4">
<div class="row">
   <?php showMessages(); ?>
   
    <div class="col-lg-2">
   
      <div class="card text-center text-white bg-dark mb-3">
       <div class="card-body">
           <h1 class="lead">Posts</h1>
           <h4 class="display-5">
               <i class="fab fa-readme"></i>
               <?php echo getCount("posts"); ?>
           </h4>
       </div>
       </div>
       

      <div class="card text-center text-white bg-dark mb-3">
       <div class="card-body">
           <h1 class="lead">Categories</h1>
           <h4 class="display-5">
               <i class="fas fa-folder"></i>
               <?php echo getCount("category"); ?>
           </h4>
       </div>
       </div>
       
            <div class="card text-center text-white bg-dark mb-3">
       <div class="card-body">
           <h1 class="lead">Admins</h1>
           <h4 class="display-5">
               <i class="fas fa-users"></i>
               <?php echo getCount("admins"); ?>
           </h4>
       </div>
       </div>
       
             <div class="card text-center text-white bg-dark mb-3">
       <div class="card-body">
           <h1 class="lead">Comments</h1>
           <h4 class="display-5">
               <i class="fas fa-comments"></i>
               <?php echo getCount("comments"); ?>
           </h4>
       </div>
       </div>


      
       
                     
       
    </div>
<!--    right side-->
    <div class="col-lg-10">
        <h1>Top Posts</h1>
        <table class="table table-stripped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Time</th>
                    <th>Author</th>
                    <th>Comments</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                
                $posts = getTopFivePosts();
//                var_dump($posts);
                foreach($posts as $key=>$post){
                    $id=$post['id'];
                    $title=$post['title'];
                    $time=$post['time'];
                   $author_name=$post['author_name'];
                    
                    $ok_comments=$post['ok_comments'];
                    $not_ok_comments=$post['not_ok_comments'];
                    
                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>$title</td>";
                    echo "<td>$time</td>";
                    echo "<td>$author_name</td>";
                    echo "<td>". ($ok_comments>0?"<span class='badge badge-success '>$ok_comments</span>":"").($not_ok_comments>0?"<span class='badge badge-danger'>$not_ok_comments</span>":"")."</td>";
                    echo "<td><a href='FullPost.php?id=$id'  target='_blank' ><span class='btn btn-info'>Preview</span></a></td>";
                    echo "</tr>";
                }
                
                
                
                
                ?>
                
                
            </tbody>
        </table>
    </div>
</div>

</section>

<?php include "includes/footer.php" ?>
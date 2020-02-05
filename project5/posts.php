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
    <div class="col-lg-12">
        
          <?php showMessages(); ?>
        
<table class="table table-responsive table-hover table-striped table-bordered">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Image</th>
        <th>Time</th>
        <th>Comments</th>
        <th>Actions</th>
        <th>View</th>
    </thead>
    <tbody>
        <?php
            $posts = getPosts();
            foreach($posts as $key=>$value){
                $post = $value;
                $id = $post['id'];
                $title = $post['title'];
                $author_id = $post['author_id'];
                $cat_name = $post['cat_name'];
                $image = $post['image'];
                $time = $post['time'];
                
                if(strlen($title)>18)
                    $title = substr($title,0,18)."..";
                
                if(strlen($cat_name)>18)
                    $cat_name = substr($cat_name,0,18)."..";
                
                if(strlen($time)>18)
                    $time = substr($time,0,18)."..";
                
                
                
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td class='table-primary'>$title</td>";
                echo "<td>$author_id</td>";
                echo "<td  class='table-success'>$cat_name</td>";
                echo "<td><img src='uploads/$image' width='120px'></td>";
                echo "<td>$time</td>";
                echo "<td>Comments</td>";
                echo "<td><a href='EditPost.php?id=$id' class='btn btn-warning btn-sm  mr-1'>Edit</a><a href='DeletePost.php?id=$id' class='btn btn-danger btn-sm'>Delete</a></td>";
                echo "<td><a href='FullPost.php?id=$id' target='_blank' class='btn btn-primary btn-sm'>Live View</td>";
                echo "</tr>";
            }
    
    
    
        ?>
    </tbody>
</table>
    </div>
</div>

</section>

<?php include "includes/footer.php" ?>
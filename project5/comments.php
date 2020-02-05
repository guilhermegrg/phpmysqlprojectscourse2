<?php include "includes/header.php" ?>
<!--    header-->
 

<?php

    if(isset($_GET['action']) && isset($_GET['id'])){
        $action = $_GET['action'];
        $id = $_GET['id'];
        //TODO add security stuff here
        
        switch($action){
            case 'approve':
                approveComment($id);
                send("comments.php");
            break;
                
            case 'disapprove':
                disapproveComment($id);
                send("comments.php");
            break;
                
            case 'delete':
                deleteComment($id);
                send("comments.php");
            break;

        }
        
        
        
        
    }
    
    
    
    
?>
    
    
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
               <h1><i class="fas fa-blog"></i>Manage Comments</h1>
           </div>
   </div>
       
   </div>
   </header>
   
<!--   main-->
<section class="container py-2 mb-4">
<div class="row">
    <div class="col-lg-12">
        
          <?php showMessages(); ?>
        <h1>Unapproved Comments</h1>
<table class="table  table-hover table-striped ">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Date</th>
        
        <th>Name</th>
        <th>Email</th>
        
        <th>Comment</th>
        <th>Status</th>
        <th>Approved By</th>
        <th>Actions</th>
        <th>View</th>
    </thead>
    <tbody>
        <?php
            $comments = getAllDisapprovedComments();
            foreach($comments as $key=>$value){
                $comment = $value;
                
                $id = $comment['id'];
                $name = $comment['name'];
                $email = $comment['email'];
                $time = $comment['time'];
                $post_id = $comment['post_id'];
                $message = $comment['message'];
                $approvedby = $comment['approvedby'];
                $status = $comment['status'];
                
                if(strlen($name)>18)
                    $name = substr($name,0,18)."..";
                
                if(strlen($email)>18)
                    $email = substr($email,0,18)."..";
                
                if(strlen($time)>18)
                    $time = substr($time,0,18)."..";
                
                if(strlen($message)>18)
                    $message = substr($message,0,18)."..";
                
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$time</td>";
                echo "<td class='table-primary'>$name</td>";
                echo "<td>$email</td>";
                
                echo "<td>$message</td>";
                echo "<td  class='table-primary' >$status</td>";
                echo "<td>$approvedby</td>";
                echo "<td><a href='comments.php?action=approve&id=$id' class='btn btn-success btn-sm  mr-1'>Approve</a><a href='comments.php?action=delete&id=$id' class='btn btn-danger btn-sm '>Delete</a></td>";
                echo "<td><a href='FullPost.php?id=$post_id' target='_blank' class='btn btn-primary btn-sm'>Live View</td>";
                echo "</tr>";
            }
    
    
    
        ?>
    </tbody>
</table>
   
   
   <h1>Approved Comments</h1>
   <table class="table table-hover table-striped">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Date</th>
        
        <th>Name</th>
        <th>Email</th>
        
        <th>Comment</th>
        <th>Status</th>
        <th>Approved By</th>
        <th>Actions</th>
        <th>View</th>
    </thead>
    <tbody>
        <?php
            $comments = getAllPublishedComments();
            foreach($comments as $key=>$value){
                $comment = $value;
                
                $id = $comment['id'];
                $name = $comment['name'];
                $email = $comment['email'];
                $time = $comment['time'];
                $post_id = $comment['post_id'];
                $message = $comment['message'];
                $approvedby = $comment['approvedby'];
                $status = $comment['status'];
                
                if(strlen($name)>18)
                    $name = substr($name,0,18)."..";
                
                if(strlen($email)>18)
                    $email = substr($email,0,18)."..";
                
                if(strlen($time)>18)
                    $time = substr($time,0,18)."..";
                
                if(strlen($message)>18)
                    $message = substr($message,0,18)."..";
                
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$time</td>";
                echo "<td class='table-primary'>$name</td>";
                echo "<td>$email</td>";
                
                echo "<td>$message</td>";
                echo "<td  class='table-primary' >$status</td>";
                echo "<td>$approvedby</td>";
                echo "<td><a href='comments.php?action=disapprove&id=$id' class='btn btn-warning btn-sm mr-1'>Disapprove</a><a href='comments.php?action=delete&id=$id' class='btn btn-danger btn-sm '>Delete</a></td>";
                echo "<td><a href='FullPost.php?id=$post_id' target='_blank' class='btn btn-primary btn-sm'>Live View</td>";
                echo "</tr>";
            }
    
    
    
        ?>
    </tbody>
</table>
   
   
    </div>
</div>

</section>

<?php include "includes/footer.php" ?>
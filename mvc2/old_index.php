<?php


require "classes/Database.php";

$db = new Database();



?>



<?php

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);


if(isset($post['createPost'])){
    
    $title = $post['title'];
    $body = $post['title'];
    
    $db->query("INSERT INTO posts(title, body) VALUES (:title, :body)");
    
    $db->bind("title",$title);
    $db->bind("body",$body);
    
    $db->execute();
    
    if($db->lastInsertId()){
        echo '<p>Post added!</p>';
    }
}elseif(isset($post['deletePost'])){
    
    $id = $post['id'];
    
    $db->query("DELETE FROM posts WHERE id=:id");
    $db->bind("id",$id);
    $db->execute();
}

?>


<h1>Add Post</h1>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" >
    <input type="text" name="title"><br>
    <textarea name="body" id="" cols="30" rows="10"></textarea><br>
    <input type="submit" name="createPost" value="Submit">
</form>



<?php

$db->query("SELECT * FROM posts");
//$db->bind("id",1);
$rows = $db->getResult();

?>

<h1>Posts</h1>
<div>
    
<?php foreach($rows as $row): ?>

<div>
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['body']; ?></p>
    <form action="" method="post">
       <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="submit" name="deletePost" value="Delete">
    </form>
</div>
    
<?php endforeach; ?>

</div>
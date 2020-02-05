<?php

$DSN = "mysql:host=localhost;dbname=cms2";
$conn = new PDO($DSN,"root","");


function send($location){
    header("Location: " . $location);
    exit;
}


function getCategories(){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM category");
    $result = $stmt->execute();
    if($result){
        $count = 0;
        while ($row = $stmt->fetch()){
           $array[$count] = $row;
            ++$count;
        }
        
        if($count==0)
            return [];
        
        return $array;
        
    }else
    {
        die("Error fetching categories " . mysqli_error($conn));
    }
    
}

//getCategories();


function getPosts($index,$amount){
    
    global $conn;
    
//    echo "index: $index items: $amount";
    
    if(!isset($index) || !isset($amount))
        $pagination = "";
    else
        $pagination = " LIMIT $index, $amount";
    
    $stmt = $conn->prepare("SELECT p.id, p.title, p.author_id, adn.username as author_name, cat.name as cat_name, p.time, p.image, p.content, (SELECT COUNT(*) FROM comments WHERE post_id=p.id AND status='on') as ok_comments, (SELECT COUNT(*) FROM comments WHERE post_id=p.id AND status='off') as not_ok_comments FROM posts p LEFT JOIN category cat ON p.category_id=cat.id LEFT JOIN admins adn ON p.author_id=adn.id  ORDER BY id DESC " .$pagination );
    $results = $stmt->execute();
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}


function getPostsByCategory($cat_id, $index,$amount){
    
    global $conn;
    
//    echo "index: $index items: $amount";
    
    if(!isset($index) || !isset($amount))
        $pagination = "";
    else
        $pagination = " LIMIT $index, $amount";
    
    $stmt = $conn->prepare("SELECT p.id, p.title, p.author_id, adn.username as author_name, cat.name as cat_name, p.time, p.image, p.content, (SELECT COUNT(*) FROM comments WHERE post_id=p.id AND status='on') as ok_comments, (SELECT COUNT(*) FROM comments WHERE post_id=p.id AND status='off') as not_ok_comments FROM posts p LEFT JOIN category cat ON p.category_id=cat.id LEFT JOIN admins adn ON p.author_id=adn.id WHERE p.category_id=:cat_id ORDER BY id DESC " .$pagination );
    $stmt->bindValue("cat_id",$cat_id);
    $results = $stmt->execute();
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}


//getPostsByCategory(1,1,1);
//var_dump(getPosts(1,1));


function getTopFivePosts(){
    
    global $conn;
    $stmt = $conn->prepare("SELECT p.id, p.title, p.author_id, adn.username as author_name, cat.name as cat_name, p.time, p.image, p.content, (SELECT COUNT(*) FROM comments WHERE post_id=p.id AND status='on') as ok_comments, (SELECT COUNT(*) FROM comments WHERE post_id=p.id AND status='off') as not_ok_comments FROM posts p LEFT JOIN category cat ON p.category_id=cat.id 
    LEFT JOIN admins adn ON p.author_id=adn.id 
    ORDER BY id DESC LIMIT 0, 5");
    $results = $stmt->execute();
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}

//echo "<pre>" . var_dump(getTopFivePosts()) . "</pre>";

function searchPosts($query, $index,$amount){
    
    global $conn;
    
    
    if(!isset($index) || !isset($amount))
        $pagination = "";
    else
        $pagination = " LIMIT $index, $amount";
    
    $stmt = $conn->prepare("SELECT p.id, p.title, p.author_id, adn.username as author_name, cat.name as cat_name, p.time, p.image, p.content, (SELECT COUNT(*) FROM comments WHERE post_id=p.id AND status='on') as ok_comments, (SELECT COUNT(*) FROM comments WHERE post_id=p.id AND status='off') as not_ok_comments FROM posts p LEFT JOIN category cat ON p.category_id=cat.id 
    LEFT JOIN admins adn ON p.author_id=adn.id WHERE p.title LIKE :search OR p.content LIKE :search OR cat.name LIKE :search ORDER BY id DESC " . $pagination);
    
    $query = "%".$query."%";
    $stmt->bindValue("search",$query);
//    $stmt->bindValue("search2",$query);
//    $stmt->bindValue("search3",$query);
    $results = $stmt->execute();
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}


function getPostSearchCount($query){
    
    global $conn;
    
     $stmt = $conn->prepare("SELECT COUNT(*) FROM posts p LEFT JOIN category cat ON p.category_id=cat.id WHERE p.title LIKE :search OR p.content LIKE :search OR cat.name LIKE :search");
    
    $query = "%".$query."%";
    $stmt->bindValue("search",$query);
    $results = $stmt->execute();
    
    if($results){
        $row = $stmt->fetch();
        $count = $row[0];
        return $count;
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
}

function getPostCountByCategory($cat_id){
    
    global $conn;
    
     $stmt = $conn->prepare("SELECT COUNT(*) FROM posts WHERE category_id=:cat_id");
    
    $stmt->bindValue("cat_id",$cat_id);
    $results = $stmt->execute();
    
    if($results){
        $row = $stmt->fetch();
        $count = $row[0];
        return $count;
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
}

//getPostCountByCategory(1);

function getPostById($id){
    
    global $conn;
    $stmt = $conn->prepare("SELECT p.id, p.title, p.author_id, adn.username as author_name, cat.name as cat_name, p.time, p.image, p.content, (SELECT COUNT(*) FROM comments WHERE post_id=p.id AND status='on') as ok_comments, (SELECT COUNT(*) FROM comments WHERE post_id=p.id AND status='off') as not_ok_comments FROM posts p LEFT JOIN category cat ON p.category_id=cat.id 
    LEFT JOIN admins adn ON p.author_id=adn.id WHERE p.id=:id ORDER BY id DESC");
    $stmt->bindValue("id",$id);
    $results = $stmt->execute();
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}



function postComment($name, $email, $message, $post_id){
    global $conn;
    $query = "INSERT INTO comments (name, email, message, time, post_id, approvedby, status) VALUES(:name, :email, :message, now(), :post_id, 'pending','off')";
    
    $stmt = $conn->prepare($query);
    
    $stmt->bindValue("name", $name);
    $stmt->bindValue("email", $email);
    $stmt->bindValue("message", $message);
    $stmt->bindValue("post_id", $post_id);
    
    $result = $stmt->execute();
    $id = $conn->lastInsertId();
    
    if($result && $id >0 ){
       return $id;
    }else
        return -1;
    
}

function getAllCommentsFromPost($post_id){
    global $conn;
    $query = "SELECT * FROM comments WHERE post_id=:post_id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindValue("post_id", $post_id);
    
    $results = $stmt->execute();
    
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}

function getPublishedCommentsFromPost($post_id){
    global $conn;
    $query = "SELECT * FROM comments WHERE post_id=:post_id AND status='on' ";
    
    $stmt = $conn->prepare($query);
    $stmt->bindValue("post_id", $post_id);
    
    $results = $stmt->execute();
    
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}


function getAllComments(){
    global $conn;
    $query = "SELECT * FROM comments ORDER BY id DESC";
    
    $stmt = $conn->prepare($query);
    //$stmt->bindValue("post_id", $post_id);
    
    $results = $stmt->execute();
    
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}

function getAllPublishedComments(){
    global $conn;
    $query = "SELECT * FROM comments WHERE status='on' ORDER BY id DESC";
    
    $stmt = $conn->prepare($query);
    //$stmt->bindValue("post_id", $post_id);
    
    $results = $stmt->execute();
    
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}

function getAllDisapprovedComments(){
    global $conn;
    $query = "SELECT * FROM comments WHERE status='off' ORDER BY id DESC";
    
    $stmt = $conn->prepare($query);
    //$stmt->bindValue("post_id", $post_id);
    
    $results = $stmt->execute();
    
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}


function isFieldValueTaken($table,$fieldname,$fieldvalue){
     global $conn;
    $query = "SELECT * FROM $table WHERE $fieldname=:value";
    
    $stmt = $conn->prepare($query);
    $stmt->bindValue("value", $fieldvalue);
    
    $results = $stmt->execute();
    $count = $stmt->rowCount();
    if($results){
        
        if($count==0)
            return false;
        else
            return true;
        
    }else{
        die("Error fetching posts! " . $conn->errorInfo()[0]);
    }
    
    
}

function isUsernameTaken($username){
    return isFieldValueTaken("admins","username",$username);
    
}

function isEmailTaken($username){
    return isFieldValueTaken("admins","email",$username);
    
}


function getAdminByUsername($username){
    global $conn;
    $query = "SELECT * FROM admins WHERE username=:username";
    
    $stmt = $conn->prepare($query);
    $stmt->bindValue("username", $username);
    
    $results = $stmt->execute();
    $count = $stmt->rowCount();
    if($results){
        if($count == 0)
            return null;
        
        $row = $stmt->fetch();
        return $row;
        
    }else{
        die("Error fetching admins! " . $conn->errorInfo()[0]);
    }
        
}


function getAdmins(){
    global $conn;
    $query = "SELECT * FROM admins";
    
    $stmt = $conn->prepare($query);
//    $stmt->bindValue("username", $username);
    
    $results = $stmt->execute();
    $count = $stmt->rowCount();
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        if($count==0)
            return [];
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
        
}

function approveComment($id){
    global $conn;
    $query = "UPDATE comments SET status='on', approvedby=:username WHERE id=:id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindValue("id", $id);
    $stmt->bindValue("username", getAdminUsername());

    
    $results = $stmt->execute();
}


function disapproveComment($id){
    global $conn;
    $query = "UPDATE comments SET status='off' WHERE id=:id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindValue("id", $id);
    
    $results = $stmt->execute();
}

function deleteComment($id){
    global $conn;
    $query = "DELETE FROM comments WHERE id=:id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindValue("id", $id);
    
    $results = $stmt->execute();
}


function getCount($table){
    
     global $conn;
    $query = "SELECT COUNT(*) FROM $table";
    
    $stmt = $conn->prepare($query);
    
    $results = $stmt->execute();
    
    if($results){
        $row = $stmt->fetch();
        $count = $row[0];
        return $count;
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}

//echo getCount("admins");
//isUsernameTaken("gui");

//postComment("gui", "guigrg@gmail.com","asdasd asda sdasd a", 2);

// $posts = searchPosts("z");
//print_r($posts);
//foreach($cats as $id => $name){
// echo "<h1>" . $name . "</h1><br>";
//}


// $cats = getCategories();
//print_r($cats);
//foreach($cats as $id => $name){
// echo "<h1>" . $name . "</h1><br>";
//}


?>
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
        while ($row = $stmt->fetch()){
            $id = $row['id'];
            $name = $row['name'];
            $array[$id] = $name;
        }
        
        return $array;
        
    }else
    {
        die("Error fetching categories " . mysqli_error($conn));
    }
    
}

function getPosts(){
    
    global $conn;
    $stmt = $conn->prepare("SELECT p.id, p.title, p.author_id, cat.name as cat_name, p.time, p.image, p.content FROM posts p LEFT JOIN category cat ON p.category_id=cat.id ORDER BY id DESC");
    $results = $stmt->execute();
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}


function searchPosts($query){
    
    global $conn;
    $stmt = $conn->prepare("SELECT p.id, p.title, p.author_id, cat.name as cat_name, p.time, p.image, p.content FROM posts p LEFT JOIN category cat ON p.category_id=cat.id WHERE p.title LIKE :search OR p.content LIKE :search OR cat.name LIKE :search ORDER BY id DESC");
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
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}


function getPostById($id){
    
    global $conn;
    $stmt = $conn->prepare("SELECT p.id, p.title, p.author_id, cat.name as cat_name, p.category_id, p.time, p.image, p.content FROM posts p LEFT JOIN category cat ON p.category_id=cat.id WHERE p.id=:id ORDER BY id DESC");
    $stmt->bindValue("id",$id);
    $results = $stmt->execute();
    if($results){
        $count = 0;
        while($row = $stmt->fetch()){
            $array[$count] = $row;
            ++$count;
        }
        
        return $array;
        
    }else{
        die("Erro fetching posts! " . $conn->errorInfo()[0]);
    }
    
}


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
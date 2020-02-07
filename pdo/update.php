<?php

include_once "Database.php";


if(isset($_POST['data'])  && isset($_POST['id']) && isset($_POST['column'])){
    
    $data = trim($_POST['data']);
    $id = $_POST['id'];
    $column = $_POST['column'];
    
    try{
        
        $createQuery = "UPDATE tasks set $column=:data WHERE id=:id";
        $stmt = $conn->prepare($createQuery);
        
//        $stmt->bindValue("column",$column);
        $stmt->bindValue("data",$data);
        $stmt->bindValue("id",$id);
        $stmt->execute();
        
        if($stmt->rowCount() === 1){
            echo "Task $column Updated!";
        }else{
            echo "No changes made!";
        }
        
    }catch(PDOException $ex){
        echo "Error" . $ex->getMessage();
    }
}


?>

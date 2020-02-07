<?php

include_once "Database.php";


if(isset($_POST['id'])){
    $id = $_POST['id'];
    
    try{
        
        $createQuery = "DELETE FROM tasks WHERE id=:id";
        $stmt = $conn->prepare($createQuery);
        $stmt->bindValue("id",$id);
        $stmt->execute();
        
        echo "Record Deleted!";
        
    }catch(PDOException $ex){
        echo "Error" . $ex->getMessage();
    }
}


?>

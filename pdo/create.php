<?php

include_once "Database.php";


$form_errors = [];
$data = [];

if(isset($_POST['name'])  && isset($_POST['description'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    if(!$name || $name == null){
        $form_errors['name'] = "Task name is required!";
    }

    
        if(!$description || $description == null){
        $form_errors['description'] = "Task description is required!";
    }

    if(count($form_errors) < 1){
    try{
        
        $createQuery = "INSERT INTO tasks (name, description, created_at) VALUES (:name, :desc, now())";
        $stmt = $conn->prepare($createQuery);
        $stmt->bindValue("name",$name);
        $stmt->bindValue("desc",$description);
        $stmt->execute();
        

        $data['success'] = true;
        $data['message'] = "Record Inserted!";

        
        
    }catch(PDOException $ex){
        echo "Error" . $ex->getMessage();
    }
}else {
        $data['sucess'] = false;
        $data['message'] = $form_errors;
        
        
    }

    echo json_encode($data);

}


?>

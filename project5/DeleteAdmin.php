<?php require_once("includes/db.php"); ?>
<?php require_once("includes/sessions.php"); ?>
<?php

if(isset($_GET['id'])){
    $id=$_GET['id']; //TODO security checks
    
    
    global $conn;
    $query = "DELETE FROM admins WHERE id=:id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindValue("id", $id);
    
    $results = $stmt->execute();
    
    if($results)
    {
        setSuccess("Admin deleted!");
        send("Admins.php");
    }else{
        setError("Some Error! " . $conn->errorInfo());
        send("Admins.php");

    }
    
}

?>
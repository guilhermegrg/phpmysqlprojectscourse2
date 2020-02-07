<?php 

use voku\helper\Paginator;

require __DIR__ . "/vendor/autoload.php";

include_once "Database.php";

$tasks = "";

try{
    
    $paginate = new Paginator(2,'p');
    
    $readQuery = "SELECT * FROM tasks";
    
    $stmt = $conn->query($readQuery);
    
    $total = $stmt->rowCount();
    
    $paginate->set_total($total);
    
    
    $tasks = $conn->query("SELECT * FROM tasks " . $paginate->get_limit());
    
    
    
}catch(PDOException $ex){
    echo "Error : " . $ex.getMessage();
}


?>
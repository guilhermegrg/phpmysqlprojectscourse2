<?php


session_start();


function setError($text){
   $_SESSION['ErrorMessage'] = $text; 
}

function setSuccess($text){
   $_SESSION['SuccessMessage'] = $text; 
}


function getErrorMessage(){
    if(isset($_SESSION['ErrorMessage'])){
        $output = "<div class='alert alert-danger'>" . htmlentities($_SESSION['ErrorMessage']) . "</div>";
        $_SESSION['ErrorMessage'] = null;
        return $output;
    }
}


function getSuccessMessage(){
    if(isset($_SESSION['SuccessMessage'])){
        $output = "<div class='alert alert-success'>" . htmlentities($_SESSION['SuccessMessage']) . "</div>";
        $_SESSION['SuccessMessage'] = null;
        return $output;
    }
}


function showMessages(){
    echo getErrorMessage();
    echo getSuccessMessage();
}

?>



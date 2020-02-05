<?php


session_start();


function setSessionValue($key,$value){
   $_SESSION[$key] = $value; 
}

function setError($text){
   setSessionValue('ErrorMessage',$text); 
}

function setSuccess($text){
   setSessionValue('SuccessMessage',$text); 
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

function setAdminSessionData($username, $name, $id){
    
    setSessionValue('ADMIN_ID',$id);
 setSessionValue('ADMIN_USERNAME',$username);
 setSessionValue('ADMIN_NAME',$name);
             
}

function getAdminName(){
    return $_SESSION['ADMIN_NAME'];
}
function getAdminUsername(){
    return $_SESSION['ADMIN_USERNAME'];
}


function getAdminId(){
    if(isset($_SESSION['ADMIN_ID']))
    return $_SESSION['ADMIN_ID'];
    else
        return 0;
}


function confirmLogin(){
    if(isset($_SESSION['ADMIN_ID']))
        return true;
    else{
        setError("Login Required!");
        send("Login.php");
    }  
}

function getTrackingURL(){
    return $_SESSION['TRACKING_URL'];
}

function setTrackingURL(){
        $_SESSION['TRACKING_URL'] = $_SERVER['PHP_SELF'];
}




?>



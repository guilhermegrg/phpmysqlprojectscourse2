<?php

class Messages {
    
    
    public static function setMsg($text, $type){
        if($type=="error"){
            $_SESSION['error'] = $text;
        }else{
            $_SESSION['success'] = $text;
        }
    }
    
    
    public static function display(){
        
        if(isset($_SESSION['error'])){
            echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }elseif(isset($_SESSION['sucess'])){
            echo "<div clas='alert alert-success'>" . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
            
        }
        
        
    }
    
}

?>
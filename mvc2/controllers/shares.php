<?php


class Shares extends Controller {
    
    protected function Index(){
       $viewmodel = new ShareModel();
        $this->returnView($viewmodel->Index(),true);
    }
    
    
    protected function add(){
        
        if(!isset($_SESSION['LOGGED_IN'])){
            
         header("Location: " . ROOT_URL . "users/login");   
        }
        
       $viewmodel = new ShareModel();
        $this->returnView($viewmodel->add(),true);
    }
    
    
}

?>
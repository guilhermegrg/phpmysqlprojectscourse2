<?php

class Home extends Controller{
    
    public function index($name = 'Post'){
        
        $post = $this->model($name);
        $post->title = "PHP rulez!!";
        
        //echo $user->name;
        $this->view('home', ['title'=>$post->title]);
    }
    
}

?>
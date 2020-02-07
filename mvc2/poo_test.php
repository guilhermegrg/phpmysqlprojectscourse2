<?php


abstract class User{
    
    public static $count=0;
    
    public $data = "hello";
    
    public function __construct(){
        ++User::$count;
    }
    
    public function runthis(){
        echo $this->data;
    }
    
    
    public function __get($count){
        return User::$count;
    }
    
}

class B extends User {
    
}


$var = new B();
$var->runthis();


echo "<br>".User::$count."<br>";


?>
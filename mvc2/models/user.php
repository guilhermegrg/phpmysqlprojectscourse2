<?php


class UserModel extends Model {
    
       
    public function register(){
        $post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        
        if(isset($post['submit'])){
            
            
            $name = $post['name'];
            $email = $post['email'];
            $password = $post['password'];
            
            
            
            
            if(empty($name))
            {
               Messages::setMsg("Name can't be empty!","error");
                return; 
                
            }
            
            
            $this->query('INSERT INTO users(name, email, password) VALUES (:name, :email, :password)');
            $this->bind("name",$name);
            $this->bind("email",$email);
            $this->bind("password",password_hash($password,PASSWORD_DEFAULT));
            
            
            $this->execute();
            
            
            if($this->lastInsertId()){
                header("Location: " . ROOT_URL."users/login");
            }
            
        }
        
        return;
    }
    
    
    public function login(){
        $post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        
        if(isset($post['submit'])){
            
            $email = $post['email'];
            $password = $post['password'];
            
            $this->query("SELECT * FROM users WHERE email=:email");
            $this->bind("email",$email);
            $row = $this->getResult();
            
            
            if(isset($row) && sizeof($row)>0){
            
//                var_dump($row);
                
            $row = $row[0];
            $dbpass = $row['password'];
            
           if(password_verify($password,$dbpass)){
//                echo "Logged in!";
               
               $_SESSION['LOGGED_IN']= true;
               $_SESSION['user_data']= ["id"=>$row['id'], "name"=>$row['name'], "email"=>$email];
               
            }else{
                Messages::setMsg("Incorrect login!","error");
            }
                
            }
            else
                Messages::setMsg("Incorrect login!","error");
            
        }
        
        
        
    }
    
}


?>
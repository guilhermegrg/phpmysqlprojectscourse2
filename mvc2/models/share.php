<?php


class ShareModel extends Model {
    
    public function Index(){
        $this->query("SELECT * FROM shares ORDER BY id DESC");
        $rows = $this->getResult();
        return $rows;
    }
    
    public function add(){
        $post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        
        if(isset($post['submit'])){
            
            
            $title = $post['title'];
            $body = $post['body'];
            $link = $post['link'];
            
            $user_id = 1;
            
            $this->query('INSERT INTO shares(title, body, link, user_id) VALUES (:title, :body, :link, :user_id)');
            $this->bind("title",$title);
            $this->bind("body",$body);
            $this->bind("link",$link);
            $this->bind("user_id",$user_id);
            
            
            $this->execute();
            
            
            if($this->lastInsertId()){
                header("Location: " . ROOT_URL."shares");
            }
            
        }
        
        return;
    }
}


?>
<?php


abstract class Model {
    
    protected $dbh;
    protected $stmt;
    
    
    public function __construct(){
        $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
    }
    
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }
    
        public function bind($param, $value, $type = null){
        
        if(is_null($type)){
            if(is_int($value)){
                $type = PDO::PARAM_INT;
            }elseif(is_bool($value)){
                $type = PDO::PARAM_BOOL;
            }elseif(is_null($value)){
                $type = PDO::PARAM_NULL;
            }else
            {
                $type = PDO::PARAM_STR;
            }
        }
        
        $this->stmt->bindValue($param,$value,$type);
        
    }
    
     public function execute(){
        return $this->stmt->execute();
    }
    
    public function getResult(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
     public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }
    
}

?>
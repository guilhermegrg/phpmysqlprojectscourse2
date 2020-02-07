<?php


class Database{
    
    
    
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "myblog";
    
    
    
    private $dbh;
    private $error;
    private $stmt;
    
    public function __construct(){
        //set DSN
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;";
            //set options
        $options = [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        
        
        try{
           $this->dbh = new PDO($dsn,$this->user,$this->pass,$options); 
        }catch(PDOException $e){
            $this->error = $e.getMessage();
        }
        
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
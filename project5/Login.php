<?php include "includes/public_header.php" ?>
<?php
    
    if(getAdminId())
        send("Dashboard.php");
    ?>
<?php

    if(isset($_POST['submit'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
      if(empty($username) || empty($password)){
        setError("All fields must be filled!");
        send("Login.php");
    }elseif(strlen($username)<=2){
        setError("Username must be more than 2 chars!");
        send("Login.php");
        
    }
        
     $row = getAdminByUsername($username);
     if($row){
        
         $password_hash = $row['password'];
         if(password_verify($password,$password_hash)){
             //loginUser();
             
             $id = $row['id'];
             $name = $row['name'];
             
           setAdminSessionData($username,$name,$id);
             
            setSuccess("Welcome back $username!");
             
             if(getTrackingURL())
                send(getTrackingURL());
             else
                 send("Dashboard.php");
             
             
             
         }else{
             setError("Username/Password incorrect!");
        send("Login.php");
         }
         
     }else
     {
        setError("Username/Password incorrect!");
        send("Login.php");
     }
        
    }
    
    
?>
 
 <!--    header-->
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
               <h1>Login</h1>
           </div>
       </div>
       
   </div>
   </header>
   
<!--   main-->
<section class="container py-2 mb-4">
    <div class="row">
        <div class="offset-sm-3 col-sm-6">
            
            <div class="card bg-secondary text-light">
                <div class="card-header">
                    <h4>
                    Welcome back</h4>
                </div>
                <div class="card-body bg-dark">
                    
                
                <form action="" method="post">
                   
                    <div class="form-group">
                        <label for="username">
                            Username:
                        </label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <i class="fas fa-user input-group-text bg-info text-white"></i>
                        </div>
                        <input type="text" class="form-control" name="username" id="username">
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="password">
                            Password:
                        </label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <i class="fas fa-lock input-group-text bg-info text-light"></i>
                        </div>
                        <input type="password" class="form-control" name="password" id="password">
                        </div>
                        
                    </div>
                    
                        <div class="form-group mb-0">
                        <input type="submit" class="form-control btn btn-info btn-block" name="submit" id="submit">
                        </div>
                </form>
                </div>
            </div>
            
        </div>
    </div>
    
</section>



<?php include "includes/footer.php" ?>
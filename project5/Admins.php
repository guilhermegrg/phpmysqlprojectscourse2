<?php include "includes/header.php" ?>

<?php
    
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    
    
    
    
    
    if(empty($username) || empty($email) ||empty($password) ||empty($confirm_password) ){
        setError("All fields except name must be filled in!");
        send("Admins.php");
    }elseif(strlen($username)<=2){
        setError("Username must be more than 2 chars!");
        send("Admins.php");
        
    }elseif(isUsernameTaken($username)){
        setError("Username '$username' already exists! Pick another! ");
        send("Admins.php");
        
    }elseif(strlen($email)<=3){
        setError("Email must be more than 3 chars!");
        send("Admins.php");
        
    }elseif(isEmailTaken($email)){
        setError("Email '$email' already exists! Pick another! ");
        send("Admins.php");
    }
    elseif(strlen($password)<=2){
        setError("Password must be more than 2 chars!");
        send("Admins.php");
        
    }elseif($password !== $confirm_password){
        setError("Password and confirmation are not equal!");
        send("Admins.php");
        
    }else{//insert new category
        
        $admin = "Guilhasgrg"; //dummy value
//        $time = now();//date_format(time(), 'Y-m-d H:i:s');
//        date_default_timezone_set("Europe/Lisbon");
//        $time = date('Y-m-d H:i:s');
//        echo "<h1>Time: $time</h1>";
        
     $query = "INSERT INTO admins(username, password, email, name, time, addedby) VALUES (:username, :password, :email, :name, now(), :addedby )";
        $stmt = $conn->prepare($query);
        $stmt->bindValue("username",$username);
        $stmt->bindValue("password",password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue("email",$email);
        $stmt->bindValue("name",$name);
        $stmt->bindValue("addedby",$admin);
        
        $result = $stmt->execute();
        $id = $conn->lastInsertId();
        
        if($result && $id > 0){
            setSuccess("Admin $id->'$title' added!");
            send("Admins.php");
        }else{
            setError("Error! " . mysqli_error($conn));
            send("Admins.php");
            
        }
    }
}
    
    
?>

<!--    header-->
  <header class="bg-dark text-white py-3">
   <div class="container">
       <div class="row">
          <div class="col-md-12">
              
               <h1><i class="fas fa-user"></i>Manage Admins</h1>
           </div>
       </div>
       
   </div>
   </header>
   

   
<!--   main-->
<section class="container py-2 mb-4">
    <div class="row" >
        <div class="offset-lg-1 col-lg-10 " style="min-height: 400px;">
            
        <?php showMessages(); ?>
            
            <form action="" method="post">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-header">
                        <h1>Add New Admin</h1>
                    </div>
                    <div class="card-body bg-dark">
                       
                       
                        <div class="form-group">
                            <label for="title">Username</label>
                            <input type="text" name="username" id="username" placeholder="Type username Here" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="title">Password</label>
                            <input type="password" name="password" id="password" placeholder="Type password Here" class="form-control">
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="title">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password Here" class="form-control">
                        </div>
                      
                        
                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter Email Here" class="form-control">
                        </div>      
                        
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" name="name" id="name" placeholder="Type name Here" class="form-control">
                            <span class="text-muted">*Optional</span>
                        </div>                                          
                                                                              
                        
                        <div class="row">
                            <div class="col-lg-6 mb-2"><a href="" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard</a></div>
                            <div class="col-lg-6 mb-2"><button class="btn btn-success btn-block" name="submit" type="submit"><i class="fas fa-check"></i>Create New Admin</button></div>
                        </div>
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>
    
</section>





<!--   main end-->


<?php include "includes/footer.php" ?>
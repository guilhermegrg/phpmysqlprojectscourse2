<?php

function testUserInput($data){
    return trim($data);
}


$NameError = "";
$EmailError = "";
$GenderError = "";
$WebsiteError = "";

if(isset($_POST['submit'])){
    
    
    $name = testUserInput($_POST['name']);
    $email = testUserInput($_POST['email']);
    $gender = testUserInput($_POST['gender']);
    $website = testUserInput($_POST['website']);
    $comment = testUserInput($_POST['comment']);
    

    
    if(empty($name))
        $NameError = "Name can't be empty!";
    elseif(!preg_match("/^[a-zA-Z]{3,}[ ]+[a-zA-Z]{3,}([ ]+[a-zA-Z]{3,})*$/",$name))
        $NameError = "Only letters and spaces allowed!";
    
    if(empty($email))
        $EmailError = "Email can't be empty!";
    elseif(!preg_match("/^[a-zA-Z._\d]{2,}@[a-zA-Z\d]{3,}([.][a-zA-Z\d]{2,})+$/",$email))
        $EmailError = "Write a proper email dude!";
    
    if(empty($gender))
        $GenderError = "Gender can't be empty!";
    elseif($gender != "Male" && $gender != "Female")
        $GenderError = "Choose male or female";
    
    if(empty($website))
        $WebsiteError = "Website can't be empty!";
    elseif(!preg_match("/^(http:\/\/)?[a-zA-Z_\d]{2,}([.][a-zA-Z_\d]{2,})+$/",$website))
        $WebsiteError = "Write a proper url!!!";
    

    
//     echo "<br>Name: $name<br>";
//    echo "<br>Email: $email<br>";
//    echo "<br>Gender: $gender<br>";
//    echo "<br>Website: $website<br>";
//    echo "<br>Comment: $comment<br>";
//    
//     echo "<br>Name: $NameError<br>";
//    echo "<br>Email: $EmailError<br>";
//    echo "<br>Gender: $GenderError<br>";
//    echo "<br>Website: $WebsiteError<br>";

    
 if($NameError == "" && $EmailError == "" && $GenderError == "" && $WebsiteError == "" ){
    echo "<br>Name: $name<br>";
    echo "<br>Email: $email<br>";
    echo "<br>Gender: $gender<br>";
    echo "<br>Website: $website<br>";
    echo "<br>Comment: $comment<br>";
}else
     echo "<span class='error'>Please correct and complete your form!</span><br>";
    
    
    
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>First Form</title>
</head>

<style type="text/css">
    

    input[type=text], input[type=email], textarea {
        border: 1 px solid_dashed;
        background-color: burlywood;
        width: 30%;
        padding: .5em;
        font-size: 1.0em;
    }
    
    .error 
    {
        color:red;
/*        background-color: red;*/
    }
    
</style>


<body>
   
   <form action="" method="post">
     <legend>* Must fill in these value</legend>
      <fieldset>
       <div>
           <label for="name">Name:</label>
           <input type="text" id="name" name="name" required pattern="[a-zA-Z]{3,}[ ]+[a-zA-Z]{3,}([ ]+[a-zA-Z]{3,})*" title="two or more names with 3 chars each">
           <br>
          <p class="error">*<?php echo $NameError;?></p>
       </div>
        
       <div>
           <label for="email">E-Mail:</label>
           <input type="email" id="email" name="email" required>
           
           <br>
           <p class="error">*<?php echo $EmailError;?></p>
       </div>
       
       <div>
           <label for="gender">Gender:</label>
           <input type="radio" name="gender" value="Male" required> 
           <input type="radio" name="gender" value="Female" required> 
           
           <br>
           <p class="error">*<?php echo $GenderError;?></p>
       </div>

       <div>
           <label for="website">Website:</label>
           <input type="text" id="website" name="website" required pattern="(http:\/\/)?[a-zA-Z_\d]{2,}([.][a-zA-Z_\d]{2,})+" title="https:// followed by a legal domain name">
           
           <br>
          <p class="error">*<?php echo $WebsiteError;?></p>
       </div>

       <div>
           <label for="comment">Comment:</label>
           <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
       </div>
                                                                                   
        <div>
            <input type="submit" name="submit" Value="Submit">
        </div>                                                     
                                                                                    
       </fieldset>
       
       
   </form>
    
</body>
</html>
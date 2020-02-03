<?php

require "../functions.php";



$nameError = "";
$ssnError = "";
$departmentError = "";
$salaryError = "";
$homeaddressError = "";

if(isset($_POST['submit'])){
    
    
    $name = clean($_POST['name']);
    $ssn = clean($_POST['ssn']);
    $department = clean($_POST['department']);
    $salary = clean($_POST['salary']);
    $homeaddress = clean($_POST['homeaddress']);
    

    
    if(empty($name))
        $NameError = "Name can't be empty!";
    elseif(!preg_match("/^[a-zA-Z]{3,}[ ]+[a-zA-Z]{3,}([ ]+[a-zA-Z]{3,})*$/",$name))
        $NameError = "Only letters and spaces allowed!";
    
    if(empty($ssn))
        $ssnError = "SSN can't be empty!";
    elseif(!preg_match("/^\d{6}$/",$ssn))
        $ssnError = "Write a proper ssn dude! 6 digit number!!!";
    
    if(empty($department))
        $departmentError = "Department can't be empty!";
    elseif(!preg_match("/^[a-zA-Z]{3,}$/",$department))
        $departmentError = "a single name with more than 3 letters dude!";
    
        if(empty($salary))
        $salaryError = "SSN can't be empty!";
    elseif(!preg_match("/^[\d]{3,12}$/",$salary))
        $salaryError = "numbers only dude";
    
    if(empty($homeaddress))
        $homeaddressError = "Home address can't be empty";
    elseif(!preg_match("/^[a-zA-Z\d]{3,}[ ]+[a-zA-Z\d]{3,}([ ]+[a-zA-Z\d]{3,})*$/",$homeaddress))
        $homeaddressError = "only names with spaces";
    

    
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

    
 if($nameError == "" && $homeaddressError == "" && $salaryError == "" && $departmentError == "" && $ssnError == "" ){
    echo "<br>Name: $name<br>";
    echo "<br>SSN: $ssn<br>";
    echo "<br>Department: $department<br>";
    echo "<br>Salary: $salary<br>";
    echo "<br>Address: $homeaddress<br>";
     
     
//     $query = "INSERT INTO users (name, ssn, department, salary, home_address) VALUES ('$name', '$ssn','$department', '$salary', '$homeaddress')";
     
     
     $stmt_query = "INSERT INTO users (name, ssn, department, salary, home_address) VALUES (?, ?, ?, ?, ?)";
     $stmt = mysqli_prepare($conn, $stmt_query);
     
     
      if(!$stmt)
        die('QUERY FAILED'. mysqli_error($connection));
     
     
     mysqli_stmt_bind_param($stmt,"sssss",$name,$ssn,$department,$salary,$homeaddress);
     //mysqli_stmt_bind_result($stmt,$name,$ssn,$department,$salary,$home_address);
     mysqli_stmt_execute($stmt);
     $results = mysqli_stmt_get_result($stmt);
//     mysqli_stmt_store_result($stmt);
    $newid =   mysqli_insert_id($conn);
     mysqli_stmt_close($stmt);
     
     
//     $results = query($query);
//     $newid =  mysqli_insert_id($conn);
     echo "<h3>Created new user with id: $newid</h3>";
     
     
     
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
    

    input[type=text],
    input[type=email],
    input[type=number],
    textarea {
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
     <legend>* Must fill in these values</legend>
      <fieldset>
       <div>
           <label for="name">Name:</label>
           <input type="text" id="name" name="name" required pattern="[a-zA-Z]{3,}[ ]+[a-zA-Z]{3,}([ ]+[a-zA-Z]{3,})*" title="two or more names with minimum 3 chars each">
          <p class="error">*<?php echo $nameError;?></p>
       </div>
        
       <div>
           <label for="ssn">SSN:</label>
           <input type="number" id="ssn" name="ssn" required title="6 digit number">
           <p class="error">*<?php echo $ssnError;?></p>
       </div>

       <div>
           <label for="department">Department</label>
           <input type="text" id="department" name="department" required pattern="[a-zA-Z]{3,}" title="a single name more than 3 chars">
          <p class="error">*<?php echo $departmentError;?></p>
       </div>
       
       <div>
           <label for="salary">Salary:</label>
           <input type="number" id="salary" name="salary" required>
           <p class="error">*<?php echo $salaryError;?></p>
       </div>
                     

       <div>
           <label for="homeaddress">Home Address:</label>
           <input type="text" id="homeaddress" name="homeaddress" required pattern="[a-zA-Z]{3,}[ ]+[a-zA-Z]{3,}([ ]+[a-zA-Z]{3,})*" title="two or more words separated by spaces">
          <p class="error">*<?php echo $homeaddressError;?></p>
       </div>

                                                                                  
                                                                                  

                                                                                  
                                                                                   
        <div>
            <input type="submit" name="submit" Value="Submit">
        </div>                                                     
                                                                                    
       </fieldset>
       
       
   </form>
    
</body>
</html>
<?php ob_start(); ?>
<?php require "../functions.php"?>




<?php
    
    
    if(isset($_GET['delete'])){
        $id=$_GET['delete'];
        $query = "DELETE FROM users WHERE id=$id";
        $stmt = mysqli_prepare($conn,$query);
        mysqli_stmt_execute($stmt);
        $rows = mysqli_affected_rows($conn);
        print_r($rows);
        mysqli_stmt_close($stmt);
        header("Location: table.php");
        
        
    }
    elseif(isset($_GET['page'])){
     
        $page = $_GET['page'];
        //TODO test for validity of page number
        $results = getPage("users",$page);
        
    }
    elseif(isset($_POST['search'])){
        
        $search = $_POST['search'];
        $search = clean($search);
        
        echo "search: $search<br>";
     
        //TODO test for validity of page number
        $results = searchUsers($search);
        
    }
else{
        
        
        
        $results = getPage("users",1);
        
//        $query = "SELECT * FROM users";
//        $stmt = mysqli_prepare($conn, $query);
//        mysqli_stmt_execute($stmt);
//        mysqli_stmt_bind_result($stmt,$id,$name,$ssn,$salary,$department,$home_address);
//        mysqli_stmt_store_result($stmt);
        
//        while ($row = mysqli_stmt_fetch($stmt))
//        {
//            echo "Name: $name <br>";
//        }

    }

    
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    
    <form action="" method="post">
        <div>
            <label for="search"></label>
            <input type="text" name="search" id="search">
            <input type="submit" name="searchSubmit" value="Search">
        </div>
    </form>
    
    <?php include "pagination.php" ?>
    
    <table>
        <thead>
            <td>Id</td>
            <td>Name</td>
            <td>SSN</td>
            <td>Salary</td>
            <td>Department</td>
            <td>Home Address</td>
            <td>Edit</td>
            <td>Delete</td>
        </thead>
        <tbody>
            
            <?php
            
                        
            while ($row = mysqli_fetch_assoc($results))
        {
                $id = $row['id'];
                
            echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['ssn']}</td>";
                echo "<td>{$row['salary']}</td>";
                echo "<td>{$row['department']}</td>";
                echo "<td>{$row['home_address']}</td>";
                echo "<td><a href='edit_form.php?edit=$id'>Edit</a></td>";
                echo "<td><a href='?delete=$id'>Delete</a></td>";
                
            echo "</tr>";
        }
            

            
            
//            
//            while ($row = mysqli_stmt_fetch($stmt))
//        {
//            echo "<tr>";
//                echo "<td>$id</td>";
//                echo "<td>$name</td>";
//                echo "<td>$ssn</td>";
//                echo "<td>$salary</td>";
//                echo "<td>$department</td>";
//                echo "<td>$home_address</td>";
//                echo "<td><a href='edit_form.php?edit=$id'>Edit</a></td>";
//                echo "<td><a href='?delete=$id'>Delete</a></td>";
//                
//            echo "</tr>";
//        }
//            
            ?>
            
            
        </tbody>
    </table>
    
    <?php include "pagination.php" ?>
    
</body>
</html>
